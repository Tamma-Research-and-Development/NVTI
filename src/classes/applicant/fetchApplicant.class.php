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
final class fetchApplicant extends teacherDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $fetch_student_list_query;
    private $educator_details;
    private $School_Teaching;
    private $classes_taught;
    private $record_id;
    private $search_phrase;
    private $studentDataAr;

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           
            $this->fetch_student_list_query = "";
            $this->educator_details  =  parent::teacherInfo();

            // 
            if (!empty($_GET['id']) && empty($_GET['searchPhrase'])) {

                $this->record_id = $this->input($_GET['id'], STRICT_INPUT_FILTER);

                $this->fetch_student_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', 
                    [
                        " `id` = '$this->record_id' ", 
                        " AND `deleted` = '0' " 
                    ], 
                    [" ORDER BY Fullname ASC "]
                );

            } 
            // lookup specific student with a search phrase
            else if (!empty($_GET['searchPhrase']) && empty($_GET['id'])) {

                $this->search_phrase  = $this->input($_GET['searchPhrase'], STRICT_INPUT_FILTER);

                $this->fetch_student_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', [ 
                        " `Fullname` LIKE '%$this->search_phrase%'  " ,
                        " AND `status` = 'applicant'  ",
                        " AND `deleted` = '0' "
                    ], 
                    [" ORDER BY Fullname ASC "]
                );

            } 
            // fetch all students
            else  if (empty($_GET['searchPhrase']) && empty($_GET['id'])  && empty($_GET['applicant'])) {
                
                $this->fetch_student_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', 
                    [" `status` = 'applicant' " ], 
                    [" ORDER BY Fullname ASC "]
                );
            }
            // fetch all applicants
            else  if (empty($_GET['searchPhrase']) && empty($_GET['id']) && !empty($_GET['applicant']) ) {
                
                $this->fetch_student_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'participants', 
                    [" `status` = 'applicant' " ], 
                    [" ORDER BY Fullname ASC "]
                );
            }
            else {
                $this->output(
                    false, 403, 
                    'Parameter conflict. attempting to lookup students using both: (searchPhrase) and (id)', 
                    'Forbidden', []
                );
            }
            
            if ( $this->fetch_student_list_query['status'] == false ) {
                $this->output(
                    false, 500, 
                    'Student list retrieval failed', 
                    $this->fetch_student_list_query['info'], []
                );
            } else {
                if ($this->fetch_student_list_query['total'] > 0 ) {

                    $this->studentDataAr = [];

                    while ( $row = $this->fetch_student_list_query['result']->fetch_assoc() ) {
                        $this->studentDataAr[] = [
                            'id'                                        =>   $row['id'],
                            'photo'                                     =>   $row['photo'],
                            // 'UserName'                                  =>   $row['UserName'],
                            'Fullname'                                  =>   $row['Fullname'],
                            'Mobile'                                    =>   $row['Mobile'],
                            'status'                                    =>   $row['status'],
                            'emial'                                     =>   $row['emial'],
                            'gender'                                    =>   $row['gender'],
                            'DOB'                                       =>   $row['DOB'],
                            'place_of_birth'                            =>   $row['place_of_birth'],
                            'nationality'                               =>   $row['nationality'],
                            'address'                                   =>   $row['address'],
                            'tuition_status'                            =>   $row['tuition_status'],
                            't_s_institution_or_sponsor_name'           =>   $row['t_s_institution_or_sponsor_name'],
                            't_s_phone'                                 =>   $row['t_s_phone'],
                            't_s_email'                                 =>   $row['t_s_email'],
                            'academic_status'                           =>   $row['academic_status'],
                            'first_time_attending_vocational_school'    =>   $row['first_time_attending_vocational_school'],
                            'name_of_school_have_attended'              =>   $row['name_of_school_have_attended'],
                            'location_of_school_have_attended'          =>   $row['location_of_school_have_attended'],
                            'emc_first_name'                            =>   $row['emc_first_name'],
                            'emc_last_name'                             =>   $row['emc_last_name'],
                            'emc_gender'                                =>   $row['emc_gender'],
                            'emc_address'                               =>   $row['emc_address'],
                            'emc_phone'                                 =>   $row['emc_phone'],
                            'terms_agreement'                           =>   $row['terms_agreement'],
                            'year'                                      =>   $row['year'],
                            // 'deleted'                                   =>   $row['deleted'],
                            'Auto_CAD'                                  =>   $row['Courses_selection_Auto_CAD'],
                            'Architectural_Drafting'                    =>   $row['Architectural_Drafting'],
                            'Auto_Mechanic'                             =>   $row['Auto_Mechanic'],
                            'Building_Construction'                     =>   $row['Building_Construction'],
                            'Blue_Print_Reading'                        =>   $row['Blue_Print_Reading'],
                            'Beauty_Therapy'                            =>   $row['Beauty_Therapy'],
                            'Carpentry'                                 =>   $row['Carpentry'],
                            'Computer_Software'                         =>   $row['Computer_Software'],
                            'Computer_Hardware'                         =>   $row['Computer_Hardware'],
                            'Computer_Software_Professional'            =>   $row['Courses_selection_Computer_Software_Professional'],
                            'Catering'                                  =>   $row['Courses_selection_Catering'],
                            'Electricity'                               =>   $row['Courses_selection_Electricity'],
                            'Event_Management'                          =>   $row['Courses_selection_Event_Management'],
                            'Electronic'                                =>   $row['Courses_selection_Electronic'],
                            'Estimating'                                =>   $row['Courses_selection_Estimating'],
                            'Fashion_Design'                            =>   $row['Courses_selection_Fashion_Design'],
                            'Hotel_Management'                          =>   $row['Courses_selection_Hotel_Management'],
                            'Interior_Decoration'                       =>   $row['Courses_selection_Interior_Decoration'],
                            'Tailoring'                                 =>   $row['Courses_selection_Tailoring'],
                            'PlumblingPastry'                           =>   $row['Courses_selection_PlumblingPastry'],
                            'Plumbling'                                 =>   $row['Courses_selection_Plumbling'],
                            'Project_Managame'                          =>   $row['Courses_selection_Project_Managame'],
                        ];
                    }
                    
                    $this->output(
                        true, 200, 
                        $this->fetch_student_list_query['total']. ' students found in '. $this->School_Teaching, 
                        $this->fetch_student_list_query['info'], 
                        [$this->studentDataAr]
                    );

                } else {
                    $this->output(
                        false, 404, 
                        '0 Students found', 
                        $this->fetch_student_list_query['info'], []
                    );
                }
            }
            
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
} // END class ClassName 
// 
$fetchApplicant = new fetchApplicant;
$fetchApplicant->main();
?>
