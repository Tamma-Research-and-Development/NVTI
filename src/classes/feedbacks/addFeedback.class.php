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
// UserAccessControl::guardResource();
/**
* undocumented class
*
* @package default
* @author 
**/
final class addFeedback
{
    use apiResponseManager, queryBuilder, io_stream;

    private $first_name;
    private $last_name;
    private $email;
    private $mobile;
    private $message;
    private $add_feedback_query;
    private $params = [
        '(first_name)', 
        '(last_name)', 
        '(mobile)', 
        '(message)',
        '[Optional] (email)', 
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            if ( 
                empty($_POST['first_name']) ||
                empty($_POST['last_name'])  ||
                empty($_POST['mobile'])     ||
                empty($_POST['message'])
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->first_name   =  $this->input($_POST['first_name'], STRICT_INPUT_FILTER);
                $this->last_name    =  $this->input($_POST['last_name'], STRICT_INPUT_FILTER);
                $this->email        =  $this->input($_POST['email'], STRICT_INPUT_FILTER);
                $this->mobile       =  $this->input($_POST['mobile'], STRICT_INPUT_FILTER);
                $this->message      =  $this->input($_POST['message'], STRICT_INPUT_FILTER);

                // 
                $this->add_feedback_query = $this->insertIntoTBL ( database::$conn, 'feedback', 
                    [
                        'first_name', 
                        'last_name', 
                        'email', 
                        'mobile', 
                        'message', 
                        'submitted_at'
                    ], 
                    [
                        "$this->first_name", 
                        "$this->last_name", 
                        "$this->email", 
                        "$this->mobile", 
                        "$this->message", 
                        TIMESTAMP
                    ] 
                );                    

                if ($this->add_feedback_query['status'] == false) {
                    $this->output(
                        false, 501, 
                        'Feedback failed', 
                        $this->add_feedback_query['info'], []
                    );
                } else {
                    if ($this->add_feedback_query['total'] == 1) {
                        $this->output(
                            true, 201, 
                            'Thanks for sharing your feedback', 
                            '', []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'Feedback failed', 
                            $this->add_feedback_query['info'], []
                        );
                    }
                }
            }
        } else {
            $this->output(
                false, 400, 
                'Set: '.implode(',', $this->params).'', 
                'Bad Request', []
            );
        }
    }

} // END class ClassName 
// 
$addFeedback = new addFeedback;
$addFeedback->main();
?>