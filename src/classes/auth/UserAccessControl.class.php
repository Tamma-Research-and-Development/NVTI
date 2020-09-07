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
class UserAccessControl
{
	public static function guardResource()
	{
		if (empty($_SESSION['user-session'])) {
		    header('HTTP/1.0 401 Unauthorized');
		    print json_encode([
		        'status'  => false,
		        'status_code' => 401,
		        'body' => [
		            'message' => 'You must be logged in to use this resource'
		        ]
		    ], JSON_PRETTY_PRINT);
		    exit;
		}
	}
} // END class ClassName 
// UserAccessControl::guardResource();
?>