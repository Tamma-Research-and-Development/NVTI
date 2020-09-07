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
 *   2) Ephraim IC Doherty (d wise)
 *      @contact Phone: (+231) 770-964-566
 *      @contact Mail: ephraimdoherty.@gmail.com, ephraim.doherty@outlook.com, edoherty@tammacorp.com
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
final class assign_teacher_responsibilities extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $employee_id;
    private $department;
    private $trade_area;
    private $subject;
    private $addResponsibility;

    private $params = [
        '(employee_id)', 
        '(department)', 
        '(trade_area)', 
        '(subject)' 
    ];

    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_POST['employee_id'])    ||
                empty($_POST['department'])     ||
                empty($_POST['trade_area'])     ||
                empty($_POST['subject'])       
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else  {
                $this->employee_id      =   $this->input($_POST['employee_id'],  STRICT_INPUT_FILTER);
                $this->department       =   $this->input($_POST['department'],  STRICT_INPUT_FILTER);
                $this->trade_area       =   $this->input($_POST['trade_area'],  STRICT_INPUT_FILTER);
                $this->subject          =   $this->input($_POST['subject'],  STRICT_INPUT_FILTER, IS_ARRAY);
                
                // print_r($this->subject); exit;


                // # 1) INSERT STATEMENT
                $this->addResponsibility = $this->insertIntoTBL ( 
                    database::$conn, /* $database_connection_object */
                    'teacher_responsibilities', /* name of table eg: userTbl */ 
                    [ 
                        'employee_id',
                        'department',
                        'trade_area',
                        'subject',
                    ], 
                    [
                        $this->employee_id,
                        $this->department,
                        $this->trade_area,
                        implode(';', $this->subject)
                    ]
                );
                # success
                if ( $this->addResponsibility['status'] == true ) {  
                    $this->output(
                        true, 200, 
                        'Teacher Responsibility set', 
                        $this->addResponsibility['info'], [ ]
                    );
                }
                # failed 
                else { 
                    $this->output(
                        false, 500, 
                        'Notice: Teacher Responsibility not set', 
                        $this->addResponsibility['info'], []
                    );
                }

            }

        }
    }

}

$assign_teacher_responsibilities = new assign_teacher_responsibilities;
$assign_teacher_responsibilities->main();


?>

