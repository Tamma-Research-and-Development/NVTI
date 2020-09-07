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
trait fileUploader
{
    
    public function upload_Base64_File($file, $fileName, $extension)
    {
        $fileContents = base64_decode($file);

        if (!is_dir(FILE_UPLOAD_PATH)) {
            return false;
        } else {
            if(is_writable($fileContents)) {
                file_put_contents(FILE_UPLOAD_PATH . $fileName.'.'.$extension, $fileContents);
                // 
                if ( !empty(file_get_contents(FILE_UPLOAD_PATH . $fileName.'.'.$extension)) ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function upload_file($FILE_TO_UPLOAD)
    {
        // initialize file for upload
        $path          =  FILE_UPLOAD_PATH;
        $File          =  $FILE_TO_UPLOAD;
        $FileName      =  $File["name"];
        $FileType      =  $File["type"];
        $Filetmp_name  =  $File["tmp_name"];
        $extension     =  strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
        $renameFile    =  $FileName.'.'.$extension;

        // prevent executables
        if ($extension != 'exe' || $extension != 'dll') {
            // attempt to upload photo
            $uploadPic = move_uploaded_file($Filetmp_name, $path.$renameFile);
           
            // upload attempt failed
            if ($uploadPic == false) {
                return [
                    'status' => false,
                    'body' => [
                        'message' => 'Upload attempt failed',
                        'error_info' => $uploadPic,
                        'dataset' => [
                            'file_name' => null
                        ]
                    ] 
                ];
            } else {
                return [
                    'status' => true,
                    'body' => [
                        'message' => 'Upload successful',
                        'error_info' => null,
                        'dataset' => [
                            'file_name' => $renameFile
                        ]
                    ] 
                ];
            }
        } else {
            return [
                'status' => false,
                'body' => [
                    'message' => 'Executables are not allowed',
                    'error_info' => 'Unsupported file type: '. $extension,
                    'dataset' => [
                        'file_name' => null
                    ]
                ] 
            ];
        }
    }
} // END class ClassName 
?>