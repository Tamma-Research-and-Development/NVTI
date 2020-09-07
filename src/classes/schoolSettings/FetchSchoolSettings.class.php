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
//   UserAccessControl::guardResource();
  /**
  * undocumented class
  *
  * @package default
  * @author 
  **/
  final class FetchSchoolSettings  extends teacherDetails
  {
    use apiResponseManager, io_stream, queryBuilder;
    
    private $settingsDataArray;
    private $teacherData;
    private $settingsFetchQuery;
    
    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') { 

            $this->teacherData = parent::teacherInfo();

            if ($this->teacherData[0]['accountType'] == 'admin') {
               
                $this->settingsFetchQuery = $this->selectFromTBL( 
                    database::$conn, [], 'application_settings', [], []
                );

                if ($this->settingsFetchQuery['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry setting retrieval failed', 
                        $this->settingsFetchQuery['info'], 
                        []
                    );
                } else {
                    if ($this->settingsFetchQuery['total'] > 0) {

                        $this->settingsDataArray = [];
                        while ( $row = $this->settingsFetchQuery['result']->fetch_assoc() ) {
                            $this->settingsDataArray = [
                                // 'app_logo'                     =>  SETTINGS_UPLOAD_PATH.$row['app_logo'],
                                'app_logo'                     =>  $row['app_logo'],
                                'app_school_name'              =>  $row['app_school_name'],
                                'app_contact_phone'            =>  $row['app_contact_phone'],
                                'app_contact_email'            =>  $row['app_contact_email'],
                                'app_contact_address'          =>  $row['app_contact_address'],
                                'social_facebook'              =>  $row['social_facebook'],
                                'social_twitter'               =>  $row['social_twitter'],
                                'social_googleplus'            =>  $row['social_googleplus'],
                                'app_motto'                    =>  $row['app_motto'],
                                'app_mission'                  =>  $row['app_mission'],
                                'app_vision'                   =>  $row['app_vision'],
                                'app_history'                  =>  $row['app_history'],
                                'app_about_info'               =>  $row['app_about_info'],
                                'app_primary_color'            =>  $row['app_primary_color'],
                                'app_secondary_color'          =>  $row['app_secondary_color'],
                                'app_home_bg_image'            =>  $row['app_home_background_image'],
                                'app_student_login_bg_image'   =>  $row['app_student_login_background_image'],
                                'app_educator_login_bg_image'  =>  $row['app_educator_login_background_image'],
                                // 'app_home_bg_image'            =>  SETTINGS_UPLOAD_PATH.$row['app_home_background_image'],
                                // 'app_student_login_bg_image'   =>  SETTINGS_UPLOAD_PATH.$row['app_student_login_background_image'],
                                // 'app_educator_login_bg_image'  =>  SETTINGS_UPLOAD_PATH.$row['app_educator_login_background_image'],
                                'app_font_size'                =>  $row['app_font_size']
                            ];
                        }

                        $this->output(
                            true, 200, 
                            'Settings retrieved', 
                            $this->settingsFetchQuery['info'], 
                            [$this->settingsDataArray]
                        );
                    } else {
                        $this->output(
                            false, 404, 
                            'Sorry 0 setting retrieved', 
                            $this->settingsFetchQuery['info'], 
                            []
                        );
                    }
                }

            } else {
                $this->output(
                    false, 403, 
                    'Sorry, Only (admins) are allowed to retrieve application settings', 
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
$FetchSchoolSettings = new FetchSchoolSettings;
$FetchSchoolSettings->main();
?>