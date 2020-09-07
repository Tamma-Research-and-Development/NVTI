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
/**
* undocumented class
*
* @package default
* @author 
**/
final class student_Signup
{
    use apiResponseManager, queryBuilder, io_stream;

    private $photo;
    private $Fullname;
    private $Mobile;
    private $status;
    private $emial;
    private $gender;
    private $birth_month;
    private $birth_day;
    private $birth_year;
    private $place_of_birth;
    private $nationality;
    private $address;
    private $tuition_status;

    private $t_s_institution_or_sponsor_name;
    private $t_s_phone;
    private $t_s_email;

    private $academic_status;
    private $first_time_attending_vocational_school;

    private $name_of_school_have_attended;
    private $location_of_school_have_attended;

    private $emc_first_name;
    private $emc_last_name;
    private $emc_gender;
    private $emc_address;
    private $emc_phone;

    private $terms_agreement;
    private $deleted;
    private $year;

    private $ensure_terms_agreement_Value_Is_Bool;
    private $prevent_Redundant_Account;
    private $create_Account_Query;
    private $params = [
        '(photo)',
        '(Fullname)', 
        '(Mobile)', 
        '(status)', 
        '(emial)', 
        '(gender)', 
        '(DOB)', 
        '(place_of_birth)', 
        '(nationality)', 
        '(address)', 
        '(tuition_status)',
        '(t_s_institution_or_sponsor_name)',
        '(t_s_phone)',
        '(t_s_email)',
        '(academic_status)', 
        '(first_time_attending_vocational_school)',
        '(name_of_school_have_attended)',
        '(location_of_school_have_attended)',

        '(Courses_selection_Auto_CAD)',
        '(Architectural_Drafting)',
        '(Auto_Mechanic)',
        '(Building_Construction)',
        '(Blue_Print_Reading)',
        '(Beauty_Therapy)',
        '(Carpentry)',
        '(Computer_Software)',
        '(Computer_Hardware)',

        '(Courses_selection_Computer_Software_Professional)',
        '(Courses_selection_Catering)',
        '(Courses_selection_Electricity)',
        '(Courses_selection_Event_Management)',
        '(Courses_selection_Electronic)',
        '(Courses_selection_Estimating)',
        '(Courses_selection_Fashion_Design)',
        '(Courses_selection_Hotel_Management)',
        '(Courses_selection_Interior_Decoration)',
        '(Courses_selection_Tailoring)',
        '(Courses_selection_PlumblingPastry)',
        '(Courses_selection_Plumbling)',
        '(Courses_selection_Project_Managament)',


        '(emc_first_name)',
        '(emc_last_name)',
        '(emc_gender)',
        '(emc_address)',
        '(emc_phone)',
        '(terms_agreement)', 
    ];

    
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (
                empty($_FILES['photo'])                                  ||
                empty($_POST['Fullname'])                                ||
                empty($_POST['Mobile'])                                  ||
                empty($_POST['status'])                                  ||
                empty($_POST['emial'])                                   ||
                empty($_POST['gender'])                                  ||
                empty($_POST['DOB'])                                     ||    
                empty($_POST['place_of_birth'])                          ||
                empty($_POST['nationality'])                             ||
                empty($_POST['address'])                                 ||
                empty($_POST['tuition_status'])                          ||
                empty($_POST['t_s_institution_or_sponsor_name'])         ||
                empty($_POST['t_s_phone'])                               ||
                empty($_POST['t_s_email'])                               ||
                empty($_POST['academic_status'])                         ||
                empty($_POST['first_time_attending_vocational_school'])  ||
                empty($_POST['name_of_school_have_attended'])            ||
                empty($_POST['location_of_school_have_attended'])        ||

                empty($_POST['Courses_selection_Auto_CAD'])              ||
                empty($_POST['Architectural_Drafting'])                  ||
                empty($_POST['Auto_Mechanic'])                           ||
                empty($_POST['Building_Construction'])                   ||
                empty($_POST['Blue_Print_Reading'])                      ||
                empty($_POST['Beauty_Therapy'])                          ||
                empty($_POST['Carpentry'])                               ||
                empty($_POST['Computer_Software'])                       ||
                empty($_POST['Computer_Hardware'])                       ||

                empty($_POST['Courses_selection_Computer_Software_Professional'])    ||
                empty($_POST['Courses_selection_Catering'])                          ||
                empty($_POST['Courses_selection_Electricity'])                       ||
                empty($_POST['Courses_selection_Event_Management'])                  ||
                empty($_POST['Courses_selection_Electronic'])                        ||
                empty($_POST['Courses_selection_Estimating'])                        ||
                empty($_POST['Courses_selection_Fashion_Design'])                    ||
                empty($_POST['Courses_selection_Hotel_Management'])                  ||
                empty($_POST['Courses_selection_Interior_Decoration'])               ||
                empty($_POST['Courses_selection_Tailoring'])                         ||
                empty($_POST['Courses_selection_PlumblingPastry'])                   ||
                empty($_POST['Courses_selection_Plumbling'])                         ||
                empty($_POST['Courses_selection_Project_Managament'])                ||






                empty($_POST['emc_first_name'])                          ||
                empty($_POST['emc_last_name'])                           ||
                empty($_POST['emc_gender'])                              ||
                empty($_POST['emc_address'])                             ||
                empty($_POST['emc_phone'])                               ||
                empty($_POST['terms_agreement'])                         
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            } else {
                $this->photo                                     =  $_FILES['photo']['name'];
                $this->Fullname                                  =  $this->input($_POST['Fullname'], STRICT_INPUT_FILTER);
                $this->Mobile                                    =  $this->input($_POST['Mobile'], STRICT_INPUT_FILTER);
                $this->status                                    =  $this->input($_POST['status'], STRICT_INPUT_FILTER);
                $this->emial                                     =  $this->input($_POST['emial'], STRICT_INPUT_FILTER);
                $this->gender                                    =  $this->input($_POST['gender'], STRICT_INPUT_FILTER);
                $this->birth_month                               =  $this->input($_POST['DOB'], STRICT_INPUT_FILTER);
                $this->place_of_birth                            =  $this->input($_POST['place_of_birth'], STRICT_INPUT_FILTER);
                $this->nationality                               =  $this->input($_POST['nationality'], STRICT_INPUT_FILTER);
                $this->address                                   =  $this->input($_POST['address'], STRICT_INPUT_FILTER);
                $this->tuition_status                            =  $this->input($_POST['tuition_status'], STRICT_INPUT_FILTER);
                $this->t_s_institution_or_sponsor_name           =  $this->input($_POST['t_s_institution_or_sponsor_name'], STRICT_INPUT_FILTER);
                $this->t_s_phone                                 =  $this->input($_POST['t_s_phone'], STRICT_INPUT_FILTER);
                $this->t_s_email                                 =  $this->input($_POST['t_s_email'], STRICT_INPUT_FILTER);
                $this->academic_status                           =  $this->input($_POST['academic_status'], STRICT_INPUT_FILTER);
                $this->first_time_attending_vocational_school    =  $this->input($_POST['first_time_attending_vocational_school'], STRICT_INPUT_FILTER);
                $this->name_of_school_have_attended              =  $this->input($_POST['name_of_school_have_attended'], STRICT_INPUT_FILTER);
                $this->location_of_school_have_attended          =  $this->input($_POST['location_of_school_have_attended'], STRICT_INPUT_FILTER);


                $this->Courses_selection_Auto_CAD                =  $this->input($_POST['Courses_selection_Auto_CAD'], STRICT_INPUT_FILTER);
                $this->Architectural_Drafting                    =  $this->input($_POST['Architectural_Drafting'], STRICT_INPUT_FILTER);
                $this->Auto_Mechanic                             =  $this->input($_POST['Auto_Mechanic'], STRICT_INPUT_FILTER);
                $this->Building_Construction                     =  $this->input($_POST['Building_Construction'], STRICT_INPUT_FILTER);
                $this->Blue_Print_Reading                        =  $this->input($_POST['Blue_Print_Reading'], STRICT_INPUT_FILTER);
                $this->Beauty_Therapy                            =  $this->input($_POST['Beauty_Therapy'], STRICT_INPUT_FILTER);
                $this->Carpentry                                 =  $this->input($_POST['Carpentry'], STRICT_INPUT_FILTER);
                $this->Computer_Software                         =  $this->input($_POST['Computer_Software'], STRICT_INPUT_FILTER);
                $this->Computer_Hardware                         =  $this->input($_POST['Computer_Hardware'], STRICT_INPUT_FILTER);


                $this->Courses_selection_Computer_Software_Professional     =   $this->input($_POST['Courses_selection_Computer_Software_Professional'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Catering                           =   $this->input($_POST['Courses_selection_Catering'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Electricity                        =   $this->input($_POST['Courses_selection_Electricity'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Event_Management                   =   $this->input($_POST['Courses_selection_Event_Management'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Electronic                         =   $this->input($_POST['Courses_selection_Electronic'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Estimating                         =   $this->input($_POST['Courses_selection_Estimating'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Fashion_Design                     =   $this->input($_POST['Courses_selection_Fashion_Design'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Hotel_Management                   =   $this->input($_POST['Courses_selection_Hotel_Management'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Interior_Decoration                =   $this->input($_POST['Courses_selection_Interior_Decoration'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Tailoring                          =   $this->input($_POST['Courses_selection_Tailoring'], STRICT_INPUT_FILTER);
                $this->Courses_selection_PlumblingPastry                    =   $this->input($_POST['Courses_selection_PlumblingPastry'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Plumbling                          =   $this->input($_POST['Courses_selection_Plumbling'], STRICT_INPUT_FILTER);
                $this->Courses_selection_Project_Managament                 =   $this->input($_POST['Courses_selection_Project_Managament'], STRICT_INPUT_FILTER);





                $this->emc_first_name                            =  $this->input($_POST['emc_first_name'], STRICT_INPUT_FILTER);
                $this->emc_last_name                             =  $this->input($_POST['emc_last_name'], STRICT_INPUT_FILTER);
                $this->emc_gender                                =  $this->input($_POST['emc_gender'], STRICT_INPUT_FILTER);
                $this->emc_address                               =  $this->input($_POST['emc_address'], STRICT_INPUT_FILTER);
                $this->emc_phone                                 =  $this->input($_POST['emc_phone'], STRICT_INPUT_FILTER);
                $this->terms_agreement                           =  $this->input($_POST['terms_agreement'], STRICT_INPUT_FILTER);
                $this->year                                      =  TIMESTAMP;
                

                $file = end(explode('.', $_FILES['photo']['name']));
                // print_r($file);
                
                if ( 
                    in_array($file, ["jpg", "jpeg", "png", "gif"])
                )
                {
                    $uploadFile = FileUploader2::fileDetails($_FILES['photo'], 'UploadRegularFile', STUDENTS_UPLOAD_PATH);
                    if ($uploadFile['status'] == false) {
                        $this->output(
                            false, 500, 
                            $uploadFile['body']['message'], 
                            $uploadFile['body']['error_info'], []
                        );
                    }
                    else {
                        $this->ensure_terms_agreement_Value_Is_Bool = ($this->terms_agreement == 'yes' || $this->terms_agreement == 'no') ?     true : false ;

                        if ( $this->ensure_terms_agreement_Value_Is_Bool == false ) {
                            $this->output(
                                false, 403, 
                                'Set: (terms_agreement) to (yes/no)', 
                                'Forbidden', []
                            );
                        } else {
        
                            $this->prevent_Redundant_Account = $this->selectFromTBL ( 
                                database::$conn, 
                                [], 
                                'participants',
                                [
                                    "`Fullname` = '$this->Fullname' ", 
                                    "AND `Mobile`  = '$this->Mobile' "
                                ], 
                                []
                            ); 
        
                            if ($this->prevent_Redundant_Account['total'] > 0) {
                                $this->output(
                                    false, 501, 
                                    'The account already exist', 
                                    $this->prevent_Redundant_Account['info'], []
                                );
                            } else {
                                $this->create_Account_Query = $this->insertIntoTBL ( 
                                    database::$conn, 'participants',
                                    [ 
                                        'photo',
                                        'Fullname',
                                        'Mobile',
                                        'status',
                                        'emial',
                                        'gender',
                                        'DOB',
                                        'place_of_birth',
                                        'nationality',
                                        'address',
                                        'tuition_status',
                                        't_s_institution_or_sponsor_name',
                                        't_s_phone',
                                        't_s_email',
                                        'academic_status',
                                        'first_time_attending_vocational_school',
                                        'name_of_school_have_attended',
                                        'location_of_school_have_attended',

                                        'Courses_selection_Auto_CAD',
                                        'Architectural_Drafting',
                                        'Auto_Mechanic',
                                        'Building_Construction',
                                        'Blue_Print_Reading',
                                        'Beauty_Therapy',
                                        'Carpentry',
                                        'Computer_Software',
                                        'Computer_Hardware',

                                        'Courses_selection_Computer_Software_Professional',
                                        'Courses_selection_Catering',
                                        'Courses_selection_Electricity',
                                        'Courses_selection_Event_Management',
                                        'Courses_selection_Electronic',
                                        'Courses_selection_Estimating',
                                        'Courses_selection_Fashion_Design',
                                        'Courses_selection_Hotel_Management',
                                        'Courses_selection_Interior_Decoration',
                                        'Courses_selection_Tailoring',
                                        'Courses_selection_Pastry',
                                        'Courses_selection_Plumbling',
                                        'Courses_selection_Project_Managament',


                                        'emc_first_name',
                                        'emc_last_name',
                                        'emc_gender',
                                        'emc_address',
                                        'emc_phone',
                                        'terms_agreement',
                                        'year'
                                    ], 
                                    [
                                        $this->photo,
                                        $this->Fullname,
                                        $this->Mobile, 
                                        $this->status, 
                                        $this->emial,
                                        $this->gender,
                                        $this->birth_month,
                                        $this->place_of_birth,
                                        $this->nationality,
                                        $this->address,
                                        $this->tuition_status,
                                        $this->t_s_institution_or_sponsor_name,
                                        $this->t_s_phone,
                                        $this->t_s_email,
                                        $this->academic,
                                        $this->first_time_attending_vocational_school,
                                        $this->name_of_school_have_attended,
                                        $this->location_of_school_have_attended,

                                        $this->Courses_selection_Auto_CAD,
                                        $this->Architectural_Drafting,
                                        $this->Auto_Mechanic, 
                                        $this->Building_Construction,
                                        $this->Blue_Print_Reading,
                                        $this->Beauty_Therapy,
                                        $this->Carpentry,
                                        $this->Computer_Software,
                                        $this->Computer_Hardware,


                                        $this->Courses_selection_Computer_Software_Professional,
                                        $this->Courses_selection_Catering,
                                        $this->Courses_selection_Electricity,
                                        $this->Courses_selection_Event_Management,
                                        $this->Courses_selection_Electronic,
                                        $this->Courses_selection_Estimating,
                                        $this->Courses_selection_Fashion_Design,
                                        $this->Courses_selection_Hotel_Management,
                                        $this->Courses_selection_Interior_Decoration,
                                        $this->Courses_selection_Tailoring,
                                        $this->Courses_selection_PlumblingPastry,
                                        $this->Courses_selection_Plumbling,
                                        $this->Courses_selection_Project_Managament,



                                        $this->emc_first_name,
                                        $this->emc_last_name,
                                        $this->emc_gender,
                                        $this->emc_address,
                                        $this->emc_phone,
                                        $this->terms_agreement,
                                        $this->year
                                    ] 
                                );
        
                                if ($this->create_Account_Query['status'] == false) {
                                    $this->output(
                                        false, 500, 
                                        'Application not sent', 
                                        $this->create_Account_Query['info'], []
                                    );
                                } else {
                                    if ($this->create_Account_Query['total'] == 1) {
                                        $this->output(
                                            true, 200, 
                                            'Application successfully sent', 
                                            $this->create_Account_Query['info'], []
                                        );
                                    } else {
                                        $this->output(
                                            false, 500, 
                                            'Application not sent', 
                                            $this->create_Account_Query['info'], []
                                        );
                                    }
                                }
                            }
                        }
                    } 

                    
                } else {
                    // Upload file
                    $this->output(
                        false, 403,     
                        'File must be of this type: jpg, jpeg, png or gif', 
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

} // END class ClassName 
// 
$student_Signup = new student_Signup;
$student_Signup->main();
?>