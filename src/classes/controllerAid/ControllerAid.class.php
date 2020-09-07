<?php 
// header("Access-Control-Allow-Origin: *");
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
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
// UserAccessControl::guardResource();

/**
* This GOD class needs to be broken up for Pete's sake!!!
*
* @package default
* @author 
**/
final class ControllerAid
{
    use apiResponseManager, queryBuilder;

    private $settingsFetchQuery;
    private $settingsDataArray;
    
    private $bulletinPostFetchQuery;
    private $bulletinPostArray;

    private $fetch_educator_list_query;
    private $educators_list;

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->FetchUserType();
            $this->FetchEndPoints();
            $this->FetchSchoolInfo();
            $this->FetchBulletin();
            $this->FetchStaff();
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }

    public function FetchUserType()
    {
        if (!empty($_GET['FetchUserType'])) {
            if (empty($_SESSION['ACCOUNT_TYPE'])) {
                $this->output(false, 401, 'User is not logged in', '', ['   ' => null ] );
            } else {
                $this->output(true, 200, 'Successful', '', ['user_type' => $_SESSION['ACCOUNT_TYPE'] ] );
            }
            
            
        }
    }

    public function FetchEndPoints()
    {
        if (!empty($_GET['FetchEndPoints'])) {
            $projectClassesDir  = scandir(PROJECT_CLASSES);

            $sourceFiles = [];

            for ($i=0; $i < count($projectClassesDir); $i++) { 
                if (is_dir(PROJECT_CLASSES.$projectClassesDir[$i])) {
                    if ($projectClassesDir[$i] != '.' && $projectClassesDir[$i] != '..') {
                        $projectClassesDirFiles  = scandir(PROJECT_CLASSES.$projectClassesDir[$i]);

                        for ($n=0; $n < count($projectClassesDirFiles); $n++) { 
                            // eliminate (..)
                            if ($projectClassesDirFiles[$n] != "." && $projectClassesDirFiles[$n] != "..") {
                                // eliminate un-needed classes
                                if (in_array($projectClassesDirFiles[$n], [
                                    "testManager.class.php",
                                    "studentDetails.class.php",
                                    "UserAccessControl.class.php",
                                    "teacherDetails.class.php",
                                    "database.class.php",
                                ])) {
                                    # code...
                                } else {
                                    $name = explode('.', $projectClassesDirFiles[$n]);

                                    // print_r($name[0]) . "\n";
                                    $sourceFiles[] = PROJECT_CLASSES.$projectClassesDir[$i].'/'.$projectClassesDirFiles[$n]. "\n";
                                }
                            }
                        }
                    }
                }
            }

            $sourceFilesArrayNew = [];

            // remove the first (../) from path for front-end
            for ($i=0; $i < count($sourceFiles); $i++) { 
                $sourceFilesArray = explode('/', $sourceFiles[$i] );
                array_shift($sourceFilesArray);
                $name = explode('.', $sourceFilesArray[5]);
                $sourceFilesArrayNew[$name[0]] = implode('/', $sourceFilesArray);
            }
            // 
            file_put_contents('../../../public/assets/js/util/apiEndpoints.js', 'export const apiEndpoints = '. json_encode($sourceFilesArrayNew, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT) .'');

            // 
            // $this->output( true, 200, 'Successful', '', ['endpoints' => $sourceFilesArrayNew ] );
        }
        
    }

    public function FetchSchoolInfo()
    {
        if (!empty($_GET['FetchSchoolInfo'])) {
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
                            'app_logo'                     =>  $row['app_logo'],
                            'app_school_name'              =>  $row['app_school_name'],
                            'app_contact_phone'            =>  $row['app_contact_phone'],
                            'app_contact_email'            =>  $row['app_contact_email'],
                            'app_contact_address'          =>  $row['app_contact_address'],
                            'social_facebook'              =>  $row['social_facebook'],
                            'social_twitter'               =>  $row['social_twitter'],
                            'app_motto'                    =>  $row['app_motto'],
                            'app_mission'                  =>  $row['app_mission'],
                            'app_vision'                   =>  $row['app_vision'],
                            'app_history'                  =>  $row['app_history'],
                            'app_about_info'               =>  $row['app_about_info'],
                            'app_home_bg_image'            =>  $row['app_home_background_image'],
                            'app_student_login_bg_image'   =>  $row['app_student_login_background_image'],
                            'app_educator_login_bg_image'  =>  $row['app_educator_login_background_image'],
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
        }
    }

    public function FetchBulletin()
    {
        if (!empty($_GET['FetchBulletin'])) {
            $this->bulletinPostFetchQuery = $this->selectFromTBL ( 
                database::$conn, [], 
                'bulletin', 
                [
                    "LEFT JOIN `admin_account` ON `bulletin`.postedBy = `admin_account`.id ",
                    "WHERE ",
                    "news_target_audience = '".BULLETIN_AUDIANCE[0]."'"
                ], 
                ["ORDER BY bulletin_id DESC"]
            );

            if ( $this->bulletinPostFetchQuery['status'] == false ) {
                $this->output(
                    false, 500, 
                    'Sorry, Bulletin Posts Retrieval failed', 
                    $this->bulletinPostFetchQuery['info'], 
                    []
                );
            } else {
                if ($this->bulletinPostFetchQuery['total'] > 0) {

                    while ($row = $this->bulletinPostFetchQuery['result']->fetch_assoc() ) {
                        // 
                        // $this->file = [];
                        // if ( empty($row['news_file']) ) {
                        //     $this->file = null;
                        // } else {
                        //     $fileArr = explode(';', $row['news_file']);
                        //     for ($i=0; $i < count($fileArr); $i++) { 
                        //         if (!empty($fileArr[$i])) {
                        //             $this->file[] = BULLETIN_UPLOAD_PATH.$fileArr[$i];
                        //         }
                        //     }
                        // }

                        $this->bulletinPostArray[] = [
                            'id'       => $row['bulletin_id'],
                            'title'    => $row['news_title'],
                            'file'     => explode(';', $row['news_file']),
                            'details'  => $row['news_details'],
                            'audience' => $row['news_target_audience'],
                            'postedOn' => $row['added_date'],
                            'postedBy' => [
                                'photo'      => (empty($row['photo'])) ? null : $row['photo'],
                                'first_name' => rtrim($row['First_Name']),
                                'last_name'  => rtrim($row['Last_Name']),
                            ]
                        ];
                    }

                    $this->output(
                        true, 200, 
                        $this->bulletinPostFetchQuery['total']. ' Bulletin Post Found', 
                        $this->bulletinPostFetchQuery['info'], 
                        [$this->bulletinPostArray]
                    ); 

                } else {
                    $this->output(
                        false, 404, 
                        $this->bulletinPostFetchQuery['total']. ' Bulletin Post Found', 
                        $this->bulletinPostFetchQuery['info'], 
                        []
                    );
                }
            }

        }
    }

    public function FetchStaff()
    {
        if (!empty($_GET['FetchStaff'])) {
            $this->fetch_educator_list_query = $this->selectFromTBL ( 
                database::$conn, 
                [], 
                'admin_account', 
                [], 
                []
            ); 

            if ($this->fetch_educator_list_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Sorry, Educator list fetch failed', 
                    $this->fetch_educator_list_query['info'], []
                );
            } else {

                if ( $this->fetch_educator_list_query['total'] > 0 ) {
                    
                    while ( $row = $this->fetch_educator_list_query['result']->fetch_assoc() ) {
                        $this->educators_list[] = [
                            'Record_id'        =>  $row['id'],
                            'First_Name'       =>  $row['First_Name'],
                            'Last_Name'        =>  $row['Last_Name'],
                            'Gender'           =>  $row['Gender'],
                            'School_Teaching'  =>  $row['School_Teaching'],
                            'classes_taught'   =>  explode(';', $row['classes_taught']),
                            'subject'          =>  explode(';', $row['subject']),
                            'accountType'      =>  $row['accountType']
                        ];
                    }

                    $this->output(
                        true, 200, 
                        $this->fetch_educator_list_query['total']. ' Educator(s) found', 
                        $this->fetch_educator_list_query['info'], 
                        [$this->educators_list]
                    );

                } else {
                    $this->output(
                        false, 404, 
                        '0 Educators found', 
                        $this->fetch_educator_list_query['info'], []
                    );
                }
            }


        }
    }

} // END class ClassName 
// 
$ControllerAid = new ControllerAid;
?>

