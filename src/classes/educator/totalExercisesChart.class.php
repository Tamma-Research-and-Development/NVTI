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
final class totalExercisesChart extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $teacherData;
    private $Phone;
    private $School;
    private $certificate_tbl_query;
    private $student_with_excellent_grades_query;
    private $student_with_good_grades_query;
    private $student_with_average_grades_query;
    private $student_with_need_improvement_grades_query;

    private $excellentDataset = [];
    private $goodDataset = [];
    private $averageDataset = [];
    private $need_improvementDataset = [];

    private $statsData;


    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->teacherData  =  parent::teacherInfo();
            $this->Phone        =  $this->teacherData[0]['Phone_number'];
            $this->School       =  $this->teacherData[0]['School_Teaching'];
            
            $this->certificate_tbl_query = $this->selectFromTBL ( 
                database::$conn, [], 'certificate', [], []
            ); 

            if ($this->certificate_tbl_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Sorry grades could not be acquired', 
                    $this->certificate_tbl_query['info'], []
                );
            } else {
                if ($this->certificate_tbl_query['total'] > 0) {
                    // excellent
                    $this->student_with_excellent_grades_query = $this->selectFromTBL ( 
                        database::$conn, [], 'certificate', 
                        ["`teacherPhone` = '$this->Phone'", "AND `school` = '$this->School'", "AND score BETWEEN 90 AND 100"], []
                    ); 
                    // good
                    $this->student_with_good_grades_query = $this->selectFromTBL ( 
                        database::$conn, [], 'certificate', 
                        ["`teacherPhone` = '$this->Phone'", "AND `school` = '$this->School'", "AND score BETWEEN 80 AND 89"], []
                    ); 
                    // average
                    $this->student_with_average_grades_query = $this->selectFromTBL ( 
                        database::$conn, [], 'certificate', 
                        ["`teacherPhone` = '$this->Phone'", "AND `school` = '$this->School'", "AND score BETWEEN 70 AND 79"], []
                    ); 
                    // need improvement
                    $this->student_with_need_improvement_grades_query = $this->selectFromTBL ( 
                        database::$conn, [], 'certificate', 
                        ["`teacherPhone` = '$this->Phone'", "AND `school` = '$this->School'", "AND score BETWEEN 0 AND 69"], []
                    ); 

                    
                    while ( $row = $this->student_with_excellent_grades_query['result']->fetch_assoc() ) {
                        $this->excellentDataset[] = [
                            'owner'    => $row['owner'],
                            'subject'  => $row['subject'],
                            'class'    => $row['class']
                        ];
                    }

                    while ( $row = $this->student_with_good_grades_query['result']->fetch_assoc() ) {
                        $this->goodDataset[] = [
                            'owner'    => $row['owner'],
                            'subject'  => $row['subject'],
                            'class'    => $row['class']
                        ];
                    }

                    while ( $row = $this->student_with_average_grades_query['result']->fetch_assoc() ) {
                        $this->averageDataset[] = [
                            'owner'    => $row['owner'],
                            'subject'  => $row['subject'],
                            'class'    => $row['class']
                        ];
                    }

                    while ( $row = $this->student_with_need_improvement_grades_query['result']->fetch_assoc() ) {
                        $this->need_improvementDataset[] = [
                            'owner'    => $row['owner'],
                            'subject'  => $row['subject'],
                            'class'    => $row['class']
                        ];
                    }


                    $this->statsData = [
                        [
                            'category' =>  'excellent',
                            'total'    =>  $this->student_with_excellent_grades_query['total'],
                            'dataset'  =>  $this->excellentDataset
                        ],
                        [
                            'category' =>  'good',
                            'total'    =>  $this->student_with_good_grades_query['total'],
                            'dataset'  =>  $this->goodDataset
                        ],
                        [
                            'category' =>  'average',
                            'total'    =>  $this->student_with_average_grades_query['total'],
                            'dataset'  =>  $this->averageDataset
                        ],
                        [
                            'category' =>  'need improvement',
                            'total'    =>  $this->student_with_need_improvement_grades_query['total'],
                            'dataset'  =>  $this->need_improvementDataset
                        ]
                    ];

                    $this->output(
                        true, 200, 
                        'Student exercise statistics successfully generated', 
                        $this->certificate_tbl_query['info'], 
                        [
                            'chart_data' => [
                                'label' => 'Students Performance On Exercises',
                                'labels' => [
                                    'excellent', 
                                    'good', 
                                    'average', 
                                    'need improvement'
                                ],
                                'data' => [
                                    $this->student_with_excellent_grades_query['total'], 
                                    $this->student_with_good_grades_query['total'], 
                                    $this->student_with_average_grades_query['total'], 
                                    $this->student_with_need_improvement_grades_query['total']
                                ],
                            ],
                            'regular_data' => $this->statsData
                        ]
                    );

                } else {
                    $this->output(
                        false, 404, 
                        'Student exercise statistics not generated due to absence of data', 
                        $this->certificate_tbl_query['info'], 
                        []
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
$totalExercisesChart = new totalExercisesChart;
$totalExercisesChart->main();
?>