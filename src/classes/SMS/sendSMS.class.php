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

final class sendSMS
{
    public static function to($post_body) {
        $ch = curl_init( );
        $headers = array(
            'Content-Type:application/json',
            'Authorization:Basic '. base64_encode(SMS_SERVICE['username'].':'.SMS_SERVICE['password'])
        );
        curl_setopt ( $ch,   CURLOPT_HTTPHEADER, $headers);
        curl_setopt ( $ch,   CURLOPT_URL, SMS_SERVICE['url']);
        curl_setopt ( $ch,   CURLOPT_POST, 1 );
        curl_setopt ( $ch,   CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch,   CURLOPT_POSTFIELDS, $post_body );
        // Allow cUrl functions 20 seconds to execute
        curl_setopt ( $ch,   CURLOPT_TIMEOUT, 20 );
        // Wait 10 seconds while trying to connect
        curl_setopt ( $ch,   CURLOPT_CONNECTTIMEOUT, 10 );

        $output                      =  array();
        $output['server_response']   =  curl_exec($ch);
        $curl_info                   =  curl_getinfo($ch);
        $output['http_status']       =  $curl_info['http_code'];
        $output['error']             =  curl_error($ch);
        curl_close( $ch );

        if ($output['http_status'] != 201) {
            return [
                'status' => false,
                'body'   => "SMS not sent. <b>Error: </b> ".$output['error']
            ];
        } else {
            return [
                'status' => true,
                'body'   => "SMS sent"
            ];
        }      
    }
}
// END class ClassName 
// 
// $sendSMS = new sendSMS;

/**
 * Implementations
 */

// $messages  = [
//   [
//     'from'         => 'SchoolMaSS',
//     'to'           => '231'.$newNumber,
//     'body'         => 'Your Parent Account Login Email is: '.$ParentEmail.' and your Password Is: '. $ParentMobile,
//     'routingGroup' => 'STANDARD'
//   ]
// ];

// $result = sendSMS::to( json_encode($messages) );

?>