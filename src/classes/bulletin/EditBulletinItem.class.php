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
final class EditBulletinItem extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $recordID;
    private $news_title;
    private $fileName;
    private $existingFiles;
    private $news_details;
    private $news_target_audience;
    private $retrieveExistingFileQuery;
    private $editBulletinItemQuery;
    private $teacherData;

    private $params = [
        '(recordID)', 
        '(news_title)', 
        '(news_details)', 
        '(news_target_audience)',
        '(files) [Optional]'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_POST['recordID'])           ||
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
                $this->recordID               =  $this->input($_POST["recordID"], STRICT_INPUT_FILTER);
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

                
                    if (!empty($_FILES["files"])) {
                        $this->editBulletinItemQuery = $this->updateTBL ( 
                            database::$conn, 'bulletin', 
                            [
                                "news_title            = '$this->news_title', ", 
                                "news_file             = '$this->fileName', ", 
                                "news_details          = '$this->news_details', ", 
                                "news_target_audience  = '$this->news_target_audience' ",
                                "WHERE bulletin_id     = '$this->recordID' "
                            ] 
                        );
                    } else {
                        $this->editBulletinItemQuery = $this->updateTBL ( 
                            database::$conn, 'bulletin', 
                            [
                                "news_title            = '$this->news_title', ", 
                                "news_details          = '$this->news_details', ", 
                                "news_target_audience  = '$this->news_target_audience' ",
                                "WHERE bulletin_id     = '$this->recordID' "
                            ] 
                        );
                    }
                    

                    
                    
                    if ($this->editBulletinItemQuery['status'] == false) {
                        $this->output(
                            false, 500, 
                            'Sorry, update to bulletin post failed', 
                            $this->editBulletinItemQuery['SQL_snapshot'], 
                            []
                        );
                    } else {
                        
                        if ($this->editBulletinItemQuery['total'] == 1) {
                            $this->output(
                                true, 200, 
                                '1 Bulleting post has been updated', 
                                $this->editBulletinItemQuery['info'], 
                                []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'Sorry, unknown recordID: ('.$this->recordID.')',
                                $this->editBulletinItemQuery['info'], []
                            );
                        }
                    }

                } else {
                    $this->output(
                        false, 403, 
                        'Sorry, Only (admins) are allowed to edit items on the school bulletin', 
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
$EditBulletinItem = new EditBulletinItem;
$EditBulletinItem->main();
?>