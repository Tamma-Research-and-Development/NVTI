<?php 
  /**
   * *********************************************************************************************************
   * @_forProject: M.O.E Survey Application | Developed By: TAMMA CORPORATION
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
  class FileUploader2
  {
        public static function fileDetails($file, String $fileType, String $DESTINATION='')
        {
            try {
                $FileObject = new $fileType; // dynamic language feature
                return self::saveFile($FileObject, $file, $DESTINATION);
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'status_code' => 500,
                    'body' => [
                        'message' => 'Invalid file type',
                        'error_info' => $th->getMessage()
                    ]
                ];
            }
        }
        public function saveFile(FileUpload $fileHandler, $FILE_TO_UPLOAD, $DESTINATION='')
        {
            return $fileHandler->upload_file($FILE_TO_UPLOAD, $DESTINATION);
        }
  } // END class ClassName 

//   is_a($object, 'ClassName')
// $uploadFile = FileUploader2::fileDetails($_FILES['file'], 'UploadRegularFile', SETTINGS_UPLOAD_PATH);

// if ($uploadFile['status'] == false) {
//     $this->output(
//         false, 500, 
//         $uploadFile['body']['message'], 
//         $uploadFile['body']['error_info'], []
//     );
// }
?>

