<?php 
/**
 * *********************************************************************************************************
 * @_forProject:  Application | Developed By: TAMMA CORPORATION
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
class educator_Login
{
    use apiResponseManager, queryBuilder, io_stream;

    private $Phone_number;
    private $Password;
    private $Phone_Number_Match_Query;
    private $params = [
        '(Phone_number)', 
        '(Password)'
    ];
  
    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_SESSION['staff-login-attempts'])) {
                $_SESSION['staff-login-attempts'] = 0;
            }
            
            if ($_SESSION['staff-login-attempts'] >= LOGIN_ATTEMPT_LIMIT) {
                $this->output(
                    false, 403, 
                    'Banned. Too many failed Attempts', 
                    'Forbidden', [ ['failed_attempts' => $_SESSION['staff-login-attempts'], 'User-Agent' => $_SERVER['HTTP_USER_AGENT'] ] ]
                ); exit;
            } else {
                if (
                    empty($_POST['Phone_number']) ||
                    empty($_POST['Password']) 
                ) {
                    $this->output(
                        false, 400, 
                        'Set: '.implode(',', $this->params).'', 
                        'Bad Request', []
                    );
                } else {
                    $this->Phone_number  =  $this->input($_POST['Phone_number'], STRICT_INPUT_FILTER);
                    $this->Password      =  htmlspecialchars($_POST['Password']);
                    
                    $this->Phone_Number_Match_Query = $this->selectFromTBL ( 
                        database::$conn, 
                        [], 
                        'admin_account', 
                        [" Phone_number = '$this->Phone_number' "], 
                        []
                    );  
                    
                    if ($this->Phone_Number_Match_Query['status'] == false) {
                        $this->output(
                            false, 500, 
                            'Error encountered', 
                            $this->Phone_Number_Match_Query['info'], []
                        );
                    } else {
                        // phone number matches
                        if ($this->Phone_Number_Match_Query['total'] > 0) {
                            $data = $this->Phone_Number_Match_Query['result']->fetch_assoc();
                            // password valid
                            if (password_verify($this->Password, $data['Password'])) {
                                
                                $session = password_hash($this->Phone_number, PASSWORD_DEFAULT);
                                $_SESSION['user-session'] = $session; 
                                $_SESSION['ACCOUNT_TYPE'] = $data['accountType'];
                                $_SESSION['staff-login-attempts'] = 0; // flush login attempts


                                $this->output(
                                    true, 200, 
                                    'Login Successful', 
                                    '', 
                                    [
                                        /*user_id*/     '_10'          =>  base64_encode($data['id']),
                                        /*photo*/       '_1010'        =>  base64_encode($data['photo']),
                                        /*First_Name*/  '_101010'      =>  base64_encode($data['First_Name']),
                                        /*Last_Name*/   '_10101010'    =>  base64_encode($data['Last_Name']),
                                        /*Gender*/      '_1010101010'  =>  base64_encode($data['Gender'])
                                    ]
                                );
                            }
                            // password invalid 
                            else {
                                $_SESSION['staff-login-attempts'] +=1;
                                $this->output(
                                    false, 401, 
                                    'Invalid credentials', 
                                    'Unauthorized', []
                                );
                            }
                        } else {
                            $_SESSION['staff-login-attempts'] +=1;
                            $this->output(
                                false, 401, 
                                'Invalid credentials', 
                                'Unauthorized', [$_SESSION['staff-login-attempts']]
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
$educator_Login = new educator_Login;
$educator_Login->main();
?>