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
final class studentQuestionChart extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $teacherData;
    private $classes;
    private $phone;
    private $classArr;
    private $statsData;
    private $all_questions_query;
    private $answered_questions_query;
    private $total;
    private $totalNoAnwer;
    private $teacher_response;

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->teacherData  =  parent::teacherInfo();
            $this->classes      =  $this->teacherData[0]['classes_taught'];
            $this->phone        =  $this->teacherData[0]['Phone_number'];
            $this->classArr     =  explode(';', $this->classes);
            
            $this->statsData = [];
            for ($index=0; $index < count($this->classArr)-1; $index++) { 
                $class = $this->classArr[$index];

                // questions
                $this->all_questions_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [" COUNT(*), teacher_response "], 
                    'ask_teacher',  
                    [" teacherPhone = '$this->phone' "], 
                    []
                ); 

                // questions without answers
                $this->answered_questions_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [" COUNT(*), teacher_response "], 
                    'ask_teacher',  
                    [" teacherPhone = '$this->phone' ", "AND teacher_response = '' "], 
                    []
                ); 

            }
            
            if ($this->all_questions_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Sorry Student Questions statistics could not be fetched', 
                    $this->all_questions_query['info'], []
                );
            } else {
                $row                      =  $this->all_questions_query['result']->fetch_assoc();
                $row2                     =  $this->answered_questions_query['result']->fetch_assoc();
                $this->total              =  $row['COUNT(*)'];
                $this->totalNoAnwer       =  $row2['COUNT(*)'];
                $this->teacher_response   =  $row['teacher_response'];
                
                if ($this->total == 0) {
                    $this->statsData = [ 0, 0 ];
                } else {
                    $this->statsData = [
                        ($this->total - $this->totalNoAnwer),
                        (int)$this->totalNoAnwer
                    ];
                }
                
                $this->output(
                    true, 200, 
                    'Student question statistics successfully generated', 
                    $this->all_questions_query['info'], 
                    [
                        'chart_data' => [
                            'label' => 'The Overall Ratio Of Answered to Un-Answered Question',
                            'labels' => [
                                'Answered', 'Un-Answered'
                            ],
                            'data' => $this->statsData
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
$studentQuestionChart = new studentQuestionChart;
$studentQuestionChart->main();
?>