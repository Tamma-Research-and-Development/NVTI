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
final class changeFeedbackStatus
{
    use apiResponseManager, queryBuilder, io_stream;

    private $record_id;
    private $newStatus;
    private $newStatus_validator;
    private $update_feedback_query;
    private $params = [
        '(record_id)', 
        '(newStatus)'
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['record_id']) || empty($_POST['newStatus'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->record_id  =  $this->input($_POST['record_id'], STRICT_INPUT_FILTER);
                $this->newStatus  =  $this->input($_POST['newStatus'], STRICT_INPUT_FILTER);

                $this->newStatus_validator = ( 
                    $this->newStatus == 'new' ||  
                    $this->newStatus == 'seen' ||  
                    $this->newStatus == 'resolving' ||  
                    $this->newStatus == 'resolved' ||  
                    $this->newStatus == 'ignore' 
                ) ? true : false ;

                if ($this->newStatus_validator == false) {
                    $this->output(
                        false, 403, 
                        'Set: (newStatus) to {new/seen/resolving/resolved/ignore}', 
                        'Forbidden', []
                    );
                } else {
                    
                    $this->update_feedback_query = $this->updateTBL( 
                        database::$conn,
                        'feedback', 
                        [
                            " `status` = '$this->newStatus' ",
                            " WHERE `id` = '$this->record_id' "
                        ]
                    );
                    
                    if ($this->update_feedback_query['status'] == false) {
                        $this->output(
                            false, 500, 
                            'fedback change error', 
                            $this->update_feedback_query['info'], []
                        );
                    } else {
                        if ($this->update_feedback_query['total'] > 0) {
                            $this->output(
                                true, 200, 
                                'Feedback status updated', 
                                $this->update_feedback_query['info'], []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'No changes made', 
                                $this->update_feedback_query['info'], []
                            );
                        }
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
$changeFeedbackStatus = new changeFeedbackStatus;
$changeFeedbackStatus->main();
?>