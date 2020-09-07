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
final class addTask extends teacherDetails
{
    use exerciseManager, apiResponseManager, io_stream, queryBuilder;

    private $taskType;
    private $taskDescription;
    private $intendedClass;
    private $intendedSubject;
    private $add_Test;

    private $teacherData;
    private $phone;
    private $intendedSchool;
    private $fileName = '';

    private $insert_Task_Into_TBL;
    private $testData;
    private $taskId;
    private $addExerciseResult;

    private $params = [
        '(taskType)', 
        '(taskDescription)', 
        '(intendedClass)', 
        '(intendedSubject)',
        ' and Optional: (testData) and (files)'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_POST['taskType'])        ||
                empty($_POST['taskDescription']) ||
                empty($_POST['intendedClass'])   ||
                empty($_POST['intendedSubject']) 
            ) { 
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->taskType          =  $this->input($_POST["taskType"], STRICT_INPUT_FILTER);
                $this->taskDescription   =  $this->input($_POST["taskDescription"], STRICT_INPUT_FILTER);
                $this->intendedClass     =  $this->input($_POST["intendedClass"], STRICT_INPUT_FILTER);
                $this->intendedSubject   =  $this->input($_POST["intendedSubject"], STRICT_INPUT_FILTER);
                $this->add_Test          =  (empty($_POST["testData"])) ? false : true;
                
                $this->teacherData       =  parent::teacherInfo();
                $this->phone             =  $this->teacherData[0]['Phone_number'];
                $this->intendedSchool    =  $this->teacherData[0]['School_Teaching'];
                

                // optional param is set 
                if (!empty($_FILES["files"])) {
                    $upload_result = FileUploader2::fileDetails($_FILES['files'], 'UploadRegularFile', TASK_UPLOAD_PATH);

                    if ($upload_result['status'] == true) {
                        $this->fileName = $upload_result['body']['dataset']['file_name'].';';
                    } else {
                        $this->output(
                            false, 500, 
                            $upload_result['body']['message'], 
                            $upload_result['body']['error_info'],
                            $upload_result['body']['dataset']
                        ); exit;
                    }
                }

                $this->insert_Task_Into_TBL = $this->insertIntoTBL ( 
                    database::$conn, 'task', 
                    [
                        "taskType",
                        "intendedSchool",
                        "intendedClass",
                        "subject",
                        "taskDescription",
                        "files",
                        "addedBy",
                    ], 
                    [
                        $this->taskType, 
                        $this->intendedSchool, 
                        $this->intendedClass, 
                        $this->intendedSubject, 
                        $this->taskDescription, 
                        $this->fileName, 
                        $this->phone
                    ] 
                );
                
                if ($this->insert_Task_Into_TBL['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry Task could not be created', 
                        $this->insert_Task_Into_TBL['info'], 
                        []
                    );
                } else {
                    
                    if ($this->insert_Task_Into_TBL['total'] == 1) {
                        
                        if ($this->add_Test == true) {
                            $this->testData  =  $_POST["testData"];
                            $this->taskId    =  $this->insert_Task_Into_TBL['insert_id'];
                            
                            $this->addExerciseResult  = $this->addExercise( 
                                $this->testData, 
                                $this->taskType, 
                                $this->taskId, 
                                $this->intendedSchool, 
                                $this->intendedClass, 
                                $this->phone 
                            );

                            $this->output(
                                $this->addExerciseResult['status'], 
                                $this->addExerciseResult['status_code'], 
                                $this->addExerciseResult['body']['message'], 
                                '', 
                                []
                            );
                            
                        } else {
                            $this->output(
                                true, 200, 
                                $this->taskType . ' task has been added', 
                                $this->insert_Task_Into_TBL['info'], 
                                []
                            );
                        }
                    } else {
                        $this->output(
                            false, 501, 
                            'Sorry Task could not be created. Please try again', 
                            $this->insert_Task_Into_TBL['info'], []
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
$addTask = new addTask;
$addTask->main();
?>