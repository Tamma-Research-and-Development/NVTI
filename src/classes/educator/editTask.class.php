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
final class editTask extends teacherDetails
{
    use exerciseManager, apiResponseManager, queryBuilder, io_stream;

    private $id;
    private $taskType;
    private $taskDescription;
    private $intendedClass;
    private $intendedSubject;
    private $teacherData;
    private $phone;
    private $intendedSchool;
    private $fileName  = ''; 

    private $update_Test; 
    private $task_update_query; 
    private $exerciseUpdateResult; 

    private $params = [
        '(taskType)', 
        '(taskDescription)', 
        '(intendedClass)', 
        '(intendedSubject)', 
        '(id)'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST["id"])              ||
                empty($_POST["taskType"])        ||
                empty($_POST["taskDescription"]) ||
                empty($_POST["intendedClass"])   ||
                empty($_POST["intendedSubject"])
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->id                =  $this->input($_POST["id"], STRICT_INPUT_FILTER);
                $this->taskType          =  $this->input($_POST["taskType"], STRICT_INPUT_FILTER);
                $this->taskDescription   =  $this->input($_POST["taskDescription"], STRICT_INPUT_FILTER);
                $this->intendedClass     =  $this->input($_POST["intendedClass"], STRICT_INPUT_FILTER);
                $this->intendedSubject   =  $this->input($_POST["intendedSubject"], STRICT_INPUT_FILTER);
                
                $this->teacherData       =  parent::teacherInfo();
                $this->phone             =  $this->teacherData[0]['Phone_number'];
                $this->intendedSchool    =  $this->teacherData[0]['School_Teaching'];

                // upload file if it exist
                if (!empty($_FILES["files"])) {
                    $upload_result = FileUploader2::fileDetails($_FILES['files'], 'UploadRegularFile', TASK_UPLOAD_PATH);

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

                $this->update_Test = (empty($_POST["testData"])) ? false : true;
                
                $this->task_update_query = $this->updateTBL( 
                    database::$conn, 
                    'task', 
                    [
                        " `taskType`         =  '$this->taskType', ",
                        " `intendedSchool`   =  '$this->intendedSchool', ",
                        " `intendedClass`    =  '$this->intendedClass', ",
                        " `subject`          =  '$this->intendedSubject', ",
                        " `taskDescription`  =  '$this->taskDescription', ",
                        " `files`            =  '$this->fileName' ",
                        "  WHERE `id`         = '$this->id' "
                    ]
                );
                
                if ($this->task_update_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry Task could not be updated', 
                        $this->task_update_query['SQL_snapshot'], []
                    );
                } else {
                    // NOTE: 
                    // not checking for affected_rows because, it prevents the update 
                    // of exercise questions if the task does not change
                    if ($this->update_Test == true) {
                        $this->exerciseUpdateResult = exerciseManager::updateExercise(
                            $_POST["testData"], 
                            $this->taskType, 
                            $this->id, 
                            $this->intendedSchool, 
                            $this->intendedClass, 
                            $this->phone
                        );
                        $this->output(
                            $this->exerciseUpdateResult['status'], 
                            $this->exerciseUpdateResult['status_code'], 
                            $this->exerciseUpdateResult['body']['message'], 
                            '', 
                            []
                        );
                    } else {
                        $this->output(
                            true, 200, 
                            $taskType . ' task has been updated', 
                            $this->task_update_query['info'], []
                        );
                    }
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
$editTask = new editTask;
$editTask->main();
?>