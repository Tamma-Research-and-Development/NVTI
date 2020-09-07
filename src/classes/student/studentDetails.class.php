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

// NOTE: not using queryBuilder trait here. needs to be converted into a static method.

/**
* undocumented class
*
* @package default
* @author 
**/
abstract class studentDetails
{
    private $username;
    private $get_Student_Info_Query;
    private $student_info_array;
    private $student_info_data;
     
    final public function studentInfo()
    {   
        $this->username   =  $_SESSION['user-session'];
        $this->get_Student_Info_Query  =  database::$conn->query(
            "SELECT * FROM `participants` WHERE `UserName` = '$this->username'"
        );
         
        if ($this->get_Student_Info_Query == false) {
            $this->student_info_array =  [
                'status' => false,
                'status_code' => 500,
                'body' => [
                    'message' => 'student details fetch failed',
                    'error_info' => database::$conn->error
                ]
            ];
        } else {
            if ($this->get_Student_Info_Query->num_rows > 0) {
                $this->student_info_array = [];
                $this->student_info_data  = $this->get_Student_Info_Query->fetch_assoc();

                $this->student_info_array = [
                    'status'    =>  true,
                    'id'        =>  $this->student_info_data['id'],
                    'UserName'  =>  $this->student_info_data['UserName'],
                    'Fullname'  =>  $this->student_info_data['Fullname'],
                    'Mobile'    =>  $this->student_info_data['Mobile'],
                    'Age'       =>  $this->student_info_data['Age'],
                    'school'    =>  $this->student_info_data['school'],
                    'class'     =>  $this->student_info_data['class']
                ];
            } else {
                $this->student_info_array =  [
                    'status' => false,
                    'status_code' => 404,
                    'body' => [
                        'message' => '0 results found',
                        'error_info' => database::$conn->error
                    ]
                ];
            }
        }
        return $this->student_info_array;
    }
} // END class ClassName 
?>