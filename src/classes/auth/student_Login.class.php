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
class student_Login
{
    use apiResponseManager, queryBuilder, io_stream;

    private $UserName;
    private $phone;
    private $potentials;
    private $username_match_query;
    private $username_query_data;
    private $params = [
        '(UserName)', 
        '(phone)'
    ];

    public function main()
    {
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_SESSION['student-login-attempts'])) {
                $_SESSION['student-login-attempts'] = 0;
            }

            if ($_SESSION['student-login-attempts'] >= LOGIN_ATTEMPT_LIMIT) {
                $this->output(
                    false, 403, 
                    'Banned. Too many failed Attempts', 
                    'Forbidden', [ ['failed_attempts' => $_SESSION['student-login-attempts'], 'User-Agent' => $_SERVER['HTTP_USER_AGENT'] ] ]
                ); exit;
            } else {
                if (empty($_POST['UserName']) || 
                    empty($_POST['phone']) 
                ) {
                    $this->output(
                        false, 400, 
                        'Set: '.implode(',', $this->params).'', 
                        'Bad Request', []
                    );
                } else {
                    $this->UserName = $this->input($_POST['UserName'], STRICT_INPUT_FILTER);
                    $this->phone    = $this->input($_POST['phone'], STRICT_INPUT_FILTER);
                        
                    $this->username_match_query = $this->selectFromTBL ( 
                        database::$conn, [], 'participants', [" `Mobile` = '$this->phone' "], [] 
                    );  

                    if ($this->username_match_query['status'] == false) {
                        $this->output(
                            false, 500, 
                            'Error encountered', 
                            $this->username_match_query['info'], []
                        );
                    } else {
                        if ($this->username_match_query['total'] > 0) {
                            $this->username_query_data = $this->username_match_query['result']->fetch_assoc();

                            if ( password_verify($this->UserName, $this->username_query_data['UserName']) ) {
                                $_SESSION['user-session'] = $this->username_query_data['UserName'];
                                $_SESSION['ACCOUNT_TYPE'] = 'student';

                                $_SESSION['student-login-attempts'] = 0;
                                $this->output(
                                    true, 200, 
                                    'Login Successful', 
                                    '', 
                                    [
                                        'PHPSESSID' => session_id()
                                    ]
                                );
                            }
                            // invalid username 
                            else {
                                $_SESSION['student-login-attempts'] +=1;
                                $this->output(
                                    false, 401, 
                                    'Invalid credentials', 
                                    '', []
                                );
                            }
                        }
                        // invalid phone number 
                        else {
                            $_SESSION['student-login-attempts'] +=1;
                            $this->output(
                                false, 401, 
                                'Invalid credentials', 
                                '', []
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
$student_Login = new student_Login;
$student_Login->main();
?>