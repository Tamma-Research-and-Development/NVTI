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
final class studentPopulationPerClassChart extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;
    


    private $teacherData;
    private $classes;
    private $School;
    private $classArr;

    private $student_stats_query;
    private $student_data_query;

    private $statsData = [];
    private $lables = [];
    private $data = [];
    private $studentDataset = [];
    private $params = [
        '(studentPopulation)'
    ];
    private $query_status;


    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          
            $this->teacherData  =  parent::teacherInfo();
            $this->classes      =  $this->teacherData[0]['classes_taught'];
            $this->School       =  $this->teacherData[0]['School_Teaching'];
            $this->classArr     =  explode(';', $this->classes);

            for ($index=0; $index < count($this->classArr)-1; $index++) { 
                $class = $this->classArr[$index];
                
                $this->student_stats_query = $this->selectFromTBL ( 
                    database::$conn, ['COUNT(*)'], 
                    'participants', 
                    [ " school = '$this->School' ", "AND class = '$class' ", "AND `deleted` = '0' " ], []
                ); 

                $this->student_data_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', 
                    [ " school = '$this->School' ", "AND class = '$class' ", "AND `deleted` = '0' " ], []
                ); 
                
                if ($this->student_stats_query['status'] == false) {
                    $this->query_status = 500;
                    break;
                } else {
                    if ($this->student_stats_query['total'] > 0) {

                        while ( $row1 = $this->student_data_query['result']->fetch_assoc() ) {
                            $this->studentDataset[] = [
                                'Fullname' => $row1['Fullname'],
                                'Mobile'   => $row1['Mobile'],
                                'Age'      => $row1['Age'],
                            ];
                        }
                        
                        while ( $row = $this->student_stats_query['result']->fetch_assoc() ) {
                            $this->statsData[] = [
                                'class'          => $class,
                                'totalStudents'  => (int)$row['COUNT(*)'],
                                'studentList'    => $this->studentDataset
                            ];

                            $this->studentDataset = [];

                            // setup data for chart  
                            $this->lables[] = $class;
                            $this->data[]   = (int)$row['COUNT(*)'];
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
                    'Sorry Student Population statistics could not be fetched', 
                    $this->student_stats_query['info'], []
                ); 
            } elseif ( $this->query_status == 404 ) {
                $this->output(
                    false, 404, 
                    'Student population statistics not generated due to absence of data', 
                    $this->student_stats_query['info'], []
                );
            } else {
                $this->output(
                    true, 200, 
                    'Student population statistics successfully generated', 
                    $this->student_data_query['info'], 
                    [
                        'chart_data' => [
                            'label' => 'Student Population Per Class',
                            'labels' => $this->lables,
                            'data' => $this->data
                        ],
                        'regular_data' => $this->statsData
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
$studentPopulationPerClassChart = new studentPopulationPerClassChart;
$studentPopulationPerClassChart->main();
?>