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
final class replyToQuestion extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $question_id;
    private $message;
    private $update_response_query;
    private $params = [ '(question_id)',  '(message)' ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['question_id']) || 
                empty($_POST['message'])
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else  {
                $this->question_id = $this->input($_POST['question_id'], STRICT_INPUT_FILTER);
                $this->message     = $this->input($_POST['message'], STRICT_INPUT_FILTER);
                
                $this->update_response_query = $this->updateTBL( 
                    database::$conn, 'ask_teacher',
                    [" `teacher_response` = '$this->message' ", " WHERE `id`  = '$this->question_id' "]
                );

                if ($this->update_response_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Reply Failed', 
                        $this->update_response_query['info'], []
                    );
                } else {
                    if ($this->update_response_query['total'] > 0) {
                        $this->output(
                            true, 200, 
                            'Thanks for your response', 
                            $this->update_response_query['info'], []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'No changes made', 
                            $this->update_response_query['info'], []
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
$replyToQuestion = new replyToQuestion;
$replyToQuestion->main();
?>