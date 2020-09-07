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

final class getPreference
{
    use apiResponseManager, io_stream, queryBuilder;

    private $getPreferenceQuery;

    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')  {
            // 
            $this->getPreferenceQuery = $this->selectFromTBL ( database::$conn, [], 'notification', [], [] );
            // 
            if ( $this->getPreferenceQuery['status'] == false ) {
                $this->output(
                    false, 500, 
                    'Notification preference retrieval failed', 
                    $this->getPreferenceQuery['info'], []
                );
            } else {
                if ($this->getPreferenceQuery['total'] > 0) {
                    $this->output(
                        true, 200, 
                        'Notification preference retrieval successful', 
                        $this->getPreferenceQuery['info'], 
                        [
                            'notification' => [
                                'type' => $this->getPreferenceQuery['result']->fetch_object()->preference
                            ]
                        ]
                    );
                } else {
                    $this->output(
                        false, 404, 
                        'Notification preference not set', 
                        $this->getPreferenceQuery['info'], []
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
}
// END class ClassName 
// 
$getPreference = new getPreference;
$getPreference->main();

?>