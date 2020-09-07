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
final class editCurriculumData
{
    use apiResponseManager, queryBuilder, io_stream, fileUploader;

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
    private $fileName;
    private $filesUpdate;
    private $record_id;
    private $curriculum_update_query;
    private $fileName_list_retrieval_query;

    private $params = [
        '(subject)', 
        '(semester)', 
        '(grade)', 
        '(period)', 
        '(topic)', 
        '(learning_outcome)', 
        '(objectives)', 
        '(contents)', 
        '(activities)', 
        '(materials)', 
        '(competency_assessment)', 
        '(record_id)' 
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
                empty($_POST['competency_assessment']) ||
                empty($_POST['record_id']) 
            ) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->record_id              =  $this->input($_POST['record_id'], STRICT_INPUT_FILTER);
                $this->subject                =  $this->input($_POST['subject'], STRICT_INPUT_FILTER);
                $this->semester               =  $this->input($_POST['semester'], STRICT_INPUT_FILTER);
                $this->grade                  =  $this->input($_POST['grade'], STRICT_INPUT_FILTER);
                $this->period                 =  $this->input($_POST['period'], STRICT_INPUT_FILTER);
                $this->topic                  =  $this->input($_POST['topic'], STRICT_INPUT_FILTER);
                $this->learning_outcome       =  $this->input($_POST['learning_outcome'], STRICT_INPUT_FILTER);
                $this->objectives             =  $this->input($_POST['objectives'], STRICT_INPUT_FILTER);
                $this->contents               =  $this->input($_POST['contents'], STRICT_INPUT_FILTER);
                $this->activities             =  $this->input($_POST['activities'], STRICT_INPUT_FILTER);
                $this->materials              =  $this->input($_POST['materials'], STRICT_INPUT_FILTER);
                $this->competency_assessment  =  $this->input($_POST['competency_assessment'], STRICT_INPUT_FILTER);
                $this->fileName               =  ''; 

                // upload file if it exists
                if (!empty($_FILES["file"])) {
                    $upload_result = FileUploader2::fileDetails($_FILES["file"], 'UploadRegularFile', CURRICULUM_UPLOAD_PATH);

                    if ($upload_result['status'] == true) {
                        $this->fileName = $upload_result['body']['dataset']['file_name'];
                    } else {
                        $this->output(
                            false, 500, 
                            $upload_result['body']['message'], 
                            $upload_result['body']['error_info'],
                            $upload_result['body']['dataset']
                        );
                    }
                }
                
                $this->fileName_list_retrieval_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [" `files`, `id` "], 
                    'curriculum', 
                    [" `id` = '$this->record_id' "], 
                    []
                ); 

                $retrieved_fileName_list  =  $this->fileName_list_retrieval_query['result']->fetch_assoc();

                if ( in_array($this->fileName, explode(';', $retrieved_fileName_list['files'] )) ) {
                    $this->filesUpdate = false;
                } else {
                    $this->filesUpdate = $retrieved_fileName_list['files'] .= $this->fileName.';'; 
                }

                if ($this->filesUpdate == false) {
                    $this->output(
                        false, 501, 
                        'No changes were made. the file '. $this->fileName .' already exist', 
                        $this->curriculum_update_query['info'], []
                    );
                } else {
                    $this->curriculum_update_query = $this->updateTBL( 
                        database::$conn, 
                        'curriculum', 
                        [
                            " `files`                 =  '$this->filesUpdate', ",
                            " `subject`               =  '$this->subject', ",
                            " `semester`              =  '$this->semester', ",
                            " `grade`                 =  '$this->grade', ",
                            " `period`                =  '$this->period', ",
                            " `topic`                 =  '$this->topic', ",
                            " `learning_outcome`      =  '$this->learning_outcome', ",
                            " `objectives`            =  '$this->objectives', ",
                            " `contents`              =  '$this->contents', ",
                            " `activities`            =  '$this->activities', ",
                            " `materials`             =  '$this->materials', ",
                            " `competency_assessment` =  '$this->competency_assessment' ",
                            " WHERE id                =  '$this->record_id' "
                        ]
                    );

                    if ($this->curriculum_update_query['status'] == false) {
                        $this->output(
                            false, 500, 
                            'Sorry curriculum and course materials could not be updated', 
                            $this->curriculum_update_query['info'], []
                        );
                    } else {
                        if ( $this->curriculum_update_query['total'] > 0 ) {
                            $this->output(
                                true, 200, 
                                '1 record was just updated ', 
                                $this->curriculum_update_query['info'], []
                            );
                        } else {
                            $this->output(
                                false, 501, 
                                'No changes were made', 
                                $this->curriculum_update_query['info'], []
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
$editCurriculumData = new editCurriculumData;
$editCurriculumData->main();
?>