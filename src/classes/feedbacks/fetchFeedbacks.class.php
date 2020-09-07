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
final class fetchFeedbacks
{
    use apiResponseManager, queryBuilder, io_stream;

    private $feedback_query;
    private $search_phrase;
    private $statusType;
    private $feedbackArray;

    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->feedback_query = '';
            
            if (!empty($_GET['searchPhrase'])) {
                $this->search_phrase = $this->input($_GET['searchPhrase'], STRICT_INPUT_FILTER);

                $this->feedback_query = $this->selectFromTBL ( database::$conn, [], 
                    'feedback', 
                    ["`feedback_provider` LIKE '%$this->search_phrase%'", "OR `feedback` LIKE '%$this->search_phrase%'"], 
                    []
                );  
            } else if (!empty($_GET['statusType'])) {
                $this->statusType = $this->input($_GET['statusType'], STRICT_INPUT_FILTER); 

                $this->feedback_query= $this->selectFromTBL ( database::$conn, [], 'feedback', 
                    [" `status` = '$this->statusType' "], [] 
                );  
            } else {
                $this->feedback_query = $this->selectFromTBL ( database::$conn, [], 'feedback', [], [] );  
            }

            // catch upon fail
            if ($this->feedback_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'feedback fetch error', 
                    $this->feedback_query['info'], []
                );
            } else {
                
                if ($this->feedback_query['total'] > 0) {

                    $this->feedbackArray = [];

                    while ($row = $this->feedback_query['result']->fetch_assoc()) {
                        $this->feedbackArray[] = [
                            'record_id'   =>  $row['id'],
                            'first_name'  =>  $row['first_name'],
                            'last_name'   =>  $row['last_name'],
                            'email'       =>  $row['email'],
                            'mobile'      =>  $row['mobile'],
                            'message'     =>  $row['message'],
                            'postedOn'    =>  $row['submitted_at'],
                            'status'      =>  $row['status']
                        ];
                    }
                    
                    $this->output(
                        true, 200, 
                        $this->feedback_query['total'].' feedback(s) found', 
                        $this->feedback_query['info'], [$this->feedbackArray]
                    );
                    
                } else {
                    $this->output(
                        false, 404, 
                        'Sorry feedbacks could not be retrieved', 
                        $this->feedback_query['info'], []
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
$fetchFeedbacks = new fetchFeedbacks;
$fetchFeedbacks->main();
?>