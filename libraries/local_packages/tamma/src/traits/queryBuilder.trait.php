<?php 
error_reporting(0);
/**
 * *********************************************************************************************************
 * @_forProject: School-MaSS | Developed By: TAMMA CORPORATION
 * @_purpose: (dynamically build and execute Sequel queries. Makes moving to PREPARED STATEMENTS, PDO or another DB language easier) 
 * @_version Release: Phoenix
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

trait queryBuilder {
    // return/print var 
    protected $response;

    /**
     * @description:
     *  insert record(s) into TBL
     */
    protected function insertIntoTBL ( 
        $conn, 
        String $table, 
        Array $columnsList, 
        Array $valueList ) 
    {
        $columns = array();
        $values  = array();

        // unpack and arrange column names and field values 
        for ( $index=0; $index < count ( $columnsList ); $index++ ) {
            if ( $index == count ( $columnsList )-1 ) {
                $columns[] = '`'.$columnsList[$index].'`';
                $values[] = "'".$valueList[$index]."'";
            } else {
                $columns[] = '`'.$columnsList[$index].'`,';
                $values[] = "'".$valueList[$index]."',";
            }
        }
        // concat column and values into statement
        $insertQuery = "INSERT INTO ".$table." 
            (".implode(' ', $columns).") VALUES (".implode(' ', $values).")";

        if ( $conn->query( $insertQuery ) == false) {
            $this->response = array (
                'status'        => false,
                'message'       => 'Could not add new record',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $insertQuery,
                'info'          => $conn->error
            );
        } else {
            $this->response = array (
                'status'        => true,
                'message'       => 'data insertion successful',
                'total'         => $conn->affected_rows,
                'insert_id'     => $conn->insert_id,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $insertQuery,
                'info'          => ''
            );
        }
        return $this->response;
    }

    /**
     * @description:
     *  retrieve record(s) from TBL
     */
    protected function selectFromTBL ( 
        $conn, 
        Array  $scopeRange = null, 
        String $table, 
        Array  $condition = null, 
        Array  $sort = null ) 
    {
        $condition = implode('', $condition); // convert ["LEFT JOIN `ask_teacher`", "ON t1.column = t2.column"] to "Apple Pie Ginger Bread" 
        $condition = explode(" ", $condition); // breakup ["LEFT", "JOIN", "`ask_teacher`", "Bread", "ON", "t1.column", "=", "t2.column"]
        $join_existance = 0; //
        
        $WHERE = '';
        // query is meant to fetch data 
        // without conditionals.  
        if (count($condition) == 1) {
            $WHERE = '';
        } else {
            // probe conditionals for keyword: "JOIN"
            for ($i=0; $i < count($condition); $i++) { 
                // join exists
                if ($condition[$i] == "JOIN") {
                    $join_existance += 1;
                } else {
                    $join_existance  += 0;
                }
            }
            // 
            if ($join_existance == 0) {
                $WHERE = 'WHERE';
            } 
        }
        

        // 
        $scopeRange = ( count($scopeRange) > 0 ) ? implode('', $scopeRange) : '*' ;
        // 
        $selectQuery = " SELECT ".$scopeRange." FROM $table ". $WHERE .' '.implode(' ', $condition) .' '. implode(' ', $sort)." ";

        $query = $conn->query( $selectQuery );
        // 
        if ( $query == false ) {
            $this->response = array (
                'status'        => false,
                'message'       => 'Could not fetch record',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $selectQuery,
                'info'          => $conn->error
            );
        } else {
            $this->response = array (
                'status'        => true,
                'message'       => $query->num_rows .' record(s) were found',
                'total'         => $query->num_rows,
                'result'        => $query,
                'SQL_snapshot'  => $selectQuery,
                'info'          => ''
            );
        }
        return $this->response;
    }

    /**
     * @description:
     *  update record(s) in TBL
     */
    protected function updateTBL ( 
        $conn, 
        String $table, 
        Array $updateParam )
    {
        // 
        $updateQuery = "UPDATE " .$table. " SET ". implode(' ', $updateParam) ."";
        // 
        if ( $conn->query($updateQuery) == false ) {
            $this->response = array (
                'status'        => false,
                'message'       => 'Could not update record',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $updateQuery,
                'info'          => $conn->error
            );
        } else {
            $this->response = array (
                'status'        => true,
                'message'       => 'Update successfull',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $updateQuery,
                'info'          => ''
            );
        }
        return $this->response;
    }

    /**
     * @description:
     *  delete record(s) in TBL
     */
    protected function deleteRec( 
        $conn, 
        String $table, 
        Array $condition )
    {
        $delete = "DELETE FROM ". $table ." WHERE ". implode('', $condition);
        // 
        if ( $conn->query($delete) == false ) {
            $this->response = array (
                'status'        => false,
                'message'       => 'Could not delete record',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $delete,
                'info'          => $conn->error
            );
        } else {
            $this->response = array (
                'status'        => true,
                'message'       => 'record has been removed',
                'total'         => $conn->affected_rows,
                'result'        => 'Not Available',
                'SQL_snapshot'  => $delete,
                'info'          => ''
            );
        }
        return $this->response;
    }
}
/**
 * Implementations
 * 
 * NOTE: Please read the implementation section 
 * before proceeding 
 * 
 */


// # 1) INSERT STATEMENT - 
// $addUser = $this->insertIntoTBL ( 
//     database::$conn, /* $database_connection_object */
//     '', /* name of table eg: userTbl */ 
//     [/* column names. eg: 'id', 'userName', 'age' */], 
//     [/* column values. eg: '2', 'Monroe', '65' */] 
// );
// # success
// if ( $addUser['status'] == true ) { 
//     print "User Added"; 
// }
// # failed 
// else { 
//     print $addUser['info']; # access low Level Error 
// }


// #  2) SELECT STATEMENT
// # is optional 
// $scope = ['DISTINCT user_id'];
// # is optional
// $condition = [
//     'userName = "Monroe" ',
//     'County = "Grand Kru" '
// ];
// # is optional
// $sort = [
//     'ORDER BY id',
//     'LIMIT 40'
// ];
// # build query
// $SELECT = $this->selectFromTBL ( 
//     database::$conn, /* $database_connection_object */
//     [/* scope (is optional) eg: ( distinct user, name ) */], 
//     '', /* name of table eg: userTbl */ 
//     [/* condition (is optional. If using joins, include WHERE clause) eg: "`userName` = 'Monroe' AND/OR" , "`County` = 'Grand Kru'" ' ) */], 
//     [/* sort (is optional) eg: 'ORDER BY id', 'LIMIT 40' */]
// );  
// # success
// if ($SELECT['status'] == true) 
// { 
//      print $SELECT['message'] .'<br><br>';  # high level message - eg: 10 records found
//      print $SELECT['total'] .'<br><br>';    # rows count - eg: 10 
//      $result = $SELECT['result'] ;          # record object - eg: Array ( Coulmn => [4], userName => [10], Count => [10] ) 
    
//      # iterate through record object to extract data for use
//      $arr = [];
//      while ( $list = mysqli_fetch_assoc( $result ) ) {
//        $arr[] = $list; 
//      }

//      print_r($arr); # sample
//      # Or do more ...
// }
// else { 
//      print $SELECT['info'] .' <br><br>'; # access lowLevel Error 
//      # Or do more ...
// }



//  # 4) UPDATE STATEMENT
//  # is optional
// $condition = [
//     "user_id='231'",
//     "user_action='Just Testing' WHERE id=1"
// ];
// #
// $update = $this->updateTBL( 
//     database::$conn, /* $database_connection_object */
//     '', /* name of table eg: userTbl */ 
//     [/* condition: "user_id='231'", "user_action='Just Testing'", " WHERE id=1" */]
// );
// #
// if ( $update['status'] == false ) {
//     print $update['info']; #
// } else {
//     print $update['message']; #
// }


//  # 5) DELETE STATEMENT
//  # is optional
// $param = [
//     "user_id = '231'"
// ];
// #
// $update = $this->deleteRec( 
//     database::$conn, /* $database_connection_object */
//     '', /* name of table eg: userTbl */ 
//     [/* condition:  "user_id = '231'", "added_on = '2020' " */]
// );
// #
// if ( $update['status'] == false ) {
//     print $update['info']; #
// } else {
//     print $update['message']; #
// }




?>