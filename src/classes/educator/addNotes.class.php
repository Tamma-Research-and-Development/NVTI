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
 *   2) Fullname of engineer. (Ephraim IC Doherty)
 *      @contact Phone: (+231) 0770-964-566
 *      @contact Mail: edoherty@tammacorp.com
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
final class addNotes extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $note_creator_id;
    private $trade_area;
    private $subject;
    private $note_title;
    private $note;
    private $added_date;
    private $teachersId;

    private $params = [
      '(note_creator_id)', 
      '(trade_area)', 
      '(subject)', 
      '(note_title)', 
      '(note) or (media)', 
      '(added_date)'
    ];
  
  public function main()
  {
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
      if (
          empty($_POST['note_creator_id'])   ||
          empty($_POST['trade_area'])        ||
          empty($_POST['subject'])           ||
          empty($_POST['note_title'])        ||
          empty($_POST['note'])              ||
          empty($_POST['added_date'])     
      ) { 
          $this->output(
              false, 400, 
              'Set: '.implode(',', $this->params).'', 
              'Bad Request ', []
        );
      }
      else {
        $this->note_creator_id   =  $this->input($_POST["note_creator_id"], STRICT_INPUT_FILTER);
        $this->teachersId        =  parent::teacherInfo();

        // print_r($this->teachersId[0]['id']);
        // exit;

        // $this->note_creator_id   =  parent::teacherInfo()->$educator_info_array['id'];
        if (isset($_FILES['note']['name'])) {
            $this->media             =  $_FILES['note']['name'];
        } else {
            $this->media             =  input($_POST["trade_area"], STRICT_INPUT_FILTER);;
        }
        
        $this->trade_area        =  $this->input($_POST["trade_area"], STRICT_INPUT_FILTER);
        $this->subject           =  $this->input($_POST["subject"], STRICT_INPUT_FILTER);
        $this->note_title        =  $this->input($_POST["note_title"], STRICT_INPUT_FILTER);
        $this->added_date        =  $this->input($_POST["added_date"], STRICT_INPUT_FILTER);


        $file = end(explode('.', $_FILES['media']['name']));
                // print_r($file);
                
        if ( in_array($file, ["mp4", "mp3", "avi", "3pg", "flv", "mkv"]) )
        {
            $uploadFile = FileUploader2::fileDetails($_FILES['media'], 'UploadRegularFile', VIDEO_UPLOAD_PATH);
            if ($uploadFile['status'] == false) {
                $this->output(
                    false, 500, 
                    $uploadFile['body']['message'], 
                    $uploadFile['body']['error_info'], []
                );
            }
        
            $this->add_staff_notes_into_TBL = $this->insertIntoTBL ( 
                database::$conn, 'notes', 
                [
                    "note_creator_id",
                    "trade_area",
                    "subject",
                    "note_title",
                    "note",
                    "added_date"
                ], 
                [
                    $this->note_creator_id, 
                    $this->trade_area, 
                    $this->subject, 
                    $this->note_title, 
                    $this->media, 
                    TIMESTAMP 
                ] 
            );
        
                if ($this->add_staff_notes_into_TBL['status'] == false) {
                $this->output(
                    false, 500, 
                    'Account setup failed', 
                    $this->add_staff_notes_into_TBL['info'], []
                );
            } else {
                if ($this->add_staff_notes_into_TBL['total'] == 1) {
                    $this->output(
                        true, 200, 
                        'Note Added', 
                        $this->add_staff_notes_into_TBL['info'], []
                    );
                } else {
                    $this->output(
                        false, 500, 
                        'Account setup failed', 
                        $this->add_staff_notes_into_TBL['info'], []
                    );
                }
            }
        
        } else {
            $this->output(
                false, 403,     
                'File must be of this type: mp4, mp3, avi, 3pg, flv, mkv', 
                'Forbidden', []
            );
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

}

$addNotes = new addNotes;
$addNotes->main();
