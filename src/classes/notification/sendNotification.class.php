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

final class sendNotification
{
    use io_stream, queryBuilder;

    private static $contentMatchCounter  =  0;
    private static $getPreferenceQuery;
    private static $params = [
        'mobile',
        'email',
        'recipient',
        'subject',
        'body'
    ];

    public static function to(Array $content): array {
        
        if (count($content) == 5) {
            $keys  =  array_keys($content);
            // 
            for ($i=0; $i < count($keys); $i++) { 
                // ensure only the correct parameters are set
                if ( in_array($keys[$i], self::$params) ) {
                    // ensure all parameter value is set
                    if ( $content[$keys[$i]] == "" ) {
                        return [
                            $keys[$i]. ' is empty'
                        ];
                    } else {
                        self::$contentMatchCounter+=1;
                    }
                } 
            }
            // 
            if (self::$contentMatchCounter == 5) {
                // 
                self::$getPreferenceQuery = database::$conn->query(' SELECT * FROM `notification` ');
                // 
                if ( self::$getPreferenceQuery == false ) {
                    return [
                        'status' => false,
                        'body'   => 'Could not acquire notification preference',
                    ];
                } else {
                    if (self::$getPreferenceQuery->num_rows > 0) {
                        $contentsObj = (object)$content;
                        // 
                        switch (self::$getPreferenceQuery->fetch_object()->preference) {
                            case 'sms':
                                return sendSMS::to(json_encode([
                                    [
                                        'from'         => 'NETLIB',
                                        'to'           => '231'.ltrim($content['mobile'], '0'),
                                        'body'         => $content['subject'].'  '.$content['body'],
                                        'routingGroup' => 'STANDARD'
                                    ]
                                ]));
                                break;
                            // 
                            case 'hybrid':
                                if ($content['email'] == "none") {
                                    return sendSMS::to(json_encode([
                                        [
                                            'from'         => 'NETLIB',
                                            'to'           => '231'.ltrim($content['mobile'], '0'),
                                            'body'         => $content['subject'].'  '.$content['body'],
                                            'routingGroup' => 'STANDARD'
                                        ]
                                    ]));
                                } else {
                                    return $message = sendMail::to(  
                                        $content['email'], 
                                        $content['recipient'], 
                                        $content['subject'], 
                                        $content['body'] 
                                    );
                                }
                                break;
                            // 
                            default:
                                return [
                                    'status' => false,
                                    'body'   => 'Could not send notification. Invalid preference type',
                                ];
                                break;
                        }
                    } else {
                        return [
                            'status' => false,
                            'body'   => 'Notification preference not set',
                        ];
                    }
                }
            } else {
                return [
                    'status' => false,
                    'body'   => 'Please set: ' .implode(', ', self::$params). ' and none other',
                ];
            }
        } else {
            return [
                'status' => false,
                'body'   => 'send notification array must contain 5 values. Example: '.implode(', ', self::$params),
            ];
        }
    }
}
// END class ClassName 
// 
// $send = sendNotification::to([
//     'mobile'    => $mobile,
//     'email'     => $email, // set to none if empty. eg: ($email == "") ? 'none': $email,
//     'recipient' => $name,
//     'subject'   => 'Decline of application',
//     'body'      => $message
// ]);

// print_r($send); // result is returned as array with status and body


?>