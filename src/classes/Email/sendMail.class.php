<?php 
require $_SERVER["DOCUMENT_ROOT"].'/www/NVTI/libraries/external_packages/PHPMailer_5.2.4/class.phpmailer.php';
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

class sendMail
{
    use io_stream;
    
    // SEND MAIL
    public static function to(String $recipientEmail, String $recipientName, String $messageSubject, String $messageBody)
    {
        $mail = new PHPMailer;

        $mail->IsSMTP();                                               // Set mailer to use SMTP
        $mail->Host        = EMAIL_SERVICE['host'];                       // or sitename Specify main and backup server
        $mail->SMTPAuth    = true;                                     // Enable SMTP authentication
        $mail->Username    = EMAIL_SERVICE['username'];                   // SMTP username
        $mail->Password    = EMAIL_SERVICE['password'];                   // SMTP password
        $mail->SMTPSecure  = 'tls';                                    // Enable encryption, 'ssl' also accepted

        $mail->From        = EMAIL_SERVICE['from'];
        $mail->FromName    = EMAIL_SERVICE['fromName'];

        $mail->AddAddress($recipientEmail, $recipientName);            // Add a recipient
        $mail->IsHTML(true);                                           // Set email format to HTML

        $mail->Subject = $messageSubject;
        $mail->Body    = $messageBody;

        $mail->AltBody =  self::input($messageBody, STRICT_INPUT_FILTER);

        if(!$mail->Send()) {
            return [
                'status' => false,
                'body'   => "Email not sent. <b>Error: </b> ".$mail->ErrorInfo
            ];
        } else {
            return [
                'status' => true,
                'body'   => "Email sent"
            ];
        }
    }
}

$sendMail = new sendMail();

// Example:
// sendMail::to(
//     'mnimley6@gmail.com',  // email address
//     'Mikey',               // recipient name
//     'Test',                // subject
//     '1'                    // message body
// );


?>