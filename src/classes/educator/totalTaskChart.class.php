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
final class totalTaskChart extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $teacherData;
    private $phone;
    private $School;

    private $taskTypeArr = [ 
        'Reading Exercise', 
        'Study Exercise', 
        'Pop Quiz', 
        'Homework' 
    ];
    private $statsData = [];
    private $taskCount = [];
    private $taskType;
    private $task_statistics_query;
    private $query_status;

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             
            $this->teacherData  =  parent::teacherInfo();
            $this->phone        =  $this->teacherData[0]['Phone_number'];
            $this->School       =  $this->teacherData[0]['School_Teaching'];

            for ($index=0; $index < count($this->taskTypeArr); $index++) { 
                $this->taskType = $this->taskTypeArr[$index];

                $this->task_statistics_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [" COUNT(*), `intendedClass`, `subject`, `taskDescription` "], 
                    'task',
                    [
                        "intendedSchool  = '$this->School'", 
                        "AND taskType   = '$this->taskType'", 
                        "AND addedBy    = '$this->phone'"
                    ], []
                ); 

                if ($this->task_statistics_query['status'] == false) {
                    $this->query_status = 500;
                    break;
                } else {
                    if ($this->task_statistics_query['total'] > 0) {
                        while ( $row = $this->task_statistics_query['result']->fetch_assoc() ) {
                            $this->taskCount[]  =  (int)$row['COUNT(*)'];
                        }
                    } else {
                        $this->query_status = 404;
                        break;
                    }
                }
            }

            if ( $this->query_status == 500 ) {
                $this->output(
                    false, 500, 
                    'Sorry Student exercise statistics could not be fetched', 
                    $this->task_statistics_query['info'], []
                );
            } elseif ( $this->query_status == 404 ) {
                $this->output(
                    false, 404, 
                    'Sorry Student exercise statistics not generated due to absence of data', 
                    $this->task_statistics_query['info'], []
                );
            } else {
                $this->output(
                    true, 200, 
                    'Student exercise statistics successfully generated', 
                    $this->task_statistics_query['info'], 
                    [
                        'chart_data' => [
                            'label' => 'Assigned Task',
                            'labels' => $this->taskTypeArr,
                            'data' => $this->taskCount,
                        ]
                    ]
                );
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
$totalTaskChart = new totalTaskChart;
$totalTaskChart->main();
?>