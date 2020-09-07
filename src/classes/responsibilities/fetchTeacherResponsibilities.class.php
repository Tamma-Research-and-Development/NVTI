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
final class fetchTeacherResponsibilities
{
    use apiResponseManager, queryBuilder, io_stream;

    private $employee_id;
    private $responsibilityList = [];
    private $fetchResponsibility;
    private $params = [
        '(employee_id)', 
    ];

    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            if ( empty($_GET['employee_id']) ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else  {
                $this->employee_id  =  $this->input($_GET['employee_id'], STRICT_INPUT_FILTER);
                // build query
                $this->fetchResponsibility = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 'teacher_responsibilities', 
                    [" `employee_id` = '$this->employee_id' "], []
                );  
                // success
                if ( $this->fetchResponsibility['status'] == true ) {  
                    // 
                    if ( $this->fetchResponsibility['total'] > 0 ) {
                        while ( $data = $this->fetchResponsibility['result']->fetch_assoc() ) {
                            $this->responsibilityList[] = [
                                'id'         => $data['t_r_id'],
                                'trade_area' => $data['trade_area'],
                                'subjects'   => explode(',', $data['subject']),
                                'section'    => $data['section'],
                            ];
                        }
                        $this->output(
                            true, 200, 
                            'Teacher Responsibility Found', 
                            $this->fetchResponsibility['info'], $this->responsibilityList
                        );
                    } else {
                        $this->output(
                            false, 404, 
                            '0 Teacher Responsibility Found', 
                            $this->fetchResponsibility['info'], []
                        );
                    }
                }
                // failed 
                else { 
                    $this->output(
                        false, 500, 
                        'Teacher Responsibility retrieval failed', 
                        $this->fetchResponsibility['info'], []
                    );
                }
            }
        }
        else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
}
$fetchTeacherResponsibilities = new fetchTeacherResponsibilities;
$fetchTeacherResponsibilities->main();
?>

