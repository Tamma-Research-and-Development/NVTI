<?php 
header('Content-Type: Application/json');
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
/**
* undocumented class
*
* @package default
* @author 
**/
trait apiResponseManager
{

    public function output(
        Bool   $status, 
        Int    $status_code,
        String $message,
        String $error_info = null,
        Array  $dataset
    ) {
        // self::broadcast_status_code($status_code);
        
        $output = [
            "status"      => $status, 
            "status_code" => $status_code, 
            "body" => [ 
                "message"    => $message, 
                "error_info" => (empty($error_info)) ? 'None' : $error_info, 
                "dataset"    => (count($dataset) == 0) ? "Not Available" : $dataset
            ]
        ];
        
        return print json_encode($output, JSON_PRETTY_PRINT);
        exit;
    }

    private function broadcast_status_code(Int $status_code)
    {
        switch ($status_code) {
            case 200:
                header('HTTP/1.1 200 Ok');
                break;
            case 201:
                header('HTTP/1.0 200 Created');
                break;
            case 400:
                header('HTTP/1.0 400 Bad Request');
                break;
            case 401:
                header('HTTP/1.0 401 Unauthorized');
                break;
            case 403:
                header('HTTP/1.0 403 Forbidden');
                break;
            case 404:
                header('HTTP/1.0 403 Not Found');
                break;
            case 405:
                header('HTTP/1.0 405 Method Not Allowed');
                break;
            case 408:
                header('HTTP/1.0 408 Request Timeout');
                break;
            case 500:
                header('HTTP/1.0 500 Internal Server Error');
                break;
            case 501:
                header('HTTP/1.1 501 Not Implemented');
                break;
        }
    }

} // END class ClassName 
// 
// Usage Example: 
// apiResponseManager::output($status, $status_code, $message, $error_info, $dataset);
// $this->output($status, $status_code, $message, $error_info, $dataset);
?>