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
final class AddBulletinItem extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $news_title;
    private $fileName;
    private $news_details;
    private $news_target_audience;
    private $addBulletinItemQuery;
    private $BulletinItemRedundancyPreventionQuery;
    private $teacherData;

    private $params = [
        '(news_title)', 
        '(news_details)', 
        '(news_target_audience)',
        '(files) [Optional]'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_POST['news_title'])           ||
                empty($_POST['news_details'])         ||
                empty($_POST['news_target_audience']) 
            ) { 
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->news_title             =  $this->input($_POST["news_title"], STRICT_INPUT_FILTER);
                $this->news_details           =  $this->input($_POST["news_details"], STRICT_INPUT_FILTER);
                $this->news_target_audience   =  $this->input($_POST["news_target_audience"], STRICT_INPUT_FILTER);

                if (!in_array($this->news_target_audience, BULLETIN_AUDIANCE)) {
                    $this->output(
                        false, 400, 
                        'Set: (news_target_audience) to either: {'.implode('/', BULLETIN_AUDIANCE).'}', 
                        'Bad Request', []
                    );exit;
                } 

                $this->teacherData  =  parent::teacherInfo();

                if ( $this->teacherData[0]['accountType'] == 'admin' ) {
                    // upload file if it exists
                    if (!empty($_FILES["files"])) {
                        $upload_result = FileUploader2::fileDetails($_FILES['files'], 'UploadRegularFile', BULLETIN_UPLOAD_PATH);

                        if ($upload_result['status'] == true) {
                            $this->fileName = $upload_result['body']['dataset']['file_name'];
                        } else {
                            $this->output(
                                false, 500, 
                                $upload_result['body']['message'], 
                                $upload_result['body']['error_info'],
                                $upload_result['body']['dataset']
                            ); exit;
                        }
                    }
                    
                    $this->BulletinItemRedundancyPreventionQuery = $this->selectFromTBL ( 
                        database::$conn, [], 'bulletin', 
                        [
                            "news_title            = '$this->news_title' OR",
                            "news_details          = '$this->news_details' "
                        ], 
                        []
                    );

                    if ($this->BulletinItemRedundancyPreventionQuery['total'] > 0) {
                        $this->output(
                            false, 403, 
                            'Sorry, ('.$this->news_title.') already exist', 
                            $this->BulletinItemRedundancyPreventionQuery['info'], 
                            []
                        ); 
                    } else {
                        $this->addBulletinItemQuery = $this->insertIntoTBL ( 
                            database::$conn, 'bulletin', 
                            [
                                "news_title",
                                "news_file",
                                "news_details",
                                "news_target_audience",
                                "postedBy",
                                "added_date",
                            ], 
                            [
                                $this->news_title, 
                                $this->fileName, 
                                $this->news_details, 
                                $this->news_target_audience, 
                                $this->teacherData[0]['id'],
                                TIMESTAMP
                            ] 
                        );
                        
                        if ($this->addBulletinItemQuery['status'] == false) {
                            $this->output(
                                false, 500, 
                                'Sorry, post to bulletin failed', 
                                $this->addBulletinItemQuery['info'], 
                                []
                            );
                        } else {
                            
                            if ($this->addBulletinItemQuery['total'] == 1) {
                                $this->output(
                                    true, 200, 
                                    '('.$this->news_title.') has been posted to the bulleting wall', 
                                    $this->addBulletinItemQuery['info'], 
                                    []
                                );
                            } else {
                                $this->output(
                                    false, 501, 
                                    'Sorry, post to bulletin failed',
                                    $this->addBulletinItemQuery['info'], []
                                );
                            }
                        }
                    }

                } else {
                    $this->output(
                        false, 403, 
                        'Sorry, Only (admins) are allowed to post item to the school bulletin', 
                        'Forbidden', []
                    );
                }
            }
        
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }

} // END class ClassName 
// 
$AddBulletinItem = new AddBulletinItem;
$AddBulletinItem->main();
?>