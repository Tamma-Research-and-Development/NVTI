<?php 
    // LOAD PROJECT CLASSES
    function load_Application_Essentials($sourceFile)
    {   
        $projectClassesDir          = scandir(PROJECT_CLASSES);
        $localPackageClassesDir     = scandir(LOCAL_LIBRARY_CLASSES);
        $projectInterfacesDir       = scandir(PROJECT_INTERFACES);
        $localPackageInterfacesDir  = scandir(LOCAL_LIBRARY_INTERFACES);
        $projectTraitsDir           = scandir(PROJECT_TRAITS);
        $localPackageTraitsDir      = scandir(LOCAL_LIBRARY_TRAITS);

        // LOAD PROJECT CLASSES
        for ($i=0; $i < count($projectClassesDir); $i++) { 
            if ( file_exists(PROJECT_CLASSES.$projectClassesDir[$i].'/'.$sourceFile.'.class.php') ) {
                include PROJECT_CLASSES.$projectClassesDir[$i].'/'.$sourceFile.'.class.php';
            } 
        }
        // LOAD LOCAL LIBRARY CLASSES
        for ($i=0; $i < count($localPackageClassesDir); $i++) { 
            if ( file_exists(LOCAL_LIBRARY_CLASSES.$localPackageClassesDir[$i].'/'.$sourceFile.'.class.php') ) {
                include LOCAL_LIBRARY_CLASSES.$localPackageClassesDir[$i].'/'.$sourceFile.'.class.php';
            } 
        }
        // LOAD PROJECT INTERFACES
        for ($i=0; $i < count($projectInterfacesDir); $i++) { 
            if ( file_exists(PROJECT_INTERFACES.$projectInterfacesDir[$i].'/'.$sourceFile.'.interface.php') ) {
                include PROJECT_INTERFACES.$projectInterfacesDir[$i].'/'.$sourceFile.'.interface.php';
            } 
        }
        // LOAD LOCAL LIBRARY INTERFACES
        for ($i=0; $i < count($localPackageInterfacesDir); $i++) { 
            if ( file_exists(LOCAL_LIBRARY_INTERFACES.$localPackageInterfacesDir[$i].'/'.$sourceFile.'.interface.php') ) {
                include LOCAL_LIBRARY_INTERFACES.$localPackageInterfacesDir[$i].'/'.$sourceFile.'.interface.php';
            } 
        }

        // LOAD PROJECT TRAITS
        for ($i=0; $i < count($projectTraitsDir); $i++) { 
            if ( file_exists(PROJECT_TRAITS.$projectTraitsDir[$i].'/'.$sourceFile.'.trait.php') ) {
                include PROJECT_TRAITS.$projectTraitsDir[$i].'/'.$sourceFile.'.trait.php';
            } 
        }
        // LOAD LOCAL LIBRARY TRAITS
        for ($i=0; $i < count($localPackageTraitsDir); $i++) { 
            if ( file_exists(LOCAL_LIBRARY_TRAITS.$localPackageTraitsDir[$i].'/'.$sourceFile.'.trait.php') ) {
                include LOCAL_LIBRARY_TRAITS.$localPackageTraitsDir[$i].'/'.$sourceFile.'.trait.php';
            } 
        }
    }
    // LOAD LOCAL LIBRARY CLASSES
    function load_Local_Library_Classes($sourceFile)
    {
        // if ( file_exists('../../../libraries/local_packages/tamma/src/classes/'.$sourceFile.'.class.php') ) {
        //     include '../../../libraries/local_packages/tamma/src/classes/'.$sourceFile.'.class.php';
        // } 
        if ( file_exists('../../../libraries/local_packages/tamma/src/classes/fileUploadOptions/'.$sourceFile.'.class.php') ) {
            include '../../../libraries/local_packages/tamma/src/classes/fileUploadOptions/'.$sourceFile.'.class.php';
        } 
    }

    spl_autoload_register("load_Application_Essentials");












// define('TEST_DIR', $_SERVER['DOCUMENT_ROOT'].'/www/schoolmass_eLearning/src/');
// $item = scandir($_SERVER['DOCUMENT_ROOT'].'/www/schoolmass_eLearning/src/');

// function recursion2($array, $subDir=null) {
//     $output = [];
//     for ($i=0; $i < count($array); $i++) { 
//         if ($array[$i] == "." || $array[$i] == "..") {
            
//         } else {
//             $prospectiveDir = $array[$i];

//             if (is_dir(TEST_DIR.$prospectiveDir)) {
//                 // print $array[$i];
//                 $comeback = recursion2(scandir(TEST_DIR.$prospectiveDir), $array[$i]);

//             } else {
//                 if ( is_dir(TEST_DIR.$subDir.'/'.$array[$i]) ) {
//                     $comeback = recursion2(scandir(TEST_DIR.$subDir.'/'.$array[$i]));
//                 } else {
//                     $output[] = TEST_DIR.$subDir.''.$array[$i];
//                 }
//             }
//         }
//     }

//     print_r( $output );
//     return $output;
// }

// $fileList = recursion2($item);



?>