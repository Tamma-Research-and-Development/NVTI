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
  final class UpdateTextContent  extends teacherDetails
  {
    use apiResponseManager, io_stream, queryBuilder;

    private $appPrimaryColor;
    private $appSecondaryColor;
    private $appAboutInfo;
    private $appContactInfo;
    private $appSchoolName;
    private $appFontSize;

    private $app_contact_phone;
    private $app_contact_email;
    private $app_contact_address;
    private $app_motto;
    private $app_mission;
    private $app_vision;
    private $app_history;

    private $social_facebook_query;
    private $social_twitter_query;
    private $social_googleplus_query;

    private $teacherData;
    private $settingsUpdateQuery;
    private $params = [
        '(app_primary_color)', 
        '(app_secondary_color)', 
        '(app_about_info)',
        '(app_school_name)',
        '(app_contact_phone)',
        '(app_contact_email)',
        '(app_contact_address)',
        '(app_motto)',
        '(app_mission)',
        '(app_vision)',
        '(app_history)',
        '(app_font_size)',
        '[Optional] (social_facebook), (social_twitter), (social_googleplus)'
    ];

    
    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

            if (
                empty($_POST['app_primary_color'])     ||
                empty($_POST['app_secondary_color'])   ||
                empty($_POST['app_about_info'])        ||
                empty($_POST['app_school_name'])       ||
                empty($_POST['app_contact_phone'])     ||
                empty($_POST['app_contact_email'])     ||
                empty($_POST['app_contact_address'])   ||
                empty($_POST['app_motto'])             ||
                empty($_POST['app_mission'])           ||
                empty($_POST['app_vision'])            ||
                empty($_POST['app_history'])           ||
                empty($_POST['app_font_size'])
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {

                $this->teacherData = parent::teacherInfo();

                if ($this->teacherData[0]['accountType'] == 'admin') {
                    
                    $this->appPrimaryColor         =  $this->input($_POST['app_primary_color'], STRICT_INPUT_FILTER);
                    $this->appSecondaryColor       =  $this->input($_POST['app_secondary_color'], STRICT_INPUT_FILTER);
                    $this->appAboutInfo            =  $this->input($_POST['app_about_info'], STRICT_INPUT_FILTER);
                    $this->appSchoolName           =  $this->input($_POST['app_school_name'], STRICT_INPUT_FILTER);
                    $this->appFontSize             =  $this->input($_POST['app_font_size'], STRICT_INPUT_FILTER);
                    $this->app_contact_phone       =  $this->input($_POST['app_contact_phone'], STRICT_INPUT_FILTER);
                    $this->app_contact_email       =  $this->input($_POST['app_contact_email'], STRICT_INPUT_FILTER);
                    $this->app_contact_address     =  $this->input($_POST['app_contact_address'], STRICT_INPUT_FILTER);
                    $this->app_motto               =  $this->input($_POST['app_motto'], STRICT_INPUT_FILTER);
                    $this->app_mission             =  $this->input($_POST['app_mission'], STRICT_INPUT_FILTER);
                    $this->app_vision              =  $this->input($_POST['app_vision'], STRICT_INPUT_FILTER);
                    $this->app_history             =  $this->input($_POST['app_history'], STRICT_INPUT_FILTER);
                    

                    // OPtional params
                    if (!empty($_POST['social_facebook'])) {
                        $social_facebook = $this->input($_POST['social_facebook'], STRICT_INPUT_FILTER);
                        $this->social_facebook_query = $this->updateTBL( 
                            database::$conn, 'application_settings',  
                            [
                                "social_facebook   =  '$social_facebook'",
                                "WHERE id          =  '1' "
                            ]
                        );
                    } 
                    if (!empty($_POST['social_twitter']))  {
                        $social_twitter = $this->input($_POST['social_twitter'], STRICT_INPUT_FILTER);
                        $this->social_twitter_query = $this->updateTBL( 
                            database::$conn, 'application_settings',  
                            [
                                "social_twitter    =  '$social_twitter'",
                                "WHERE id          =  '1' "
                            ]
                        );
                    } 
                    if (!empty($_POST['social_googleplus']))  {
                        $social_googleplus = $this->input($_POST['social_googleplus'], STRICT_INPUT_FILTER);
                        $this->social_googleplus_query = $this->updateTBL( 
                            database::$conn, 'application_settings',  
                            [
                                "social_googleplus   =  '$social_googleplus'",
                                "WHERE id          =  '1' "
                            ]
                        );
                    }
                    


                    $this->settingsUpdateQuery = $this->updateTBL( 
                        database::$conn, 
                        'application_settings',  
                        [
                            "app_primary_color    =  '$this->appPrimaryColor',",
                            "app_secondary_color  =  '$this->appSecondaryColor',",
                            "app_about_info       =  '$this->appAboutInfo',",
                            "app_school_name      =  '$this->appSchoolName',",
                            "app_font_size        =  '$this->appFontSize',",
                            "app_contact_phone    =  '$this->app_contact_phone',",
                            "app_contact_email    =  '$this->app_contact_email',",
                            "app_contact_address  =  '$this->app_contact_address',",
                            "app_motto            =  '$this->app_motto',",
                            "app_mission          =  '$this->app_mission',",
                            "app_vision           =  '$this->app_vision',",
                            "app_history          =  '$this->app_history'",
                            "WHERE id             =  '1' "
                        ]
                    );

                    if ($this->settingsUpdateQuery['status'] == false) {
                        $this->output(
                            false, 500, 
                            'Sorry app settings update failed', 
                            $this->settingsUpdateQuery['info'], 
                            []
                        );
                    } else {

                        if (
                            $this->settingsUpdateQuery['total'] > 0      || 
                            $this->social_facebook_query['total'] > 0    ||
                            $this->social_twitter_query['total'] > 0     ||
                            $this->social_googleplus_query['total'] > 0 
                        ) {
                            $this->output(
                                false, 200, 
                                'App settings updated', 
                                $this->settingsUpdateQuery['info'], 
                                []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'No changes were made to app settings', 
                                $this->settingsUpdateQuery['info'], 
                                []
                            );
                        }
                    }
                } else {
                    $this->output(
                        false, 403, 
                        'Sorry, Only (admins) are allowed to change this application settings', 
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
$SchoolSettings = new UpdateTextContent;
$SchoolSettings->main();
?>