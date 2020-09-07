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

/**
* undocumented class
*
* @package default
* @author 
**/
abstract class teacherDetails
{
    private $educator_data_fetch_query; 
    private $educator_info_array = []; 
    private $phone; 
    private $session; 

    public function teacherInfo()
    {
        $this->educator_data_fetch_query = database::$conn->query(" SELECT * FROM `admin_account` ");
        $this->session = $_SESSION['user-session'];

        while ($row = $this->educator_data_fetch_query->fetch_assoc()) {
            $this->phone = $row['Phone_number'];
            if ( password_verify($this->phone, $this->session) ) {
                $this->educator_info_array[] = [
                    'id'              =>  $row['id'],
                    'First_Name'      =>  $row['First_Name'],
                    'Last_Name'       =>  $row['Last_Name'],
                    'Gender'          =>  $row['Gender'],
                    'Phone_number'    =>  $row['Phone_number'],
                    // 'School_Teaching' =>  $row['School_Teaching'],
                    // 'classes_taught'  =>  $row['classes_taught'],
                    // 'subject'         =>  $row['subject'],
                    'accountType'     =>  $row['accountType']
                ];
            } else {
                // $educator_info_array[] = "false";
            }
        }
        return $this->educator_info_array;
    }
} 
?>