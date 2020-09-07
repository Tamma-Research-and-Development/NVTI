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
final class deletePostedQuestion
{
    use apiResponseManager, queryBuilder, io_stream;

    private $question_id;
    private $delete_question_query;
    private $params = [
        '(question_id)'
    ];

    // 
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['question_id'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->question_id = $this->input($_POST['question_id'], STRICT_INPUT_FILTER);
                $this->delete_question_query = $this->deleteRec( database::$conn, 'ask_teacher', [" id = '$this->question_id' "] );
                
                if ($this->delete_question_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'question delete failed', 
                        $this->delete_question_query['info'], []
                    );
                } else {
                    if ($this->delete_question_query['total'] == 1) {
                        $this->output(
                            true, 200, 
                            '1 question has been deleted', 
                            $this->delete_question_query['info'], []
                        );
                    } else {
                        $this->output(
                            false, 404, 
                            'record with id of: '. $this->question_id .' does not exist', 
                            $this->delete_question_query['info'], []
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
$deletePostedQuestion = new deletePostedQuestion;
$deletePostedQuestion->main();
?>