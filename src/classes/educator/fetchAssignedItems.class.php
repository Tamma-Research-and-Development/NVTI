<?php 
header('Content-Type: Application/json');
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
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
UserAccessControl::guardResource();
/**
* undocumented class
*
* @package default
* @author 
**/
final class fetchAssignedClasses extends teacherDetails
{
    use apiResponseManager;

    private $teacherData;
    private $phone_number;
    private $School_Teaching;
    private $classString;
    private $subjectString;
    private $classArray    = [];
    private $subjectArray  = [];

    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->teacherData      =  parent::teacherInfo();
            $this->phone_number     =  $this->teacherData[0]['Phone_number'];
            $this->School_Teaching  =  explode(';', $this->teacherData[0]['School_Teaching']);
            $this->classString      =  explode(';', $this->teacherData[0]['classes_taught']);
            $this->subjectString    =  explode(';', $this->teacherData[0]['subject']);
            
            
            for ($i=0; $i < count($this->classString)-1; $i++) { 
                $this->classArray[] = $this->classString[$i];
            }
            
            for ($i=0; $i < count($this->subjectString)-1; $i++) { 
                $this->subjectArray[] = $this->subjectString[$i];
            }

            $this->output(
                false, 400, 
                'Found '.(count($this->classString)-1).' classes and '.(count($this->subjectString)-1).' subjects assigned to you', 
                '', [
                    'school'   =>  $this->School_Teaching,
                    'classes'  =>  $this->classArray,
                    'subjects' =>  $this->subjectArray
                ]
            );

        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }
} // END class ClassName 
// 
$fetchAssignedClasses = new fetchAssignedClasses;
$fetchAssignedClasses->main();
?>