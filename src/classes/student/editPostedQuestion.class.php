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
final class editPostedQuestion extends studentDetails
{
    use apiResponseManager, queryBuilder, io_stream;

    private $id;
    private $studentName;
    private $teacherPhone;
    private $Qsubject;
    private $Question;
    private $teacher_response;
    private $question_update_query;
    private $params = [
        "(id)",
        "(teacherPhone)",
        "(class)",
        "(subject)",
        "(Question)"
    ];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            if (
                empty($_POST['id'])           ||
                empty($_POST['teacherPhone']) ||
                empty($_POST['subject'])     ||
                empty($_POST['Question'])  
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {

                $studentDetails          =  parent::studentInfo();

                $this->id                =  $this->input($_POST['id'], STRICT_INPUT_FILTER);
                $this->studentName       =  $studentDetails['Fullname'];
                $this->teacherPhone      =  $this->input($_POST['teacherPhone'], STRICT_INPUT_FILTER);
                $this->Qsubject          =  $this->input($_POST['subject'], STRICT_INPUT_FILTER);
                $this->Question          =  $this->input($_POST['Question'], STRICT_INPUT_FILTER);
                
                $this->question_update_query = $this->updateTBL( 
                    database::$conn, 'ask_teacher', 
                    [
                        " `studentName`       =  '$this->studentName', ", 
                        " `teacherPhone`      =  '$this->teacherPhone', ", 
                        " `Qsubject`          =  '$this->Qsubject', ", 
                        " `Question`          =  '$this->Question' ", 
                        "  WHERE `id`         =  '$this->id'  "
                    ]
                );                

                
                if ($this->question_update_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Update failed', 
                        $this->question_update_query['info'], []
                    );
                } else {
                    
                    if ($this->question_update_query['total'] == 1) {
                        $this->output(
                            true, 200, 
                            '1 record updated', 
                            $this->question_update_query['info'], []
                        );
                    } else {
                        $this->output(
                            false, 501, 
                            'No changes were made', 
                            $this->question_update_query['info'], []
                        );
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
$editPostedQuestion = new editPostedQuestion;
$editPostedQuestion->main();
?>