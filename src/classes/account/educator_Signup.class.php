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
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
UserAccessControl::guardResource();
/**
* undocumented class
*
* @package default
* @author 
**/
final class educator_Signup extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $First_Name;
    private $Last_Name;
    private $Gender;
    private $Phone_number;
    private $School_Teaching;
    private $accountType;
    private $Account_Type_Code;
    private $Password;
    private $terms;
    private $classes_taught;
    private $subject;
    private $teachersData;
    private $validate_account_type_number;
    private $ensure_Gender_Is_Binary;
    private $ensure_Terms_Value_Is_Bool;
    private $create_New_Account_Query;
    private $params = [
        '(First_Name)', 
        '(Last_Name)', 
        '(Gender)',
        '(Phone_number)',
        '(accountType)', 
        '(email)',
        '(dob)',
        '(years_in_teaching)',
        '(professional_qualification)',
        '(national_id)',
        '(address)',
        '(academic_qualification)',
        '(biography)',
        '(payroll_number)',
        '(ec_fullname)',
        '(ec_relationship)',
        '(ec_primary_tel)',
        '(ec_secondary_tel)'
    ];

    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_FILES['photo'])                     ||
                empty($_POST['First_Name'])                 ||
                empty($_POST['Last_Name'])                  ||
                empty($_POST['Gender'])                     ||
                empty($_POST['Phone_number'])               ||
                empty($_POST['accountType'])                ||
                empty($_POST['email'])                      ||
                empty($_POST['dob'])                        ||
                empty($_POST['years_in_teaching'])          ||
                empty($_POST['professional_qualification']) ||
                empty($_POST['national_id'])                ||
                empty($_POST['address'])                    ||
                empty($_POST['academic_qualification'])     ||
                empty($_POST['biography'])                  ||
                empty($_POST['payroll_number'])             ||
                empty($_POST['ec_fullname'])                ||
                empty($_POST['ec_relationship'])            ||
                empty($_POST['ec_primary_tel'])             ||
                empty($_POST['ec_secondaary_tel']) 
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {

                $this->photo                        =   $_FILES['photo']['name'];
                $this->First_Name                   =   $this->input($_POST['First_Name'],  STRICT_INPUT_FILTER);
                $this->Last_Name                    =   $this->input($_POST['Last_Name'], STRICT_INPUT_FILTER);
                $this->Gender                       =   $this->input($_POST['Gender'], STRICT_INPUT_FILTER);
                $this->Phone_number                 =   $this->input($_POST['Phone_number'], STRICT_INPUT_FILTER);
                $this->account_Type                 =   $this->input($_POST['accountType'], STRICT_INPUT_FILTER);
                $this->Password                     =   password_hash($_POST['Phone_number'], PASSWORD_DEFAULT);
                $this->email                        =   $this->input($_POST['email'],  STRICT_INPUT_FILTER);
                $this->dob                          =   $this->input($_POST['dob'],  STRICT_INPUT_FILTER);
                $this->years_in_teaching            =   $this->input($_POST['years_in_teaching'],  STRICT_INPUT_FILTER);
                $this->professional_qualification   =   $this->input($_POST['professional_qualification'],  STRICT_INPUT_FILTER);
                $this->national_id                  =   $this->input($_POST['national_id'],  STRICT_INPUT_FILTER);
                $this->address                      =   $this->input($_POST['address'],  STRICT_INPUT_FILTER);
                $this->academic_qualification       =   $this->input($_POST['academic_qualification'],  STRICT_INPUT_FILTER);
                $this->biography                    =   $this->input($_POST['biography'],  STRICT_INPUT_FILTER);
                $this->payroll_number               =   $this->input($_POST['payroll_number'],  STRICT_INPUT_FILTER);
                $this->ec_fullname                  =   $this->input($_POST['ec_fullname'],  STRICT_INPUT_FILTER);
                $this->ec_relationship              =   $this->input($_POST['ec_relationship'],  STRICT_INPUT_FILTER);
                $this->ec_primary_tel               =   $this->input($_POST['ec_primary_tel'],  STRICT_INPUT_FILTER);
                $this->ec_secondaary_tel            =   $this->input($_POST['ec_secondaary_tel'],  STRICT_INPUT_FILTER);

                $this->teachersData                 =   parent::teacherInfo();
                $this->accountType                  =   $this->teachersData[0]['accountType'];


                $file = implode('.', $_FILES['photo']['name']);

                // 
                if ( in_array($file[1], ["jpg", "jpeg", "png", "gif"]) ) {
                    $this->output(
                        false, 403,     
                        'File must be of type: jpg, jpeg, png or gif', 
                        'Forbidden', []
                    );
                } else {
                    // Upload file
                    $uploadFile = FileUploader2::fileDetails($_FILES['photo'], 'UploadRegularFile', STAFF_UPLOAD_PATH);

                    if ($uploadFile['status'] == false) {
                        $this->output(
                            false, 500, 
                            $uploadFile['body']['message'], 
                            $uploadFile['body']['error_info'], []
                        );
                    } else {
                        // 
                        if ($this->accountType == 'admin') {
                            // account number is valid
                            $this->ensure_Gender_Is_Binary    = ($this->Gender == 'male' || $this->Gender == "female") ? true : false;
                            $this->ensure_Terms_Value_Is_Bool = ($this->terms == 'yes'   || $this->terms == 'no') ? true : false;

                            if ($this->ensure_Gender_Is_Binary == false) {
                                $this->output(
                                    false, 403, 
                                    'Set: (Gender) to {male/female}', 
                                    'Forbidden', []
                                );
                            } else {
                                $this->create_New_Account_Query = $this->insertIntoTBL ( 
                                    database::$conn, 'admin_account',
                                    [
                                        'photo',
                                        'First_Name', 
                                        'Last_Name', 
                                        'Gender',
                                        'Phone_number',
                                        'accountType', 
                                        'Password',
                                        'email',
                                        'dob',
                                        'years_in_teaching',
                                        'professional_qualification',
                                        'national_id',
                                        'address',
                                        'academic_qualification',
                                        'biography',
                                        'payroll_number',
                                        'ec_fullname',
                                        'ec_relationship',
                                        'ec_primary_tel',
                                        'ec_secondaary_tel'
                                    ], 
                                    [
                                        $this->photo,
                                        $this->First_Name,
                                        $this->Last_Name,
                                        $this->Gender,
                                        $this->Phone_number,
                                        $this->account_Type,
                                        $this->Password,
                                        $this->email,
                                        $this->dob,
                                        $this->years_in_teaching,
                                        $this->professional_qualification,
                                        $this->national_id,
                                        $this->address,
                                        $this->academic_qualification,
                                        $this->biography,
                                        $this->payroll_number,
                                        $this->ec_fullname,
                                        $this->ec_relationship,
                                        $this->ec_primary_tel,
                                        $this->ec_secondaary_tel
                                    ]  
                                );
                                // 
                                if ($this->create_New_Account_Query['status'] == false) {
                                    $this->output(
                                        false, 500, 
                                        'Account setup failed', 
                                        $this->create_New_Account_Query['info'], []
                                    );
                                } else {
                                    if ($this->create_New_Account_Query['total'] == 1) {
                                        // add responsibilities
                                        if ( !empty($_POST['responsibilities']) ) {
                                            $responsibility = json_decode($_POST['responsibilities']);
                                            $staffId = database::$conn->insert_id;
                                            // 
                                            for ($i=0; $i < count($responsibility); $i++) { 
                                                // 
                                                $this->addResponsibilities = $this->insertIntoTBL ( 
                                                    database::$conn, 'teacher_responsibilities',
                                                    [
                                                        'employee_id',
                                                        'trade_area', 
                                                        'subject'
                                                    ], 
                                                    [
                                                        $staffId,
                                                        $responsibility[$i]->trade_area,
                                                        implode(';',$responsibility[$i]->subjects)
                                                    ]  
                                                );
                                            }
                                            // 
                                            if ($this->addResponsibilities['status'] == false) {
                                                $this->output(
                                                    false, 500, 
                                                    'Responsibility assignment failed', 
                                                    $this->addResponsibilities['info'], []
                                                );
                                            } else {
                                                // return record id for teachers only for 
                                                $this->output(
                                                    true, 200, 
                                                    'Responsibility assignment successful', 
                                                    $this->create_New_Account_Query['info'], 
                                                    (strtolower($this->account_Type) == "teacher") ?  []  : []
                                                );
                                            }
                                        }
                                        // none teaching staff  
                                        else {
                                            // return record id for teachers only for 
                                            $this->output(
                                                true, 200, 
                                                'Account setup successful', 
                                                $this->create_New_Account_Query['info'], 
                                                (strtolower($this->account_Type) == "teacher") ?  ['teacher_id' => database::$conn->insert_id]  : []
                                            );
                                        }
                                    } else {
                                        $this->output(
                                            false, 501, 
                                            'Account setup failed', 
                                            'Not Implemented', []
                                        );
                                    }
                                }
                            }
                        } else {
                            $this->output(
                                false, 403, 
                                'Sorry, Only (admins) are allowed to spawn new users', 
                                'Forbidden', []
                            );
                        }
                    }
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
} // END class ClassName 
// 
$educator_Signup = new educator_Signup;
$educator_Signup->main();
?>

