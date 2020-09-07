<?php 
/**
 * *********************************************************************************************************
 * @_forProject: M.O.E Survey Application | Developed By: TAMMA CORPORATION
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
final class deleteFeedback
{
    use apiResponseManager, queryBuilder, io_stream;

    private $record_id;
    private $feedback_removal_query;
    private $params = [
        '(record_id)'
    ];

    // 
    public function main()
    {
         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['record_id'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->record_id = $this->input($_POST['record_id'], STRICT_INPUT_FILTER);

                $this->feedback_removal_query = $this->deleteRec( database::$conn, 'feedback', [" `id` = '$this->record_id' "] );

                if ($this->feedback_removal_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'fedback delete error', 
                        $this->feedback_removal_query['info'], []
                    );
                } else {
                    if ($this->feedback_removal_query['total'] > 0) {
                        $this->output(
                            true, 200, 
                            '1 feedback removed', 
                            $this->feedback_removal_query['info'], []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'fedback not deleted', 
                            $this->feedback_removal_query['info'], []
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
$deleteFeedback = new deleteFeedback();
$deleteFeedback->main();
?>