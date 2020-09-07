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
final class taskSummary extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $student_data_array;
    private $school;
    private $subject;
    private $fetch_subjects_query;
    private $task_summary_array;
    private $task_summary_query;
    private $task_summary_result;
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->student_data_array =  parent::studentInfo();
            $this->school       =  $this->student_data_array['school'];
            
            $this->fetch_subjects_query = $this->selectFromTBL ( 
                database::$conn, [" distinct `subject`, `intendedSchool` "], 
                'task', 
                [" `intendedSchool` = '$this->school' "], 
                []
            ); 

            if ($this->fetch_subjects_query['status'] == false) {
                $this->output(
                    false, 400, 
                    'Could not retrieve subject list', 
                    $this->fetch_subjects_query['info'], []
                );
            } else {
                if ($this->fetch_subjects_query['total'] > 0) {
                    
                    $this->subject = [];
                    while ( $row = $this->fetch_subjects_query['result']->fetch_assoc() ) {
                        $this->subject[] =  $row['subject'];
                    }
                    
                    $this->task_summary_result = $this->get_task_summary($this->subject, $this->school);
                
                    $this->output(
                        true, 200, 
                        'Task summary List', 
                        $this->fetch_subjects_query['info'], 
                        [$this->task_summary_result]
                    );

                } else {
                    $this->output(
                        false, 404, 
                        '0 records found', 
                        $this->fetch_subjects_query['info'], 
                        []
                    );
                }
            }
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', 
                []
            );
        }
    }

    private function get_task_summary(Array $subjects, String $school) {
        
        $this->task_summary_array = $query_error_info = [];
        $query_error_counter = 0;

        for ($i=0; $i < count($subjects); $i++) { 
            $subject = $subjects[$i];

            $this->task_summary_query = $this->selectFromTBL ( 
                database::$conn, [" distinct `subject`, `intendedSchool` "], 
                'task', 
                [
                    " `intendedSchool` = '$school' ", 
                    " AND `subject` = '$subject' "
                ], []
            ); 
            
            if ($this->task_summary_query['status'] == false) {
                $query_error_counter += 1;
                $query_error_info[] = $this->task_summary_query['info'];
            } else {
                if ($this->task_summary_query['total'] > 0) {
                    $this->task_summary_array[] = [
                        'subject' => $subject, 
                        'total' => $this->task_summary_query['total']
                    ];
                } else {
                    $query_error_counter += 1;
                    $query_error_info[] = $this->task_summary_query['info'];
                }
            }
        }

        if ($query_error_counter == 0) {
            return $this->task_summary_array;
        } else {
            $this->output( 
                false, 500, 'Subjects stats retrieval failed', 
                implode(' ', $query_error_info), 
                [] 
            );  
            die();
        }
        
    }

} // END class ClassName 
// 
$taskSummary = new taskSummary;
$taskSummary->main();
?>