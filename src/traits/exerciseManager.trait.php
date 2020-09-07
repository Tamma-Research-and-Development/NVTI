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

/**
* undocumented class
*
* @package default
* @author 
**/
trait exerciseManager
{
    private $param = [
        '(test_question)', 
        '(WrongAnswer1)', 
        '(WrongAnswer2)', 
        '(WrongAnswer3)', 
        '(CorrectAnswer)'
    ];

    public function addExercise(
        Array  $testData, 
        String $taskType, 
        String $taskId, 
        String $intendedSchool, 
        String $intendedClass, 
        String $phone
        )
    {
        $question_Bash_Pass_Counter = self::find_Question_Bash_With_Empty_Parameter($testData);

        // 1 or more exercise question bash failed evaluation 
        if ($question_Bash_Pass_Counter > 0) {
            return [
                'status' => false,
                'status_code' => 400,
                'body' => [
                    'message' => 'Set: '.implode(',', $this->param).''
                ]
            ];
        } else {
            $add_Exercise_Query  = "";
            
            for ($index=0; $index < count($testData); $index++) { 
                
                $test_question   =  htmlspecialchars(addslashes($testData[$index]["test_question"]));
                $Wrong_Answer1   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer1"]));
                $Wrong_Answer2   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer2"]));
                $Wrong_Answer3   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer3"]));
                $Correct_Answer  =  htmlspecialchars(addslashes($testData[$index]["CorrectAnswer"]));
    
                $insert_Exercise_Into_TBL = database::$conn->query(" INSERT INTO 
                    `exercise2` (
                        `taskId`,
                        `intendedSchool`,
                        `intendedClass`,
                        `addedBy`,
                        `test_question`,
                        `WrongAnswer1`,
                        `WrongAnswer2`,
                        `WrongAnswer3`,
                        `CorrectAnswer`
                    ) 
                    VALUE (
                        '$taskId',
                        '$intendedSchool',
                        '$intendedClass',
                        '$phone',
                        '$test_question',
                        '$Wrong_Answer1',
                        '$Wrong_Answer2',
                        '$Wrong_Answer3',
                        '$Correct_Answer'
                    )
                ");
            }

            

            if ($insert_Exercise_Into_TBL == true) {
                return [
                    'status' => true,
                    'status_code' => 200,
                    'body' => [
                        'message' => $taskType . ' task has been added along with a '.count($testData).' question exercise' 
                    ]
                ];
            } else {
                return [
                    'status' => false,
                    'status_code' => 501,
                    'body' => [
                        'message' => 'Sorry exercise could not be created'
                    ]
                ];
            }
        }
    }

    
    public function updateExercise(
        Array  $testData, 
        String $taskType, 
        String $taskId, 
        String $intendedSchool, 
        String $intendedClass, 
        String $phone
        ) 
    {
        $question_Bash_Pass_Counter = self::find_Question_Bash_With_Empty_Parameter($testData);

        // 1 or more exercise question bash failed evaluation 
        if ($question_Bash_Pass_Counter > 0) {
            return [
                'status' => false,
                'status_code' => 400,
                'body' => [
                    'message' => 'Set: '.implode(',', $this->param).''
                ]
            ];
        } else {
            
            for ($index=0; $index < count($testData); $index++) { 
                
                $question_id    =  htmlspecialchars(addslashes($testData[$index]["question_id"]));
                $test_question  =  htmlspecialchars(addslashes($testData[$index]["test_question"]));
                $WrongAnswer1   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer1"]));
                $WrongAnswer2   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer2"]));
                $WrongAnswer3   =  htmlspecialchars(addslashes($testData[$index]["WrongAnswer3"]));
                $CorrectAnswer  =  htmlspecialchars(addslashes($testData[$index]["CorrectAnswer"]));
                
                $update_Exercise_Query = database::$conn->query(" UPDATE `exercise2`
                    SET
                        `intendedSchool`  =  '$intendedSchool',
                        `intendedClass`   =  '$intendedClass',
                        `addedBy`         =  '$phone',
                        `test_question`   =  '$test_question',
                        `WrongAnswer1`    =  '$WrongAnswer1',
                        `WrongAnswer2`    =  '$WrongAnswer2',
                        `WrongAnswer3`    =  '$WrongAnswer3',
                        `CorrectAnswer`   =  '$CorrectAnswer'
                    WHERE
                        `id` = '$question_id'
                ");
            }
            if ($update_Exercise_Query == true) {
                return [
                    'status' => true,
                    'status_code' => 200,
                    'body' => [
                        'message' => $taskType . ' task had '.count($testData).' exercise question(s) updated' 
                    ]
                ];
            } else {
                return [
                    'status' => false,
                    'status_code' => 500,
                    'body' => [
                        'message' => 'Sorry ' . $taskType . ' question could not be updated'
                    ]
                ];
            }
        }
    }

    // evaluate and flag bash with empty parameter
    private function find_Question_Bash_With_Empty_Parameter(Array $testData) {
        $parameter_Evaluation_Pass_Counter = 0;
        
        for ($index=0; $index < count($testData); $index++) { 
            
            if (empty($testData[$index]["test_question"]) ||
                empty($testData[$index]["WrongAnswer1"]) ||
                empty($testData[$index]["WrongAnswer2"]) ||
                empty($testData[$index]["WrongAnswer3"]) ||
                empty($testData[$index]["CorrectAnswer"])
            ) {
                $parameter_Evaluation_Pass_Counter = ($parameter_Evaluation_Pass_Counter+1);
            } else {
                $parameter_Evaluation_Pass_Counter = ($parameter_Evaluation_Pass_Counter+0);
            }
        }
        return $parameter_Evaluation_Pass_Counter;
    }
} // END class ClassName 

?>