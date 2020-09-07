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
final class getStudentSubjectList extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;
    
    private $school;
    private $class;
    private $subject_list_query;
    private $subject;
    private $subjects_string;
    private $subjects_Array;
    private $student_subject_list_array;

    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->subject_list_query = '';

            // Restrictive fetch - student must be logged in 
            if ( empty($_GET['school']) || empty($_GET['class']) ) {

                $studentDetails  =  parent::studentInfo();

                $this->school    =  $studentDetails['school'];
                $this->class     =  $studentDetails['class'];

                $this->subject_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'admin_account', 
                    [
                        " `School_Teaching` = '$this->school' ", 
                        " AND `classes_taught` LIKE '%$this->class%' "
                    ], 
                    []
                );  

            }
            //  Non-restrictive fetch - no login required
            else if ( !empty($_GET['school']) || !empty($_GET['class']) ) {

                $this->school = $this->input($_GET['school'], STRICT_INPUT_FILTER);
                $this->class  = $this->input($_GET['class'], STRICT_INPUT_FILTER);

                $this->subject_list_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'admin_account', 
                    [
                        " `School_Teaching` = '$this->school' ", 
                        " AND `classes_taught` LIKE '%$this->class%' "
                    ], 
                    []
                );  
            }

            if ($this->subject_list_query['status'] == false) {
                $this->output(
                    false, 400, 
                    'teacher fetch failed', 
                    $this->subject_list_query['info'], []
                );
            } else {
                if ($this->subject_list_query['total'] > 0) {
                    $this->student_subject_list_array = [];
                    $this->subjects_string = '';

                    while ($row = $this->subject_list_query['result']->fetch_assoc()) {
                        $this->subject = $row['subject'];
                        $this->subjects_Array = explode(";", $this->subject);

                        $this->subjects_string .= $this->subject;

                        $this->student_subject_list_array[] = [
                            'fullname' =>  $row['First_Name'] . ' ' . $row['Last_Name'],
                            'phone'    =>  $row['Phone_number'],
                            'subjects' =>  $this->subjects_Array
                        ];
                    }

                    $this->output(
                        true, 200, 
                        'Subject list acquired', 
                        $this->subject_list_query['info'], 
                        [
                            'subject_list' =>  explode(';', $this->subjects_string),
                            'subject_list_details' => $this->student_subject_list_array,
                        ]
                    );
                } else {
                    $this->output(
                        false, 404, 
                        'No teachers in class at the moment', 
                        $this->subject_list_query['info'], []
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
$getStudentSubjectList = new getStudentSubjectList;
$getStudentSubjectList->main();
?>