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

final class updateStudentInfo extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $updateImageQuery;
    private $updateStatusQuery;
    private $fetchStatusQuery;
    private $studentUpdateQuery;
    private $params = [
        'user_id',
        'Fullname',
        'DOB',
        'place_of_birth',
        'nationality',
        'gender',
        'Mobile',
        'emial',
        'address',
        'tuition_status',
        't_s_institution_or_sponsor_name',
        't_s_phone',
        't_s_email',
        'academic_status',
        'emc_first_name',
        'emc_last_name',
        'emc_gender',
        'emc_address',
        'emc_phone',
        'first_time_attending_vocational_school',
        'name_of_school_have_attended',
        'location_of_school_have_attended',
        'Auto_CAD',
        'Architectural_Drafting',
        'Auto_Mechanic',
        'Building_Construction',
        'Blue_Print_Reading',
        'Beauty_Therapy',
        'Carpentry',
        'Computer_Software',
        'Computer_Hardware',
        'Computer_Software_Professional',
        'Catering',
        'Electricity',
        'Event_Management',
        'Electronic',
        'Estimating',
        'Fashion_Design',
        'Hotel_Management',
        'Interior_Decoration',
        'Tailoring',
        'Courses_selection_Pastry',
        'Plumbling',
        'Project_Managame'
    ];

    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            if ( count($this->params) !=  count($_POST) ) {
                // Update image
                if ( !empty($_FILES['photo']) && !empty($_POST['user_id']) ) {

                    $uploadFile = FileUploader2::fileDetails($_FILES['photo'], 'UploadRegularFile', STUDENTS_UPLOAD_PATH);
    
                    if ($uploadFile['status'] == false) {
                        $this->output(
                            false, 500, 
                            $uploadFile['body']['message'], 
                            $uploadFile['body']['error_info'], []
                        );
                    } else {
                        $inputs = (object)$_POST;
                        $this->updateImageQuery = $this->updateTBL( 
                            database::$conn, 
                            'participants', 
                            [
                                "photo       =  '".$this->input($uploadFile['body']['dataset']['file_name'], STRICT_INPUT_FILTER)."'",
                                "WHERE id    =  '".$this->input($inputs->user_id, STRICT_INPUT_FILTER)."'  "
                            ]
                        );
                        // 
                        if ( $this->updateImageQuery['status'] == false ) {
                            $this->output(
                                false, 500, 
                                'Application not sent', 
                                $this->updateImageQuery['info'], []
                            );
                        } else {
                            if ( $this->updateImageQuery['total'] > 0 ) {
                                $this->output(
                                    true, 200, 
                                    $this->input($uploadFile['body']['dataset']['file_name'], STRICT_INPUT_FILTER) . " update successful", 
                                    $this->updateImageQuery['info'], 
                                    []
                                );
                            } else {
                                $this->output(
                                    false, 501, 
                                    "Sorry, there's nothing to update", 
                                    $this->updateImageQuery['info'], []
                                );
                            }
                        }
                    }
                } 
                // Update status
                elseif ( !empty($_POST['status'])  && !empty($_POST['user_id']) ) {
                    $inputs = (object)$_POST;
                    # build query
                    $this->fetchStatusQuery = $this->selectFromTBL ( 
                        database::$conn, 
                        [], 
                        'participants', 
                        [
                            "id = '".$this->input($inputs->user_id, STRICT_INPUT_FILTER)."' "
                        ], [] 
                    ); 
                    
                    if ( $this->fetchStatusQuery['status'] == false ) { 
                        $this->output(
                            false, 500, 
                            'Status retreival failed', 
                            $this->fetchStatusQuery['info'], []
                        );
                    }
                    else { 
                        $currentStatus = $this->fetchStatusQuery['result']->fetch_object()->status;          
                        
                        if ( $currentStatus == STUDENT_STATUS['pending'] ) {
                            $this->output(
                                false, 501, 
                                'Sorry, student status (' .STUDENT_STATUS['pending'].') can only be changed after a student registers', 
                                $this->fetchStatusQuery['info'], []
                            );
                        } else {
                            // 
                            $this->updateStatusQuery = $this->updateTBL( 
                                database::$conn, 
                                'participants', 
                                [
                                    "status    =  '".$this->input($inputs->status,  STRICT_INPUT_FILTER)."' ",
                                    "WHERE id  =  '".$this->input($inputs->user_id, STRICT_INPUT_FILTER)."' "
                                ]
                            );
                            
                            if ( $this->updateStatusQuery['status'] == false ) {
                                $this->output(
                                    false, 500, 
                                    'Status update failed', 
                                    $this->updateStatusQuery['info'], []
                                );
                            } else {
                                $this->output(
                                    true, 200, 
                                    'Status update successful', 
                                    $this->updateStatusQuery['info'], []
                                );
                            }
                        }
                    }
                }
                else {
                    $this->output(
                        false, 400, 
                        'The supplied request is limited. please set all of the following: '.implode(', ', $this->params).'', 
                        'Bad Request', []
                    );
                }
            } 
            // Update text
            else {
                // is done this way to ensure the recieved array always matches the required param
                if ( empty(array_diff_key( array_flip($this->params), $_POST )) && empty(array_diff_key( $_POST, array_flip($this->params)) ) ) {
                    $inputs = (object)$_POST;

                    // 
                    $this->studentUpdateQuery = $this->updateTBL( 
                        database::$conn, 
                        'participants', 
                        [
                            " `Fullname`                                           =  '".$this->input($inputs->Fullname, STRICT_INPUT_FILTER)."', ",
                            " `DOB`                                                =  '".$this->input($inputs->DOB, STRICT_INPUT_FILTER)."', ",
                            " `place_of_birth`                                     =  '".$this->input($inputs->place_of_birth, STRICT_INPUT_FILTER)."', ",
                            " `nationality`                                        =  '".$this->input($inputs->nationality, STRICT_INPUT_FILTER)."', ",
                            " `gender`                                             =  '".$this->input($inputs->gender, STRICT_INPUT_FILTER)."', ",
                            " `Mobile`                                             =  '".$this->input($inputs->Mobile, STRICT_INPUT_FILTER)."', ",
                            " `emial`                                              =  '".$this->input($inputs->emial, STRICT_INPUT_FILTER)."', ",
                            " `address`                                            =  '".$this->input($inputs->address, STRICT_INPUT_FILTER)."', ",
                            " `tuition_status`                                     =  '".$this->input($inputs->tuition_status, STRICT_INPUT_FILTER)."', ",
                            " `t_s_institution_or_sponsor_name`                    =  '".$this->input($inputs->t_s_institution_or_sponsor_name, STRICT_INPUT_FILTER)."', ",
                            " `t_s_phone`                                          =  '".$this->input($inputs->t_s_phone, STRICT_INPUT_FILTER)."', ",
                            " `t_s_email`                                          =  '".$this->input($inputs->t_s_email, STRICT_INPUT_FILTER)."', ",
                            " `academic_status`                                    =  '".$this->input($inputs->academic_status, STRICT_INPUT_FILTER)."', ",
                            " `emc_first_name`                                     =  '".$this->input($inputs->emc_first_name, STRICT_INPUT_FILTER)."', ",
                            " `emc_last_name`                                      =  '".$this->input($inputs->emc_last_name, STRICT_INPUT_FILTER)."', ",
                            " `emc_gender`                                         =  '".$this->input($inputs->emc_gender, STRICT_INPUT_FILTER)."', ",
                            " `emc_address`                                        =  '".$this->input($inputs->emc_address, STRICT_INPUT_FILTER)."', ",
                            " `emc_phone`                                          =  '".$this->input($inputs->emc_phone, STRICT_INPUT_FILTER)."', ",
                            " `first_time_attending_vocational_school`             =  '".$this->input($inputs->first_time_attending_vocational_school, STRICT_INPUT_FILTER)."', ",
                            " `name_of_school_have_attended`                       =  '".$this->input($inputs->name_of_school_have_attended, STRICT_INPUT_FILTER)."', ",
                            " `location_of_school_have_attended`                   =  '".$this->input($inputs->location_of_school_have_attended, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Auto_CAD`                         =  '".$this->input($inputs->Auto_CAD, STRICT_INPUT_FILTER)."', ",
                            " `Architectural_Drafting`                             =  '".$this->input($inputs->Architectural_Drafting, STRICT_INPUT_FILTER)."', ",
                            " `Auto_Mechanic`                                      =  '".$this->input($inputs->Auto_Mechanic, STRICT_INPUT_FILTER)."', ",
                            " `Building_Construction`                              =  '".$this->input($inputs->Building_Construction, STRICT_INPUT_FILTER)."', ",
                            " `Blue_Print_Reading`                                  =  '".$this->input($inputs->Blue_Print_Reading, STRICT_INPUT_FILTER)."', ",
                            " `Beauty_Therapy`                                     =  '".$this->input($inputs->Beauty_Therapy, STRICT_INPUT_FILTER)."', ",
                            " `Carpentry`                                          =  '".$this->input($inputs->Carpentry, STRICT_INPUT_FILTER)."', ",
                            " `Computer_Software`                                  =  '".$this->input($inputs->Computer_Software, STRICT_INPUT_FILTER)."', ",
                            " `Computer_Hardware`                                  =  '".$this->input($inputs->Computer_Hardware, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Computer_Software_Professional`   =  '".$this->input($inputs->Computer_Software_Professional, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Catering`                         =  '".$this->input($inputs->Catering, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Electricity`                      =  '".$this->input($inputs->Electricity, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Event_Management`                 =  '".$this->input($inputs->Event_Management, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Electronic`                       =  '".$this->input($inputs->Electronic, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Estimating`                       =  '".$this->input($inputs->Estimating, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Fashion_Design`                   =  '".$this->input($inputs->Fashion_Design, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Hotel_Management`                 =  '".$this->input($inputs->Hotel_Management, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Interior_Decoration`              =  '".$this->input($inputs->Interior_Decoration, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Tailoring`                        =  '".$this->input($inputs->Tailoring, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Pastry`                           =  '".$this->input($inputs->Courses_selection_Pastry, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Plumbling`                        =  '".$this->input($inputs->Plumbling, STRICT_INPUT_FILTER)."', ",
                            " `Courses_selection_Project_Managament`               =  '".$this->input($inputs->Project_Managame, STRICT_INPUT_FILTER)."'  ",
                            " WHERE id                                             =  '".$this->input($inputs->user_id, STRICT_INPUT_FILTER)."'  "
                        ]
                    );
                    //
                    if ( $this->studentUpdateQuery['status'] == false ) {
                        $this->output(
                            false, 500, 
                            'Application not sent', 
                            $this->studentUpdateQuery['info'], []
                        );
                    } else {
                        if ( $this->studentUpdateQuery['total'] > 0 ) {
                            $this->output(
                                true, 200, 
                                $this->input($inputs->Fullname, STRICT_INPUT_FILTER) . "'s  info update successful", 
                                $this->studentUpdateQuery['info'], 
                                []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                "Sorry, there's nothing to update", 
                                $this->studentUpdateQuery['info'], []
                            );
                        }
                    }
                } else {
                    $this->output(
                        false, 400, 
                        'Set: '.implode(', ', $this->params).'', 
                        'Bad Request', []
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
}
// END class updateStudentInfo 
// 
$updateStudentInfo = new updateStudentInfo;
$updateStudentInfo->main();
?>