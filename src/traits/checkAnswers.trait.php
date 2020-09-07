<?php 
  /**
   * *********************************************************************************************************
   * @_forProject: | Developed By: TAMMA CORPORATION
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
  trait checkAnswers
  {
    
    public function correctAnswers(
        $testTaker, $class, 
        $subject,  $school, 
        $teachersPhone
    ) {
        // parameters
        $questions            =  $_POST['questions']; // Array
        $userSelectedOptions  =  $_POST['userSelectedOptions']; // Array
        // validate answers
        $score   =   self::validateAnswers($questions, $userSelectedOptions, $class);
        $review  =   self::generateTestReview($questions, $userSelectedOptions, $class);
        // 
        return [
            'score'        =>  $score[0], // total points achieved
            'points'       =>  $score[1], // points per question
            'test_summary' =>  $review    // summary of test with correct answers
        ];
    }

    //
    private function validateAnswers(
        Array $questions,
        Array $userSelectedOptions, 
        String $class
    ) {
        
        for ($i=0; $i < count($questions); $i++) { 
            $question  = $questions[$i];
            $answer     = $userSelectedOptions[$i];
            
            $answer_validation_query  = database::$conn->query(
                "SELECT * FROM `exercise2` WHERE `test_question` = '$question' 
                AND `CorrectAnswer` = '$answer' AND `intendedClass` = '$class' 
            ");

            // wrong answer
            if ($answer_validation_query->num_rows < 1) {
                $points[] = 0;
            }
            // correct answer 
            else {
                $points[] = 100 / count($questions);
            }
        }
        
        return [
            array_sum($points), 
            $points
        ];
    }

    //    
    private function generateTestReview(
        Array $questions, 
        Array $userSelectedOptions,
        String $class
    ) {
        
        $test_review = [];
        
        for ($i=0; $i < count($questions); $i++) { 
            $q  = $questions[$i];
            
            $test_review_query  = database::$conn->query(
                "SELECT * FROM `exercise2` WHERE `test_question` = '$q' 
                AND `intendedClass` = '$class'  
            ");
            
            while ( $row = $test_review_query->fetch_assoc() ) {
                $test_review[] = [
                    'question'        => $q,
                    'student_answer'  => $userSelectedOptions[$i],
                    'correct_answer'  => $row['CorrectAnswer'],
                    'status' => ($userSelectedOptions[$i] == $row['CorrectAnswer']) ? 'correct' : 'wrong'
                ];
            } 
        }
        return $test_review;
    }
  } // END class ClassName 
?>