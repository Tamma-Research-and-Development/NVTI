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
require '../../../configuration/app.ini.php';
require '../../../autoload/autoload.inc.php';
UserAccessControl::guardResource();
/**
* undocumented class
*
* @package default
* @author 
**/
final class DeleteBulletinItem extends teacherDetails
{
    use apiResponseManager, io_stream, queryBuilder;

    private $recordID;
    private $removeBulletinItemQuery;
    private $teacherData;

    private $params = [
        '(recordID)'
    ];
    
    public function main()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ( empty($_POST['recordID']) ) { 
                $this->output(
                    false, 400, 
                    'Set: '.implode(',', $this->params).'', 
                    'Bad Request', []
                );
            }
            else {
                $this->recordID     =  $this->input($_POST["recordID"], STRICT_INPUT_FILTER);
                $this->teacherData  =  parent::teacherInfo();

                if ( $this->teacherData[0]['accountType'] == 'admin' ) {
                    
                    $this->removeBulletinItemQuery = $this->deleteRec( 
                        database::$conn, 'bulletin', ["bulletin_id = $this->recordID"]
                    );

                    if ( $this->removeBulletinItemQuery['status'] == false ) {
                        $this->output(
                            false, 500, 
                            'Sorry, Bulletin Item Removal failed', 
                            $this->removeBulletinItemQuery['info'], 
                            []
                        );
                    } else {
                        if ($this->removeBulletinItemQuery['total'] > 0) {
                            $this->output(
                                true, 200, 
                                '1 Bulletin Item Removed', 
                                $this->removeBulletinItemQuery['info'], 
                                []
                            ); 
                        } else {
                            $this->output(
                                false, 501, 
                                'Bulletin Item Not Removed. ('.$this->recordID.') is an unknown record id', 
                                $this->removeBulletinItemQuery['info'], 
                                []
                            );
                        }
                    }

                } else {
                    $this->output(
                        false, 403, 
                        'Sorry, Only (admins) are allowed to remove post from the school bulletin', 
                        'Forbidden', []
                    );
                }
            }
        
        } else {
            $this->output(
                false, 405, 
                'Accepted HTTP Method: POST', 
                'Method: ['.$_SERVER['REQUEST_METHOD'].'] Not Allowed', []
            );
        }
    }

} // END class ClassName 
// 
$DeleteBulletinItem = new DeleteBulletinItem;
$DeleteBulletinItem->main();
?>