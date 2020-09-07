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
  class fetchAllEducators extends teacherDetails
  {
    use apiResponseManager, io_stream, queryBuilder;

    private $record_id;
    private $searchPhrase;
    private $teachersData;
    private $accountType;
    private $fetch_educator_list_query;
    private $educators_list = [];

    public function main()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->teachersData  =  parent::teacherInfo();
            $this->accountType   =  $this->teachersData[0]['accountType'];

            if ($this->accountType == 'admin') {

                if (!empty($_GET['record_id'])) {
                    $this->record_id = $this->input($_GET['record_id'], STRICT_INPUT_FILTER);
                    $this->fetch_educator_list_query = $this->selectFromTBL ( 
                        database::$conn, 
                        [], 
                        'admin_account', 
                        ["id = '$this->record_id' "], 
                        []
                    ); 
                } else if (!empty($_GET['searchPhrase'])) {
                    $this->searchPhrase = $this->input($_GET['searchPhrase'], STRICT_INPUT_FILTER);
                    $this->fetch_educator_list_query = $this->selectFromTBL ( 
                        database::$conn, 
                        [], 
                        'admin_account', 
                        [
                            "First_Name LIKE '%$this->searchPhrase%' OR ",
                            "Last_Name LIKE '%$this->searchPhrase%' OR ",
                            // "Gender LIKE '%$this->searchPhrase%' OR ",
                            // "School_Teaching LIKE '%$this->searchPhrase%' OR ",
                            // "classes_taught LIKE '%$this->searchPhrase%' OR ",
                            // "subject LIKE '%$this->searchPhrase%' OR ",
                            "accountType LIKE '%$this->searchPhrase%' "
                        ], 
                        []
                    ); 
                } else {
                    $school = $this->teachersData[0]['School_Teaching'];
                    $this->fetch_educator_list_query = $this->selectFromTBL ( 
                        database::$conn, 
                        [], 
                        'admin_account', 
                        [], 
                        []
                    ); 
                }

                if ($this->fetch_educator_list_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry, Educator list fetch failed', 
                        $this->fetch_educator_list_query['info'], []
                    );
                } else {
                    if ( $this->fetch_educator_list_query['total'] > 0 ) {
                        while ( $row = $this->fetch_educator_list_query['result']->fetch_assoc() ) {
                            // $educators_list[] = $row;
                            $educators_list[] = [
                                'id'                           => $row['id'],
                                'photo'                        => $row['photo'],
                                'First_Name'                   => $row['First_Name'],
                                'Last_Name'                    => $row['Last_Name'],
                                'Gender'                       => $row['Gender'],
                                'Phone_number'                 => $row['Phone_number'],
                                'accountType'                  => $row['accountType'],
                                'email'                        => $row['email'],
                                'dob'                          => $row['dob'],
                                'years_in_teaching'            => $row['years_in_teaching'],
                                'professional_qualification'   => $row['professional_qualification'],
                                'national_id'                  => $row['national_id'],
                                'address'                      => $row['address'],
                                'academic_qualification'       => $row['academic_qualification'],
                                'biography'                    => $row['biography'],
                                'payroll_number'               => $row['payroll_number'],
                                'ec_fullname'                  => $row['ec_fullname'],
                                'ec_relationship'              => $row['ec_relationship'],
                                'ec_primary_tel'               => $row['ec_primary_tel'],
                                'ec_secondaary_tel'            => $row['ec_secondaary_tel']
                            ];
                        }

                        $this->output(
                            true, 200, 
                            $this->fetch_educator_list_query['total']. ' Educator(s) found', 
                            $this->fetch_educator_list_query['info'], 
                            $educators_list
                        );

                    } else {
                        $this->output(
                            false, 404, 
                            '0 Educators found', 
                            $this->fetch_educator_list_query['info'], []
                        );
                    }
                }
                
            } else {
                $this->output(
                    false, 403, 
                    'Sorry, Only (admins) are allowed to view all users', 
                    'Forbidden', []
                );
            }
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
  } // END class deleteEducator 
//   
$fetchAllEducators = new fetchAllEducators;
$fetchAllEducators->main();
?>