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
final class taskDetails extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $subject;
    private $school;
    private $class;
    private $taskArray;
    private $exerciseArray;
    private $fetch_taskDetails_query;
    private $fetch_exercise_query;
    private $params = [
        '(subject)'
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            if (empty($_GET['subject'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->subject = $this->input($_GET['subject'], STRICT_INPUT_FILTER);

                $student_data  = parent::studentInfo();

                if ($student_data['status'] == false) {
                    
                } else {
                    $this->school  = $student_data['school'];
                    $this->class   = $student_data['class'];
                }
                
                $this->fetch_taskDetails_query = $this->selectFromTBL ( 
                    database::$conn, [], 'task',  
                    [ " `intendedSchool` = '$this->school' ", 
                        " AND `intendedClass` = '$this->class' ",
                        " AND `subject` = '$this->subject' "
                    ], []
                ); 

                if ($this->fetch_taskDetails_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Tasks for retrieval failed', 
                        $this->fetch_taskDetails_query['info'], []
                    );
                } else {
                    if ($this->fetch_taskDetails_query['total'] > 0) {
                        $this->taskArray = [];
                        $this->exerciseArray = []; 

                        while ( $row = $this->fetch_taskDetails_query['result']->fetch_assoc() ) {
                            $id = $row['id'];

                            $this->fetch_exercise_query = $this->selectFromTBL ( 
                                database::$conn, [], 'exercise2',  
                                [ " `taskId` = '$id' " ], []
                            ); 

                            while ( $row2 = $this->fetch_exercise_query['result']->fetch_assoc() ) {
                                $this->exerciseArray[] = [
                                    'test_question' => $row2['test_question'],
                                    'WrongAnswer1'  => $row2['WrongAnswer1'],
                                    'WrongAnswer2'  => $row2['WrongAnswer2'],
                                    'WrongAnswer3'  => $row2['WrongAnswer3'],
                                    'CorrectAnswer' => $row2['CorrectAnswer']
                                ];
                            }
                            // task array with exercise attached
                            $this->taskArray[] = [
                                'taskType'         =>  $row['taskType'],
                                'subject'          =>  $row['subject'],
                                'taskDescription'  =>  $row['taskDescription'],
                                'files'            =>  $row['files'],
                                'exercise'         =>  $this->exerciseArray,
                                'addedBy'          =>  $row['addedBy']
                            ];
                            $this->exerciseArray = []; // clear current array value
                        
                        }

                        $this->output(
                            true, 200, 
                            'Available task', 
                            $this->fetch_exercise_query['info'], 
                            [$this->taskArray]
                        );

                    } else {
                        $this->output(
                            false, 404, 
                            '0 Tasks for '.$this->class.' '.$this->subject, 
                            $this->fetch_exercise_query['info'], 
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
$taskDetails = new taskDetails;
$taskDetails->main();
?>