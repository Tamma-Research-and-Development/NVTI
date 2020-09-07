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
  class UploadRegularFile implements FileUpload
  {
        public function upload_file($FILE_TO_UPLOAD, String $DESTINATION='') : array
        {
            if ($FILE_TO_UPLOAD['size'] > 0) {
                // initialize file for upload
                $path          =  (empty($DESTINATION)) ? FILE_UPLOAD_PATH : $DESTINATION;
                $File          =  $FILE_TO_UPLOAD;
                $FileName      =  $File["name"];
                $FileType      =  $File["type"];
                $Filetmp_name  =  $File["tmp_name"];
                $extension     =  strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
                $renameFile    =  $FileName;
                
                $possibleExtensions = explode('.', $FileName);

                // handle extension spoofing
                if (count($possibleExtensions) > 2) {
                    return [
                        'status' => false,
                        'body' => [
                            'message' => 'Extension Spoofing detected. File cannot have double extensions',
                            'error_info' => $uploadPic,
                            'dataset' => [
                                'file_name' => null
                            ]
                        ] 
                    ];
                } else {
                    // prevent executables
                    $blacklist = ['php', 'js', 'html', 'phtml', 'htaccess'];

                    if ( !in_array(pathinfo($FileName, PATHINFO_EXTENSION), $blacklist)  ) {
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

            } else {
                return [
                    'status' => false,
                    'body' => [
                        'message' => 'Upload attempt failed',
                        'error_info' => 'An empty file was passed',
                        'dataset' => [
                            'file_name' => null
                        ]
                    ] 
                ];
            }
        }
  } // END class ClassName 
?>