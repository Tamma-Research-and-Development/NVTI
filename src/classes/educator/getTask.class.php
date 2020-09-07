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
final class getTask extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $teacherData;
    private $task_id;
    private $phone;
    private $fetch_task_query = null;
    private $taskArray  =  [];
    private $task_and_exercise_data = [];
    private $fetch_associated_task_exercise_query;
    private $exercise = [];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->teacherData  =  parent::teacherInfo();
            $this->phone        =  $this->teacherData[0]['Phone_number'];

            if (empty($_GET['id'])) {
                $this->fetch_task_query = $this->selectFromTBL ( 
                    database::$conn, [], 'task', 
                    ["`addedBy` = '$this->phone'"], []
                );
            } else {
                $this->task_id = $this->input($_GET['id'], STRICT_INPUT_FILTER);
                $this->fetch_task_query = $this->selectFromTBL ( 
                    database::$conn, [], 'task', 
                    ["`addedBy` = '$this->phone'", " AND `id` = '$this->task_id'"], []
                );
            }

            if ($this->fetch_task_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Sorry task could not be fetched', 
                    $this->fetch_task_query['info'], []
                );
            } else {
                if ($this->fetch_task_query['total'] > 0) {

                    // fetch task without exercise
                    if (empty($_GET['id'])) {
                        
                        while ( $row = $this->fetch_task_query['result']->fetch_assoc() ) {
                            $this->taskArray[] = [
                                'id'              =>  $row["id"],
                                'taskType'        =>  $row["taskType"],
                                'intendedSchool'  =>  $row["intendedSchool"],
                                'intendedClass'   =>  $row["intendedClass"],
                                'subject'         =>  $row["subject"],
                                'files'           =>  FILE_UPLOAD_PATH.$row["files"],
                                'taskDescription' =>  $this->input($row["taskDescription"], OUTPUT_FILTER)
                            ];
                        }
                        
                        $this->output(
                            true, 200, 
                            'Task list retrieved', $this->fetch_task_query['info'], 
                            [ $this->taskArray ]
                        );

                    } 
                    // fetch specific task and exercises for edit
                    else {
                        
                        while ( $row = $this->fetch_task_query['result']->fetch_assoc() ) {
                            $this->task_id = $row["id"];
                            $this->fetch_associated_task_exercise_query = database::$conn->query(" SELECT * FROM `exercise2` WHERE `taskId` = '$this->task_id' ");
                            
                            $this->fetch_associated_task_exercise_query = $this->selectFromTBL ( 
                                database::$conn, [], 
                                'exercise2', 
                                [" `taskId` = '$this->task_id' "], []
                            );

                            while ( $row2 = $this->fetch_associated_task_exercise_query['result']->fetch_assoc() ) {
                                $this->exercise[] = [
                                    'question_id'   => $row2['id'],
                                    'test_question' => $this->input($row2['test_question'], OUTPUT_FILTER),
                                    'WrongAnswer1'  => $row2['WrongAnswer1'],
                                    'WrongAnswer2'  => $row2['WrongAnswer2'],
                                    'WrongAnswer3'  => $row2['WrongAnswer3'],
                                    'CorrectAnswer' => $row2['CorrectAnswer'],
                                ];
                            }
                            
                            $this->task_and_exercise_data[] = [
                                'id'              => $row["id"],
                                'taskType'        => $row["taskType"],
                                'intendedSchool'  => $row["intendedSchool"],
                                'intendedClass'   => $row["intendedClass"],
                                'subject'         => $row["subject"],
                                'files'           => $row["files"],
                                'taskDescription' => $this->input($row["taskDescription"], OUTPUT_FILTER),
                                'exercise'        => $this->exercise
                            ];
                            $this->exerciseArr = []; // clear array
                        }
                        
                        $this->output(
                            true, 200, 
                            'Task retrived along with exercise for edit', 
                            $this->fetch_task_query['info'], 
                            [ $this->task_and_exercise_data ]
                        );
                    }
                } else {
                    $this->output(
                        false, 404, 
                        'Sorry task could not be fetched', 
                        $this->fetch_task_query['info'], []
                    );
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
$getTask = new getTask;
$getTask->main();
?>