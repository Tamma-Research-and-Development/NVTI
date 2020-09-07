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
final class deleteCurriculumData
{
    use apiResponseManager, queryBuilder, io_stream, fileUploader;

    private $record_id;
    private $delete_data_query;

    private $params = [
        '(record_id)'
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['record_id'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->record_id = $this->input($_POST['record_id'], STRICT_INPUT_FILTER);

                $this->delete_data_query = $this->deleteRec( 
                    database::$conn, 
                    'curriculum', 
                    [" `id` = '$this->record_id' "]
                );
                
                if ($this->delete_data_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry this curriculum item could not be deleted', 
                        $this->delete_data_query['info'], []
                    );
                } else {
                    if ( $this->delete_data_query['total'] == 1 ) {
                        $this->output(
                            true, 200, 
                            '1 item removed', 
                            $this->delete_data_query['info'], []
                        );
                    } else {
                        $this->output(
                            false, 404, 
                            'Sorry this curriculum item could not be deleted', 
                            $this->delete_data_query['info'], []
                        );
                    }
                }
            }
            
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }

} // END class deleteCurriculumData 
// 
$deleteCurriculumData = new deleteCurriculumData();
$deleteCurriculumData->main();
?>