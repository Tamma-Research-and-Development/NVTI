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

final class setPreference extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $newPreference;
    private $setPreferenceQuery;
    private $params = [
        'preference',
    ];

    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {

            if (empty($_POST['preference'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request ', []
                );
            } else {

                if ( in_array($_POST['preference'], NOTIFICATION_TYPES) ) {
                    // 
                    $this->newPreference = $this->input($_POST['preference'], STRICT_INPUT_FILTER);
                    // 
                    $this->setPreferenceQuery = $this->updateTBL( 
                        database::$conn, 
                        'notification',
                        [ " preference = '$this->newPreference' "]
                    );
                    // 
                    if ( $this->setPreferenceQuery['status'] == false ) {
                        $this->output(
                            false, 500, 
                            'Notification preference update failed', 
                            $this->setPreferenceQuery['info'], []
                        );
                    } else {
                        if ( $this->setPreferenceQuery['total'] > 0 ) {
                            $this->output(
                                true, 200, 
                                'Notification preference update successful', 
                                $this->setPreferenceQuery['info'], 
                                []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'Notification preference update implementation failed', 
                                $this->setPreferenceQuery['info'], []
                            );
                        }
                    }
                } else {
                    $this->output(
                        false, 400, 
                        'Set preference to either: '.implode(', ', NOTIFICATION_TYPES).'', 
                        'Bad Request ', []
                    );
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
}
// END class ClassName 
// 
$setPreference = new setPreference;
$setPreference->main();
?>