<?php 
/**
 * *********************************************************************************************************
 * @_forProject: School-MaSS | Developed By: TAMMA CORPORATION
 * @_purpose: (handles users input and output) 
 * @_version Release: package_two
 * @_created Date: 11/9/2019
 * @_author(s):
 *   1) Mr. Michael kaiva Nimley. (Hercules)
 *      @contact Phone: (+231) 777-007-009
 *      @contact Mail: michaelkaivanimley.com@gmail.com, mnimley6@gmail.com, mnimley@tammacorp.com
 *   --------------------------------------------------------------------------------------------------
 *   2) Fullname of engineer. (Code Name)
 *      @contact Phone: (+231) 000-000-000
 *      @contact Mail: -----@tammacorp.com
 * *********************************************************************************************************
 */
trait io_stream
{
    // filter provided data for DB acceptance aswell as for use
    // in the user-agent viewport
    public function input($Data, $type, $isArray=null) {
        if ($isArray == IS_ARRAY) {
            $individually_filtered_inputs = [];
            for ($i=0; $i < count($Data); $i++) { 
                $keys = array_keys($Data);
	            $individually_filtered_inputs[$keys[$i]] = self::filterInputedData($Data[$keys[$i]], $type);
            }
            return $individually_filtered_inputs;
        } else {
            return self::filterInputedData($Data, $type);
        }
    } 


    private function filterInputedData($Data, $type)
    {
        $Data = rtrim($Data); 
        $Data = ltrim($Data); 

        // stictly filter data for DB use
        if ($type === STRICT_INPUT_FILTER)  {
            $Data = addslashes($Data); 
            $Data = strip_tags($Data); 
        } 
        // lightly filter data for DB use
        else if ($type === INPUT_FILTER)  {
            $Data = addslashes($Data); 
            $Data = htmlspecialchars($Data); 
        } 
        // filter data for SCREEN use
        else if ($type === OUTPUT_FILTER) {
            $Data = stripslashes($Data); 
            $Data = html_entity_decode($Data); 
        } 
        
        return $Data;
    }

    // ensure provided email adheres to standard
    // @param: array/string
    protected function validateEmail($email) {
        // handle bulk email list
        if (is_array($email)) {
            // extract each email in list
            for ($i=0; $i < count($email); $i++) { 
                // validate against established format standard
                $results = filter_var($email[$i], FILTER_VALIDATE_EMAIL);
                // email failed validation
                if (empty($results)) {
                    // show error
                    print $error = "The Email: ". $email[$i] .", Does Not Adhere To Standard Format";
                    Log::failedAttempt(CURRENT_LOCATION, $error); // log error 
                    die(); // hault program execution
                } else {
                    $results = FALSE;
                }
            }
        }
        // handle single email 
        else {
            // validate against established format standard
            $results = filter_var($email, FILTER_VALIDATE_EMAIL);
            // email failed validation
            if (empty($results)) {
                // show error
                print $error = "The Email: ". $email .", Does Not Adhere To Standard Format";
                Log::failedAttempt(CURRENT_LOCATION, $error); // log error
                die(); // hault program execution
            } else {
                $results = FALSE;
            }
        }
        return $results;
    }

    // generate a random number <10 digits long
    protected function genRandomNumber($length, $M, $D) {
        $random = "";
        for ($i=0;  $i < $length; $i++) { 
            $spinner = $random.=mt_rand($M,$D); $token = $spinner; 
        }
        return $token;	
    }

}

/**
 * ******************************************************************************************************************************
 * @implementation guide for methods in io_stream
 * @includes: ready to use example(s)
 * ******************************************************************************************************************************
 */

// @ input method 
// $var = $this->input("<h1>Dog's Soldiers</h1>", STRICT_INPUT_FILTER); // thoroughly sanitize input
// $var = $this->input("<h1>Dog's Soldiers</h1>", INPUT_FILTER); // render tags unexecutable  
// $var = $this->input("&lt;h1&gt;Dog\'s Soldiers&lt;/h1&gt;", OUTPUT_FILTER); // convert nutralized tags to executables 
// $var = $this->input("&lt;h1&gt;Dog\'s Soldiers&lt;/h1&gt;", OUTPUT_FILTER, IS_NULL); // is_null flags empty 

// @ validateEmail method
// $emailAddress = "sinfo@schoolmass.net"; // use string for a single email address
// $emailAddress = array("sinfo@schoolmass.net", "jd.com@lr"); // use array for multiple email addresses
// $var = io_stream::validateEmail($emailAddress); // evaluates email and returns errors to variable

// @ genRandomNumber method
// $var = io_stream::genRandomNumber(6, 30, 100); // 6(length of number), 30(start range), 100(end range)


?>