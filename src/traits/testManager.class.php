<?php 
header('Content-Type: Application/json');
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
require("../../db.inc.php");
require("../../autoload_compiler.inc.php");
require("../studentDetails.class.php");
require("checkAnswers.trait.php");
require('gradesManager.trait.php');
/**
* undocumented class
*
* @package default
* @author 
**/
class testManager extends studentDetails
{
    use checkAnswers, gradesManager, apiResponseManager, io_stream;

    private $studentDetails;
    private $testTaker;
    private $class;
    private $school;
    private $student_user_name;
    private $subject;
    private $teachersPhone;
    private $test_result;
    private $grade_entry_feedback;
    private $params = [
        "(subject)",
        "(teachersPhone)",
        "(questions)",
        "(userSelectedOptions)",
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_POST['subject'])             ||
                empty($_POST['teachersPhone'])       ||
                empty($_POST['questions'])           ||
                empty($_POST['userSelectedOptions']) 
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->studentDetails     =  parent::studentInfo();
                $this->testTaker          =  $this->studentDetails['Fullname'];
                $this->class              =  $this->studentDetails['class'];
                $this->school             =  $this->studentDetails['school'];
                $this->student_user_name  =  $this->studentDetails['UserName'];

                $this->subject            =  io_stream::input($_POST['subject'], STRICT_INPUT_FILTER);
                $this->teachersPhone      =  io_stream::input($_POST['teachersPhone'], STRICT_INPUT_FILTER);

                // evalute test taker answers
                $this->test_result = checkAnswers::correctAnswers(
                    $this->testTaker, 
                    $this->class, 
                    $this->subject, 
                    $this->school, 
                    $this->teachersPhone
                );

                // test taker passed so save grade
                if ($this->test_result['score'] > 69) {
                    $this->grade_entry_feedback = gradesManager::save_Grade( 
                        $this->student_user_name, 
                        $this->testTaker, 
                        $this->class, 
                        $this->subject, 
                        $this->test_result['score'], 
                        $this->school, 
                        $this->teachersPhone 
                    );
                    // clear to proceed
                    if ( $this->grade_entry_feedback['status'] == true ) {
                        $test_result['test_completion'] = true;
                        return print json_encode($this->test_result, JSON_PRETTY_PRINT);
                    } else {
                        return print json_encode($this->grade_entry_feedback, JSON_PRETTY_PRINT);
                    }
                }
                // test taker did not pass do not save grade
                else {
                    $this->test_result['test_completion'] = false;
                    return print json_encode($this->test_result, JSON_PRETTY_PRINT);
                }
            }
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', 
                []
            );
        }
    }
} // END class ClassName 
// 
$testManager = new testManager();
$testManager->main();
?>