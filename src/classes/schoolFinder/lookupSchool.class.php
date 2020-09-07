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
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
/**
* undocumented class
*
* @package default
* @author 
**/
final class lookupSchools
{
    use apiResponseManager, queryBuilder, io_stream;

    private $search_phrase;
    private $school_lookup_query;
    private $school_list_array;
    private $params = [
        "(schoolName)"
    ];

    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            if (empty($_GET['schoolName'])) {
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', 
                    []
                );
            }
            else {
                $this->search_phrase = $this->input($_GET['schoolName'], STRICT_INPUT_FILTER);

                $this->school_lookup_query = $this->selectFromTBL ( 
                    database::$conn, [], 
                    'ministry_prefered_school_list',
                    [" `School_Name`  LIKE '%$this->search_phrase%' "], 
                    [" ORDER BY `School_Name` ASC "]
                ); 
                
                if ($this->school_lookup_query['status'] == false) {
                    $this->output(
                        false, 500, 
                        'School lookup failed', 
                        $this->school_lookup_query['info'], 
                        []
                    );
                } else {
                    if ($this->school_lookup_query['total'] > 0) {

                        $this->school_list_array = [];

                        while ($row = $this->school_lookup_query['result']->fetch_assoc()) {
                            $this->school_list_array[] = [
                                'School_Name'   =>  ltrim(rtrim($row["School_Name"])),
                                'Location'      =>  $row["Specific_Location"],
                                'School_Type'   =>  $row["School_Type"],
                                'School_Level'  =>  (empty($row["School_Level"])) ? 'unknown' : $row["School_Level"]
                            ];
                        }
                        
                        $this->output(
                            true, 200, 
                            $this->school_lookup_query['total'].' school(s) found', 
                            $this->school_lookup_query['info'], 
                            [$this->school_list_array]
                        );

                    } else {
                        $this->output(
                            false, 404, 
                            $this->search_phrase. ' returned 0 results', 
                            $this->school_lookup_query['info'], 
                            []
                        );
                    }
                }
            } 
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: GET', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', 
                []
            );
        }
    }
} // END class ClassName 
// 
$lookupSchools = new lookupSchools;
$lookupSchools->main();
?>