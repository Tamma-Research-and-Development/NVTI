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
final class addCurriculumData
{
    use apiResponseManager, queryBuilder, io_stream;

    private $subject;
    private $semester;
    private $grade;
    private $period;
    private $topic;
    private $learning_outcome;
    private $objectives;
    private $contents;
    private $activities;
    private $materials;
    private $competency_assessment;
    private $fileName = '';
    private $duplication_check_query;
    private $insert_curriculum_query;
    private $params = [ 
        '(subject)', '(semester)', 
        '(grade)', '(period)', '(topic)', '(learning_outcome)', 
        '(objectives)', '(contents)', '(activities)', '(materials)', '(competency_assessment)'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (empty($_POST['subject']) ||
                empty($_POST['semester']) ||
                empty($_POST['grade']) ||
                empty($_POST['period']) ||
                empty($_POST['topic']) ||
                empty($_POST['learning_outcome']) ||
                empty($_POST['objectives']) ||
                empty($_POST['contents']) ||
                empty($_POST['activities']) ||
                empty($_POST['materials']) ||
                empty($_POST['competency_assessment']) 
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->subject                = $this->input($_POST['subject'], STRICT_INPUT_FILTER);
                $this->semester               = $this->input($_POST['semester'], STRICT_INPUT_FILTER);
                $this->grade                  = $this->input($_POST['grade'], STRICT_INPUT_FILTER);
                $this->period                 = $this->input($_POST['period'], STRICT_INPUT_FILTER);
                $this->topic                  = $this->input($_POST['topic'], STRICT_INPUT_FILTER);
                $this->learning_outcome       = $this->input($_POST['learning_outcome'], STRICT_INPUT_FILTER);
                $this->objectives             = $this->input($_POST['objectives'], STRICT_INPUT_FILTER);
                $this->contents               = $this->input($_POST['contents'], STRICT_INPUT_FILTER);
                $this->activities             = $this->input($_POST['activities'], STRICT_INPUT_FILTER);
                $this->materials              = $this->input($_POST['materials'], STRICT_INPUT_FILTER);
                $this->competency_assessment  = $this->input($_POST['competency_assessment'], STRICT_INPUT_FILTER);

                // optional param is set 
                if (!empty($_FILES["file"])) {
                    
                    $upload_result = FileUploader2::fileDetails($_FILES["file"], 'UploadRegularFile', CURRICULUM_UPLOAD_PATH);

                    if ($upload_result['status'] == true) {
                        $this->fileName = $upload_result['body']['dataset']['file_name'].';';
                    } else {
                        $this->output(
                            false, 500, 
                            $upload_result['body']['message'], 
                            $upload_result['body']['error_info'],
                            $upload_result['body']['dataset']
                        );
                    }
                }

                $this->duplication_check_query = $this->selectFromTBL ( 
                    database::$conn, [], 'curriculum', 
                    [" `subject` = '$this->subject' ", " AND `semester` = '$this->semester' ", 
                        " AND `grade` = '$this->grade' ", " AND `period` = '$this->period' ", 
                        " AND `topic` = '$this->topic' "
                    ],
                    []
                ); 

                if ($this->duplication_check_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'Sorry, duplication check failed', 
                        $this->duplication_check_query['info'], []
                    );
                } else {
                    if ($this->duplication_check_query['total'] > 0) {
                        $this->output(
                            false, 403, 
                            'Sorry, this record already exist', 
                            $this->duplication_check_query['info'], []
                        );
                    } else {

                        $this->insert_curriculum_query = $this->insertIntoTBL ( 
                            database::$conn, 'curriculum', 
                            [
                                'files', 
                                'subject', 
                                'semester', 
                                'grade', 
                                'period',
                                'topic', 
                                'learning_outcome', 
                                'objectives', 
                                'contents',
                                'activities', 
                                'materials', 
                                'competency_assessment'
                            ], 
                            [
                                $this->fileName, 
                                $this->subject, 
                                $this->semester, 
                                $this->grade,
                                $this->period, 
                                $this->topic, 
                                $this->learning_outcome, 
                                $this->objectives,
                                $this->contents, 
                                $this->activities, 
                                $this->materials, 
                                $this->competency_assessment
                            ] 
                        );
                        
                        if ($this->insert_curriculum_query['status'] == false) {
                            $this->output(
                                false, 500, 
                                'Sorry curriculum and course materials could not be added', 
                                $this->insert_curriculum_query['info'], []
                            );
                        } else {
                            if ( $this->insert_curriculum_query['total'] == 1 ) {
                                $this->output(
                                    true, 200, 
                                    '1 New record was just added', 
                                    $this->insert_curriculum_query['info'], []
                                );
                            } else {
                                $this->output(
                                    false, 404, 
                                    'Sorry curriculum and course materials could not added', 
                                    $this->insert_curriculum_query['info'], []
                                );
                            }
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
$addCurriculumData = new addCurriculumData;
$addCurriculumData->main();
?>