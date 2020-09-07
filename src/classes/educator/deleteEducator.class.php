<?php 
  /**
   * *********************************************************************************************************
   * @_forProject: Application | Developed By: TAMMA CORPORATION
   * @_purpose: (Please Specify) 
   * @_version Release: package_two
   * @_created Date: 00/00/2020
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
  class deleteEducator extends teacherDetails
  {
    use apiResponseManager, io_stream, queryBuilder;
    
    private $staffID;
    private $teachersData;
    private $accountType;
    private $deleteStaffQuery;
    private $params = [
      '(record_id)'
    ];

    public function main()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        if ( empty($_POST['record_id']) ) {
          $this->output(
            false, 400, 
            'Set: '.implode(',', $this->params).'', 
            'Bad Request', []
          );
        } else {

          $this->teachersData  =  parent::teacherInfo();
          $this->accountType   =  $this->teachersData[0]['accountType'];
  
          if ($this->accountType == 'admin') {

            $this->staffID = $this->input($_POST['record_id'], STRICT_INPUT_FILTER);

            $this->deleteStaffQuery = $this->deleteRec( 
                database::$conn,
                'admin_account',
                ["`id` = '$this->staffID'"]
            );

            if ($this->deleteStaffQuery['status'] == false) {
                $this->output(
                  false, 500, 
                  'Sorry staff removal failed', 
                  $this->deleteStaffQuery['info'], 
                  []
                );
            } else {
                if ($this->deleteStaffQuery['total'] == 0 ) {
                    $this->output(
                      false, 501, 
                      'Sorry, staff removal failed. Account does not exist', 
                      $this->deleteStaffQuery['info'], 
                      []
                    );
                } else {
                    $this->output(
                      false, 200, 
                      '1 staff deleted', 
                      $this->deleteStaffQuery['info'], 
                      []
                    );
                }
            }
          } else {
              $this->output(
                  false, 403, 
                  'Sorry, Only (admins) are allowed to delete users', 
                  'Forbidden', []
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
  } // END class deleteEducator 
//   
$deleteEducator = new deleteEducator;
$deleteEducator->main();
?>