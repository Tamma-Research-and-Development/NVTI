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
final class fetchStudentsInquiry extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $question_id;
    private $teacherData;
    private $Phone_number;
    private $fetch_question_query;
    private $studentsInquiryArray = [];
    private $newQuestions         = 0;

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->fetch_question_query = '';
             
            if (!empty($_GET['id'])) {
                $this->question_id = $this->input($_GET['id'], STRICT_INPUT_FILTER);

                $this->fetch_question_query = $this->selectFromTBL ( 
                    database::$conn, [], 'ask_teacher', [" `id` = '$this->question_id' "], []
                ); 
            } else {
                $this->teacherData   =  parent::teacherInfo();
                $this->Phone_number  =  $this->teacherData[0]['Phone_number'];

                $this->fetch_question_query = $this->selectFromTBL ( 
                    database::$conn, [], 'ask_teacher', [" `teacherPhone` = '$this->Phone_number' "], []
                ); 
            }
            
            if ( $this->fetch_question_query['status'] == false ) {
                $this->output(
                    false, 500, 'Students Inquiry retrieval failed', 
                    $this->fetch_question_query['info'], []
                );
            } else {
                if ($this->fetch_question_query['total'] > 0 ) {
                    
                    while ($row = $this->fetch_question_query['result']->fetch_assoc()) {
                        
                        $this->newQuestions = ( empty($row["teacher_response"]) ) ? ($this->newQuestions+1) : ($this->newQuestions+0) ;

                        $this->studentsInquiryArray[] = [
                            'ids'          =>  $row["id"],
                            'studentName'  =>  $row["studentName"],
                            'questions'    =>  $this->input($row["Question"], OUTPUT_FILTER),
                            'reponses'     =>  $row["teacher_response"]
                        ];
                    }

                    $this->output(
                        true, 200, 
                        $this->newQuestions.' new questions out of '.$this->fetch_question_query['total'].' questions retrieved', 
                        $this->fetch_question_query['info'], 
                        [
                            'unanswered_questions' => $this->newQuestions,
                            'data' => $this->studentsInquiryArray
                        ]
                    );

                } else {
                    $this->output(
                        false, 404, 
                        '0 inquiries found', 
                        $this->fetch_question_query['info'], []
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
$fetchStudentsInquiry = new fetchStudentsInquiry;
$fetchStudentsInquiry->main();
?>