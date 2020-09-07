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
  // require_once('../../../configuration/app.ini.php');
  /**
  * undocumented class
  *
  * @package default
  * @author 
  **/
  class database
  {
    public static $conn;

    // private $host         = "localhost"; // online
    // private $userName     = "tammacor_covid19"; // online
    // private $dB_Password  = "schoolmass_covid-19@tamma"; // online
    // private $dB_Name      = "tammacor_schoolmass_covid-19"; // online
    
    public function __construct()
    {
        self::$conn = new mysqli(
          ENVIRONMENT_HOST_NAME, 
          ENVIRONMENT_USER_NAME, 
          ENVIRONMENT_DB_PASSWORD, 
          ENVIRONMENT_DB_NAME
        );

        if (self::$conn->connect_error) {
          $this->ConnectionFailure(self::$conn->connect_error); 
        }
    }

    private function ConnectionFailure($dB_Error) 
    {
      
      print json_encode([
        'status' => false,
        'status_code' => 500,
        'body' => [
            'message'  => 'Sorry, unable to establish connection with the server',
            'error_info' => $dB_Error,
            'dataset' => ''
        ]
      ]);
      exit;
    }

  } // END class ClassName 
  $database = new database;
?>