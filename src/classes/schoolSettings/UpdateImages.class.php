<?php 
  /**
   * *********************************************************************************************************
   * @_forProject: Application | Developed By: TAMMA CORPORATION
   * @_purpose: (Please Specify) 
   * @_version Release: package_two
   * @_created Date: 00/00/2020
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
  final class UpdateImages  extends teacherDetails
  {
    use apiResponseManager, io_stream, queryBuilder;
    
    private $columnName;
    private $file_name;
    private $teacherData;
    private $settingsUpdateQuery;
    private $params = [
        '(file)', 
        '(upload_target)',
    ];
    
    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

            if (empty($_FILES['file']) || empty($_POST['upload_target'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {

                $this->teacherData = parent::teacherInfo();

                if ($this->teacherData[0]['accountType'] == 'admin') {

                    switch ($_POST['upload_target']) {
                        case 'logo':
                            $this->columnName = 'app_logo';
                            break;
                        case 'main':
                            $this->columnName = 'app_home_background_image';
                            break;
                        case 'staff':
                            $this->columnName = 'app_educator_login_background_image';
                            break;
                        case 'student':
                            $this->columnName = 'app_student_login_background_image';
                            break;
                        default:
                            $this->output(
                                false, 400, 
                                'Set: (upload_target) to either {logo/main/staff/student}', 
                                'Bad Request', []
                            ); exit;
                            break;
                    }

                    $uploadFile = FileUploader2::fileDetails($_FILES['file'], 'UploadRegularFile', SETTINGS_UPLOAD_PATH);

                    if ($uploadFile['status'] == false) {
                        $this->output(
                            false, 500, 
                            $uploadFile['body']['message'], 
                            $uploadFile['body']['error_info'], []
                        );
                    } else {
                        $this->file_name = $uploadFile['body']['dataset']['file_name'];

                        $this->settingsUpdateQuery = $this->updateTBL( 
                            database::$conn, 'application_settings',  
                            ["$this->columnName  = '$this->file_name'" , "WHERE id = '1' "]
                        );

                        if ($this->settingsUpdateQuery['status'] == false) {
                            $this->output(
                                false, 500, 
                                'Sorry ('.$this->columnName.') update failed', 
                                $this->settingsUpdateQuery['info'], 
                                []
                            );
                        } else {
                            if ($this->settingsUpdateQuery['total'] > 0) {
                                $this->output(
                                    false, 200, 
                                    '('.$this->columnName.') updated', 
                                    $this->settingsUpdateQuery['info'], 
                                    []
                                );
                            } else {
                                $this->output(
                                    false, 501, 
                                    'No changes were made to ('.$this->columnName.')', 
                                    $this->settingsUpdateQuery['info'], 
                                    []
                                );
                            }
                        }
                    }

                } else {
                    $this->output(
                        false, 403, 
                        'Sorry, Only (admins) are allowed to change this application Images', 
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

  } // END class deleteEducator 
//   
$UpdateImages = new UpdateImages;
$UpdateImages->main();
?>