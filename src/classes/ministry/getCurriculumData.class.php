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
final class getCurriculumData
{
    use apiResponseManager, queryBuilder, io_stream, fileUploader;

    private $record_id;
    private $search_phrase;
    private $curriculumArray = [];
    private $fetch_curriculum_query;
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if (!empty($_GET['record_id'])) {
                $this->record_id = $this->input($_GET['record_id'], STRICT_INPUT_FILTER);

                $this->fetch_curriculum_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'curriculum', 
                    [" `id` = '$this->record_id' "], 
                    []
                ); 

            } elseif (!empty($_GET['search_phrase'])) {
                $this->search_phrase = $this->input($_GET['search_phrase'], STRICT_INPUT_FILTER);

                $this->fetch_curriculum_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'curriculum', 
                    [
                        " `subject`               LIKE  '%$this->search_phrase%' OR ",
                        " `grade`                 LIKE  '%$this->search_phrase%' OR ",
                        " `topic`                 LIKE  '%$this->search_phrase%' OR ",
                        " `learning_outcome`      LIKE  '%$this->search_phrase%' OR ",
                        " `objectives`            LIKE  '%$this->search_phrase%' OR ",
                        " `contents`              LIKE  '%$this->search_phrase%' OR ",
                        " `activities`            LIKE  '%$this->search_phrase%' OR ",
                        " `competency_assessment` LIKE  '%$this->search_phrase%' ",
                    ], 
                    []
                ); 

            } else {
                $this->fetch_curriculum_query = $this->selectFromTBL ( 
                    database::$conn, 
                    [], 
                    'curriculum', 
                    [], 
                    ["Order BY `semester`, `period`, `grade` ASC limit 100 "]
                ); 
            }
             
            if ($this->fetch_curriculum_query['status'] == false) {
                $this->output(
                    false, 500, 
                    'Sorry curriculum and course materials not found', 
                    $this->fetch_curriculum_query['info'], []
                );
            } else {
                if ( $this->fetch_curriculum_query['total'] > 0 ) {

                    while ( $row = $this->fetch_curriculum_query['result']->fetch_assoc() ) {
                        $fileList  = [];

                        foreach (explode(';', $row["files"]) as $data) {
                            if ($data != "") {
                                $fileList[] = CURRICULUM_UPLOAD_PATH.$data;
                            } 
                        }

                        $this->curriculumArray[] = [
                            'id'                    =>  $row["id"],
                            'files'                 =>  $fileList,
                            'subject'               =>  $this->input($row["subject"], OUTPUT_FILTER),
                            'semester'              =>  $this->input($row["semester"], OUTPUT_FILTER),
                            'grade'                 =>  $this->input($row["grade"], OUTPUT_FILTER),
                            'period'                =>  $this->input($row["period"], OUTPUT_FILTER),
                            'topic'                 =>  $this->input($row["topic"], OUTPUT_FILTER),
                            'learning_outcome'      =>  $this->input($row["learning_outcome"], OUTPUT_FILTER),
                            'objectives'            =>  $this->input($row["objectives"], OUTPUT_FILTER),
                            'contents'              =>  $this->input($row["contents"], OUTPUT_FILTER),
                            'activities'            =>  $this->input($row["activities"], OUTPUT_FILTER),
                            'materials'             =>  $this->input($row["materials"], OUTPUT_FILTER),
                            'competency_assessment' =>  $this->input($row["competency_assessment"], OUTPUT_FILTER)
                        ];
                    }

                    $this->output(
                        true, 200, 
                        'Curriculum and course materials retrieved', 
                        $this->fetch_curriculum_query['info'], 
                        [$this->curriculumArray]
                    );
                } else {
                    $this->output(
                        false, 404, 
                        'Sorry There are no curriculum and course materials', 
                        $this->fetch_curriculum_query['info'], []
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
$getCurriculumData = new getCurriculumData;
$getCurriculumData->main();
?>