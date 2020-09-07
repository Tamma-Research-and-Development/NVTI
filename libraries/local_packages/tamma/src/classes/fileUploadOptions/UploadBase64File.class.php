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
  class UploadBase64File implements FileUpload
  {
        public function upload_file(Array $FILE_TO_UPLOAD, String $DESTINATION='') : array
        {
            $fileContents  = base64_decode($FILE_TO_UPLOAD);
            $path          =  (empty($DESTINATION)) ? FILE_UPLOAD_PATH : $DESTINATION;

            if (!is_dir($path)) {
                return [
                    'status' => false,
                    'body' => [
                        'message' => $path. ' is not a directory',
                        'error_info' => 'None',
                        'dataset' => [
                            'file_name' => null
                        ]
                    ] 
                ];
            } else {
                if(is_writable($fileContents)) {
                    file_put_contents($path . $fileName, $fileContents);
                    if ( !empty(file_get_contents($path . $fileName)) ) {
                        return [
                            'status' => true,
                            'body' => [
                                'message' => 'Upload successful',
                                'error_info' => null,
                                'dataset' => [
                                    'file_name' => $fileName
                                ]
                            ] 
                        ];
                    } else {
                        return [
                            'status' => false,
                            'body' => [
                                'message' => 'Upload attempt failed',
                                'error_info' => 'None',
                                'dataset' => [
                                    'file_name' => null
                                ]
                            ] 
                        ];
                    }
                } else {
                    return [
                        'status' => false,
                        'body' => [
                            'message' => 'File is not writable',
                            'error_info' => 'None',
                            'dataset' => [
                                'file_name' => null
                            ]
                        ] 
                    ];
                }
            }
        }
  } // END class ClassName 
?>