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
final class deleteTask extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $teacherData;
    private $phone;
    private $task_id;
    private $delete_Task;
    private $params = [ 
        '(task_id)' 
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['task_id'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->teacherData  =  parent::teacherInfo();
                $this->phone        =  $this->teacherData[0]['Phone_number'];
                $this->task_id      =  $this->input($_POST['task_id'], STRICT_INPUT_FILTER);
                
                $this->delete_Task = $this->deleteRec( 
                    database::$conn, 
                    'task', 
                    [" `id` = '$this->task_id' ", " AND `addedBy` = '$this->phone' " ]
                );                

                if ($this->delete_Task['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry task could not be deleted', 
                        $delete_Task['info'], []
                    );
                } else {
                    if ($this->delete_Task['total'] > 0) {
                        $this->output(
                            true, 200, 
                            '1 task deleted', 
                            $this->delete_Task['info'], []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'Sorry task could not be deleted', 
                            $this->delete_Task['info'], []
                        );
                    }
                }
            }
        } else {
            $this->output(
                false, 
                405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
} // END class ClassName 
// 
$deleteTask = new deleteTask;
$deleteTask->main();
?>