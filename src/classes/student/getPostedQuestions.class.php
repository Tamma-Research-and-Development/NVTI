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
final class getPostedQuestions extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $studentDetails;
    private $id;
    private $fetch_questions_query;
    private $question_id;
    private $searchPhrase;
    private $posted_questions_array;

    public function main()
    {
     
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->studentDetails         =  parent::studentInfo();
            $this->id                     =  $this->studentDetails['id'];
            $this->fetch_questions_query  =  "";

            // fetch specific question
            if (!empty($_GET['id']) && empty($_GET['searchPhrase'])) {
                $this->question_id = $this->input($_GET['id'], STRICT_INPUT_FILTER);

                $this->fetch_questions_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'admin_account', 
                    [
                        " LEFT JOIN `ask_teacher` ",
                        " ON `ask_teacher`.teacherPhone =`admin_account`.Phone_number ",
                        " WHERE `ask_teacher`.id = '$this->question_id' "
                    ], 
                    []
                ); 
            } 
            // fetch using search phrase
            else if ( !empty($_GET['searchPhrase']) && empty($_GET['id']) ) {
                $this->searchPhrase = $this->input($_GET['searchPhrase'], STRICT_INPUT_FILTER);

                $this->fetch_questions_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'admin_account', 
                    [
                        " LEFT JOIN `ask_teacher` ",
                        " ON `ask_teacher`.teacherPhone =`admin_account`.Phone_number ",
                        " WHERE `ask_teacher`.Question LIKE '%$this->searchPhrase%'  "
                    ], 
                    []
                ); 
            }
            // disallow both parameters from being set simutinously
            else if (!empty($_GET['searchPhrase']) && !empty($_GET['id'])) {
                $this->output(false, 403, 'Set either: (searchPhrase), (id)', 'Forbidden', []);
            }
            // fetch all questions
            else {
                $this->fetch_questions_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'admin_account', 
                    [
                        " LEFT JOIN `ask_teacher` ",
                        " ON `ask_teacher`.teacherPhone =`admin_account`.Phone_number ",
                        " WHERE `ask_teacher`.studentId = '$this->id'  "
                    ], 
                    []
                ); 
            }

            if ($this->fetch_questions_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Question fetch failed', 
                    $this->fetch_questions_query['info'], []
                );
            } else {
                if ($this->fetch_questions_query['total'] > 0) {
                    $this->posted_questions_array = [];
                    
                    while ( $row = $this->fetch_questions_query['result']->fetch_assoc() ) {
                        $this->posted_questions_array[] = [
                            'id'                  =>  $row['id'],
                            'studentName'         =>  $row['studentName'],
                            'intended_subject'    =>  $row['Qsubject'],
                            'student_question'    =>  $row['Question'],
                            'teacher_answer'      =>  $row['teacher_response'],
                            'teacher_first_name'  =>  $row['First_Name'],
                            'teacher_last_name'   =>  $row['Last_Name'],
                            'teacher_phone'       =>  $row['teacherPhone'],
                            'teacher_gender'      =>  $row['Gender']
                        ];
                    }
                    
                    $this->output(
                        true, 200, 
                        $this->fetch_questions_query['total'] . ' posted questions found', 
                        $this->fetch_questions_query['info'], 
                        [$this->posted_questions_array]
                    );
                } else {
                    $this->output(
                        false, 404, 
                        'No questions found', 
                        $this->fetch_questions_query['info'], []
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
$getPostedQuestions = new getPostedQuestions;
$getPostedQuestions->main();
?>