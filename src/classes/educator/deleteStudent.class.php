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
final class deleteStudent extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $student_details;
    private $School_Teaching;
    private $student_id;
    private $find_student_query;
    private $student_delete_query;
    private $params = [
        '(student_id)'
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['student_id'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                 
                $this->student_details   =  parent::teacherInfo();
                $this->School_Teaching   =  $this->student_details[0]['School_Teaching'];
                $this->student_id        =  $this->input($_POST['student_id'], STRICT_INPUT_FILTER);
                
                $this->find_student_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', 
                    [" `id` = '$this->student_id' "], 
                    []
                ); 
                
                if ($this->find_student_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Student lookup failed', 
                        $this->find_student_query['info'], []
                    );
                } else {
                    if ($this->find_student_query['total'] > 0) {
                         
                        $this->student_delete_query = $this->deleteRec( 
                            database::$conn, 
                            'participants', 
                            [" `id` = '$this->student_id' "]
                        );                        

                        if ($this->student_delete_query['status'] == true) {
                            $this->output(
                                true, 200, 
                                'Student account removed', 
                                $this->find_student_query['info'], []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'Student account removal failed', 
                                $this->find_student_query['info'], []
                            );
                        }
                    } else {
                        $this->output(
                            false, 404, 
                            'The targeted account was not found', 
                            $this->find_student_query['info'], []
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
$deleteStudent = new deleteStudent();
$deleteStudent->main();
?>