<?php 
    session_start();
    // PURPOSE: database production environment defaults
    // define('ENVIRONMENT_HOST_NAME', 'localhost');
    // define('ENVIRONMENT_USER_NAME', 'tammacor_covid19');
    // define('ENVIRONMENT_DB_NAME', 'tammacor_schoolmass_covid-19');
    // define('ENVIRONMENT_DB_PASSWORD', 'schoolmass_covid-19@tamma');

    // PURPOSE: database test environment defaults
    define('ENVIRONMENT_HOST_NAME', 'localhost');
    define('ENVIRONMENT_USER_NAME', 'root');
    define('ENVIRONMENT_DB_NAME', 'schoolmass _covid-19');
    define('ENVIRONMENT_DB_PASSWORD', '');

    // PURPOSE:
    define('DOC_ROOT', $_SERVER["DOCUMENT_ROOT"]);          // globally initialize server root for PHP file inclusions
    define('SUB_DOC_ROOT', '/www/NVTI/');   // 
    define('IMAGE_ROOT', 'public/assets/media/img/');       // 
    define('SITENAME', $_SERVER["SERVER_NAME"]);            //
    define('CURRENT_LOCATION', $_SERVER["REQUEST_URI"]);    // collect and initialize name of current page

    // PURPOSE: 
    define('LOGIN_ATTEMPT_LIMIT', 5);                       // specifies acceptable login attempts
    define('BULLETIN_AUDIANCE', ['public','admin','teacher','student']);
    define('STAFF_ACCOUNT', [
        'admin'     => 'admin', 
        'admission' => 'admission', 
        'finance'   => 'finance', 
        'teacher'   => 'teacher'
    ]);
    define('STUDENT_STATUS', [
        'applicant'    => 'applicant', 
        'pending'      => 'pending registration', 
        'active'       => 'active', 
        'suspended'    => 'suspended', 
        'terminated'   => 'terminated'
    ]);
    define('NOTIFICATION_TYPES', ['sms', 'hybrid']);
    define('SMS_SERVICE', [
        'username' => 'akamara',
        'password' => 'bullet11',
        'url'      => 'http://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30',
    ]);
    define('EMAIL_SERVICE', [
        'host'      =>  'tammacorp.com', 
        'username'  =>  'paynote@tammapaynote.net', 
        'password'  =>  '<mNio1_o"!OIPe;', 
        'from'      =>  'paynote@tammapaynote.net', 
        'fromName'  =>  'NetLib Vocational Institute', 
    ]);

    // PURPOSE: io_stream controls
    define('STRICT_INPUT_FILTER', 0);                     // tells io_stream to process data for input
    define('INPUT_FILTER', 1);                            // tells io_stream to process data for output
    define('OUTPUT_FILTER', 2);                           // tells io_stream to process data for output
    define('IS_NULL', 3);                                 // tells io_stream to look out for empty values   
    define('IS_ARRAY', 4);                                // tells io_stream to process data as array instead of string   
    define('ENCRYPT', 1);                                 // tells io_stream to encrypt   
    define('DECRYPT', 0);                                 // tells io_stream to decrypt   
    define('CUSTOM_ERROR_HANDLER', true);                 // method needs to handle errors locally 

    // PURPOSE: timezone, date, time
    define('__LOCALTIMEZONE__', date_default_timezone_set("Africa/Monrovia") ); // set timezone to Liberia
    define('__LOCALDATE__', date('l d, F o') );                                    // set the date
    define('__LOCALTIME__', date('g:i:s A') );                                  // set the time
    define('TIMESTAMP', __LOCALDATE__ .' - '. __LOCALTIME__ );                                  // set the time

    // PURPOSE: media storage path
    define('FILE_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT);
    define('SETTINGS_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'settings/');
    define('STAFF_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'staff/');
    define('STUDENTS_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'students/');
    define('TASK_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'task/');
    define('BULLETIN_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'bulletin/');
    define('CURRICULUM_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'curriculum/');
    define('VIDEO_UPLOAD_PATH', DOC_ROOT.SUB_DOC_ROOT.IMAGE_ROOT.'video/');
    
    // PURPOSE: autoloader paths
    define('PROJECT_CLASSES', '../../../src/classes/');
    define('LOCAL_LIBRARY_CLASSES', '../../../libraries/local_packages/tamma/src/classes/');
    define('LOCAL_LIBRARY_CLASSES2', '../../../libraries/local_packages/tamma/src/classes/fileUploadOptions/');
    define('PROJECT_INTERFACES', '../../../src/interfaces/');
    define('LOCAL_LIBRARY_INTERFACES', '../../../libraries/local_packages/tamma/src/interfaces/');
    define('PROJECT_TRAITS', '../../../src/traits/');
    define('LOCAL_LIBRARY_TRAITS', '../../../libraries/local_packages/tamma/src/traits/');

    // PURPOSE: proivde support interaction via JSON raw data
    // if ( !empty(file_get_contents('php://input')) ) {
        
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         print "12321312";
    //         $_POST = json_decode(file_get_contents('php://input'), true);
    //     } else {
    //         $_GET = json_decode(file_get_contents('php://input'), true);
    //     }
    // } 
?>