<?php 
/**
 * *********************************************************************************************************
 * @_forProject:  | Developed By: TAMMA CORPORATION
 * @_purpose: (Please Specify) 
 * @_version Release: package_two
 * @_created Date: 00/00/2019
 * @_author(s):
 *   1) Mr. Michael kaiva Nimley. (Hercules d Newbie)
 *      @contact Phone: (+231) 777-007-009
 *      @contact Mail: michaelkaivanimley.com@gmail.com, mnimley6@gmail.com, mnimley@tammacorp.com
 *   --------------------------------------------------------------------------------------------------
 *   2) Fullname of engineer. (Code Name)
 *      @contact Phone: (+231) 000-000-000
 *      @contact Mail: -----@tammacorp.com
 * *********************************************************************************************************
 */
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
UserAccessControl::guardResource();
/**
* undocumented class
*
* @package default
* @author 
**/
final class FetchBulletinItems
{
    use apiResponseManager, io_stream, queryBuilder;

    private $audiance;
    private $bulletinPostFetchQuery;
    private $file = [];
    private $bulletinPostArray = [];

    private $params = [
        '(audiance)'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if ( empty($_GET['audiance']) ) { 
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->audiance = $this->input($_GET["audiance"], STRICT_INPUT_FILTER);

                if (!in_array($this->audiance, BULLETIN_AUDIANCE)) {
                    $this->output(
                        false, 400, 
                        'Set: (audiance) to either: {'.implode('/', BULLETIN_AUDIANCE).'}', 
                        'Bad Request', []
                    );exit;
                } 

                if ( $this->audiance == 'admin' ) {
                    $this->bulletinPostFetchQuery = $this->selectFromTBL ( 
                        database::$conn, [], 
                        'bulletin', 
                        [
                            "LEFT JOIN `admin_account` ON `bulletin`.postedBy = `admin_account`.id "
                        ], 
                        ["ORDER BY news_target_audience DESC"]
                    );
                } else {
                    $this->bulletinPostFetchQuery = $this->selectFromTBL ( 
                        database::$conn, [], 
                        'bulletin', 
                        [
                            "LEFT JOIN `admin_account` ON `bulletin`.postedBy = `admin_account`.id ",
                            "WHERE ",
                            "news_target_audience = '$this->audiance' OR ",
                            "news_target_audience = '".BULLETIN_AUDIANCE[0]."'"
                        ], 
                        ["ORDER BY news_target_audience DESC"]
                    );
                }
                
                if ( $this->bulletinPostFetchQuery['status'] == false ) {
                    $this->output(
                        false, 500, 
                        'Sorry, Bulletin Posts Retrieval failed', 
                        $this->bulletinPostFetchQuery['info'], 
                        []
                    );
                } else {
                    if ($this->bulletinPostFetchQuery['total'] > 0) {

                        while ($row = $this->bulletinPostFetchQuery['result']->fetch_assoc() ) {
                            // 
                            $this->file = [];
                            if ( empty($row['news_file']) ) {
                                $this->file = null;
                            } else {
                                $fileArr = explode(';', $row['news_file']);
                                for ($i=0; $i < count($fileArr); $i++) { 
                                    if (!empty($fileArr[$i])) {
                                        // $this->file[] = BULLETIN_UPLOAD_PATH.$fileArr[$i];
                                        $this->file[] = $fileArr[$i];
                                    }
                                }
                            }

                            $this->bulletinPostArray[] = [
                                'id'       => $row['bulletin_id'],
                                'title'    => $row['news_title'],
                                'file'     => $this->file,
                                'details'  => $row['news_details'],
                                'audience' => $row['news_target_audience'],
                                'postedOn' => $row['added_date'],
                                'postedBy' => [
                                    // 'photo'      => (empty($row['photo'])) ? null : STAFF_UPLOAD_PATH.$row['photo'],
                                    'photo'      => (empty($row['photo'])) ? null : $row['photo'],
                                    'first_name' => rtrim($row['First_Name']),
                                    'last_name'  => rtrim($row['Last_Name']),
                                ]
                            ];
                        }

                        $this->output(
                            true, 200, 
                            $this->bulletinPostFetchQuery['total']. ' Bulletin Post Found', 
                            $this->bulletinPostFetchQuery['info'], 
                            [$this->bulletinPostArray]
                        ); 

                    } else {
                        $this->output(
                            false, 404, 
                            $this->bulletinPostFetchQuery['total']. ' Bulletin Post Found', 
                            $this->bulletinPostFetchQuery['info'], 
                            []
                        );
                    }
                }

            }
        
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }

} // END class ClassName 
// 
$FetchBulletinItems = new FetchBulletinItems;
$FetchBulletinItems->main();
?>