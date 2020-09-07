<?php 
header('Content-Type: Application/json');
    /**
     * *********************************************************************************************************
     * @_forProject:  Application | Developed By: TAMMA CORPORATION
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
    trait gradesManager
    {
        
        public function save_Grade(
            $student_user_name,
            $testTaker, $class, 
            $subject, $score, 
            $school, $teachersPhone
        ) {
            
            $redundancy_checker = self::redundant_grade_entry_handler( $student_user_name, $testTaker, $school, $class, $subject );
            
            if ($redundancy_checker['status'] == false) {
                return $redundancy_checker;
            } else {
                
                $input_Grade_Query = database::$conn->query(" INSERT INTO 
                    `certificate` (`owner`, `class`, `subject`, `score`, `school`, `teacherPhone`, `student_user_name` ) 
                    VALUES ('$testTaker', '$class', '$subject', '$score', '$school', '$teachersPhone', '$student_user_name') 
                ");
                
                if ($input_Grade_Query == false) {
                    return [
                        'status' => false,
                        'status_code' => 500,
                        'body' => [
                            'message'  => 'Grades input failed',
                            'error_info' => database::$conn->error,
                            'dataset' => 'Not Available'
                        ]
                    ];
                } else {
                    if ($score > 69) {
                        return [
                            'status' => true,
                            'status_code' => 200,
                            'body' => [
                                'message' => 'Congratulations, '. $testTaker .'!',
                                'error_info' => database::$conn->error,
                                'dataset' => 'Not Available'
                            ]
                        ];
                    } else {
                        return [
                            'status' => true,
                            'status_code' => 200,
                            'body' => [
                                'message' => 'Sorry '.$testTaker.', you score is below the pass mark of 70',
                                'error_info' => database::$conn->error,
                                'dataset' => 'Not Available'
                            ]
                        ];
                    }
                }
            }
        }

        private function redundant_grade_entry_handler(
            $student_user_name,
            $testTaker,
            $school,
            $class,
            $subject
        ) {
            $redundant_handler_query = database::$conn->query(" SELECT * FROM `certificate` 
                WHERE `student_user_name` = '$student_user_name'
                AND `owner` = '$testTaker'
                AND `school` = '$school'
                AND `class` = '$class'
                AND `subject` = '$subject'
            ");
            
            if ($redundant_handler_query == false) {
                return [
                    'status' => false,
                    'status_code' => 500,
                    'body' => [
                        'message'  => 'Sorry, unable to complete action',
                        'error_info' => database::$conn->error,
                        'dataset' => 'Not Available'
                    ]
                ];
            } else {
                if ($redundant_handler_query->num_rows > 0) {
                    return [
                        'status' => false,
                        'status_code' => 501,
                        'body' => [
                            'message'  => 'Sorry '.$testTaker.', you have already taken and passed this exercise',
                            'error_info' => database::$conn->error,
                            'dataset' => 'Not Available'
                        ]
                    ];
                } else {
                    return [
                        'status' => true,
                        'status_code' => 200,
                        'body' => [
                            'message'  => 'proceed',
                            'error_info' => database::$conn->error,
                            'dataset' => 'Not Available'
                        ]
                    ];
                }
            }
        }
    } // END class ClassName 
?>