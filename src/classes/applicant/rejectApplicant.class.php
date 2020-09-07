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

final class rejectApplicant extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $removeApplicantQuery;
    private $params = [
        'applicant_id',
        'name',
        'contacts',
        'rejectionMessage',
    ];

    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            // 
            if ( parent::teacherInfo()[0]['accountType'] === STAFF_ACCOUNT['admission'] ) {
                if (
                    empty($_POST['applicant_id'])     ||
                    empty($_POST['name'])     ||
                    empty($_POST['contacts'])         ||
                    empty($_POST['rejectionMessage']) 
                ) { 
                    $this->output(
                        false, 400, 
                        'Set: '.implode(',', $this->params).'', 
                        'Bad Request ', []
                    );
                } else {
                    $id       =  $this->input($_POST['applicant_id'], STRICT_INPUT_FILTER);
                    $name     =  $this->input($_POST['name'], STRICT_INPUT_FILTER);
                    $email    =  $this->input($_POST['contacts']['email'], STRICT_INPUT_FILTER);
                    $mobile   =  $this->input($_POST['contacts']['mobile'], STRICT_INPUT_FILTER);
                    $message  =  $this->input($_POST['rejectionMessage'], STRICT_INPUT_FILTER);

                    // 
                    $notification_result = sendNotification::to([
                        'mobile'    => $mobile,
                        'email'     => ($email == "") ? 'none': $email,
                        'recipient' => $name,
                        'subject'   => 'Decline of application',
                        'body'      => $message
                    ]);

                    // 
                    if ( $notification_result['status'] == true ) {
                        // 
                        $this->removeApplicantQuery = $this->deleteRec( 
                            database::$conn, 'participants', ["id = '$id' "]
                        );
                        // 
                        if ( $this->removeApplicantQuery['status'] == false ) {
                            $this->output(
                                false, 500, 
                                'Unable to decline applicant', 
                                $this->removeApplicantQuery['info'], []
                            );
                        } else {
                            $this->output(
                                true, 200, 
                                $name.' decline successful', 
                                $this->removeApplicantQuery['info'], []
                            );
                        }
                    } else {
                        $this->output(
                            false, 501, 
                            $notification_result['body'], 
                            [], []
                        );
                    }
                }
            } else {
                $this->output(
                    false, 401, 
                    'Only authorized users can perform such action', 
                    'Unauthorized', []
                );
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
$rejectApplicant = new rejectApplicant;
$rejectApplicant->main();
?>