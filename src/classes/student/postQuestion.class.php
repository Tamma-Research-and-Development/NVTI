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
final class postQuestion extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $studentDetails;
    private $studentId;
    private $studentName;
    private $school;
    private $class;
    private $Qsubject;
    private $Question;
    private $get_Teachers_Info_Query;
    private $teacher_data_array;
    private $teachers_phone_number;
    private $post_new_question_query;
    private $params = [
        '(class)', 
        '(subject)', 
        '(Question)'
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            if (
                empty($_POST['class'])  ||
                empty($_POST['subject']) ||
                empty($_POST['Question']) 
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                
                $this->studentDetails  =  parent::studentInfo();
                $this->studentId       =  $this->studentDetails['id'];
                $this->studentName     =  $this->studentDetails['Fullname'];
                $this->school          =  $this->studentDetails['school'];

                $this->class           =  $this->input($_POST['class'], STRICT_INPUT_FILTER);
                $this->Qsubject        =  $this->input($_POST['subject'], STRICT_INPUT_FILTER);
                $this->Question        =  $this->input($_POST['Question'], STRICT_INPUT_FILTER);
                 
                $this->get_Teachers_Info_Query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'admin_account', 
                    [
                        " `School_Teaching` = '$this->school' ", 
                        " AND `subject` LIKE '%$this->Qsubject%' ", 
                        " AND `classes_taught`  LIKE '%$this->class%' "
                    ], 
                    []
                );  
                
                if ($this->get_Teachers_Info_Query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Teacher data retrieval failed', 
                        $this->get_Teachers_Info_Query['info'], 
                        []
                    );
                } else {
                    if ($this->get_Teachers_Info_Query['total'] > 0) {

                        $this->teacher_data_array     =  $this->get_Teachers_Info_Query['result']->fetch_assoc();
                        $this->teachers_phone_number  =  $this->teacher_data_array['Phone_number'];

                        $this->post_new_question_query = $this->insertIntoTBL ( 
                            database::$conn, 'ask_teacher', 
                            [ 
                                'studentId', 
                                'studentName', 
                                'teacherPhone', 
                                'class', 
                                'Qsubject', 
                                'Question' 
                            ], 
                            [ 
                                $this->studentId, 
                                $this->studentName, 
                                $this->teachers_phone_number, 
                                $this->class, 
                                $this->Qsubject, 
                                $this->Question 
                            ] 
                        );

                        if ($this->post_new_question_query['status'] == false) {
                            $this->output(
                                false, 500, 
                                'Question post failed', 
                                $this->get_Teachers_Info_Query['info'], 
                                []
                            );
                        } else {
                            
                            if ( $this->post_new_question_query['total'] == 1 ) {
                                $this->output(
                                    true, 200, 
                                    '1 question added', 
                                    $this->get_Teachers_Info_Query['info'], 
                                    []
                                );
                            } else {
                                $this->output(
                                    false, 501, 
                                    'Question post failed', 
                                    $this->get_Teachers_Info_Query['info'], 
                                    []
                                );
                            }
                        }
                    } else {
                        $this->output(
                            false, 404, 
                            'Sorry, no available teacher', 
                            $this->get_Teachers_Info_Query['info'], 
                            []
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
$postQuestion = new postQuestion;
$postQuestion->main();
?>