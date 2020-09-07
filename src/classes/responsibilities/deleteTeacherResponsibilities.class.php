

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
final class deleteTeacherResponsibilities
{
    use apiResponseManager, queryBuilder, io_stream;

    private $employee_id;
    private $responsibilityList = [];
    private $deleteResponsibility;
    private $params = [
        '(id)', 
    ];

    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if ( empty($_POST['id']) ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } 
            else if( is_numeric($_POST['id']) == false) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).' to an integer', 
                    'Bad Request', []
                );
            }
            else  {
                $this->employee_id  =  $this->input($_POST['id'], STRICT_INPUT_FILTER);
                // 
                $this->deleteResponsibility = $this->deleteRec( 
                    database::$conn, 
                    'teacher_responsibilities', 
                    [" `t_r_id` = '$this->employee_id' "] 
                );

                // success
                if ( $this->deleteResponsibility['status'] == true ) {
                    // 
                    if ( $this->deleteResponsibility['total'] > 0 ) {
                        $this->output(
                            true, 200,
                            'Responsibility Removed',
                            $this->deleteResponsibility['info'], []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'Unknown Id', 
                            $this->deleteResponsibility['info'], []
                        );
                    }
                }
                // failed 
                else { 
                    $this->output(
                        false, 500, 
                        'Teacher Responsibility removal failed', 
                        $this->deleteResponsibility['info'], []
                    );
                }
            }
        }
        else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
}
$deleteTeacherResponsibilities = new deleteTeacherResponsibilities;
$deleteTeacherResponsibilities->main();
?>

