<?php
/*update our plugin ie inc.con.php
and insert this code top of the page
*/
/*if ( version_compare(phpversion(), '5.4.0', '>=') ) {
if (session_status() !== PHP_SESSION_ACTIVE) {
session_start();
echo "<script>alert('started in true block')</script>";
}
} else {
if (session_id() === '') {
echo "<script>alert('started in true block')</script>";
session_start();    
}
}
*/
/* Author: Mr. Sayyed Azhar A & Mr. Ansari Fuzail Ahmed Asrar Ahmed.
 * 
 * NOTE: To change this template, choose Tools | Templates
 *       and open the template in the editor.
 */
class db
{
    public $conn = null;
    function connect( )
    {
        if ( $this->conn == null ) {
            try {
                 /* LOCALHOST*/
                 
          $this->conn = new PDO( 'mysql:host=localhost;dbname=northern_travels', 'northern_travels', 'northern_travels' );
             
             
                $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }
            catch ( PDOException $e ) {
                echo $e->getMessage();
            }
        } //$this->conn == null
    }
    function disconnect( )
    {
        $this->conn = null;
    }
    public function get_max( $table, $col_name )
    {
        $max;
        $sql = "SELECT MAX($col_name) as max_" . $col_name . " FROM $table";
        $res = $this->getRows( $sql );
        $max = $res[ 0 ][ 'max_' . $col_name . '' ];
        $max = $max + 1;
        return (int) $max;
    }
    public function getRows( $sql, $param = array( ) )
    {
        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $param );
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        }
        catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }
      public function ListRecords( $sql)
    {
        try {
            $query = $this->conn->prepare( $sql );
            $query->execute();
            return $query->fetchAll( PDO::FETCH_ASSOC );
        }
        catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }
    public function vcode( $c_dt )
    {
        $vcode     = rand( 0000, 9999 );
        $eqdtt     = date( "d-M-Y" );
        $num       = "SELECT * from enquiry where enqdigit='$vcode' and  c_dt = '" . $c_dt . "'";
        $isChecked = $this->getRows( $num, $param = array( ) );
        if ( count( $isChecked ) > 0 ) {
            $this->vcode( $c_dt );
        } //count( $isChecked ) > 0
        else {
            return $vcode;
        }
    }
    public function insert( $sql, $param )
    {
        try {
            $stmt = $this->conn->prepare( $sql );
            return $stmt->execute( $param );
        }
        catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }
    public function update( $sql, $param )
    {
        return $this->insert( $sql, $param );
    }
    public function delete( $table, $col, $id )
    {
        $sql   = "DELETE FROM $table WHERE $col=?";
        $param = array(
             $id 
        );
        return $this->insert( $sql, $param );
    }
    public function delete_mul( $table, $col, $ids )
    {
        $sql= "DELETE FROM $table WHERE $col IN ($ids)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch( PDO::FETCH_ASSOC );
        }
        catch ( Exception $e ) {
            return false;
        }
    }
    public function delete1( $table, $col, $col1, $id, $id1 )
    {
        $sql   = "DELETE FROM $table WHERE $col=? and $col1=?";
        $param = array(
             $id,
            $id1 
        );
        return $this->insert( $sql, $param );
    }
    public function lastInsertedId( )
    {
        return $this->conn->lastInsertId();
    }
    
    //Get Information about any Perticular feild using this function 
    // @param1 - feild name which you want to retrive
    // @param2 - table from which you want to retrive
    // @param3 - coloumn of the table for condition
    // @param4 - id for condition
    // @return - perticular value
    public function getInfo( $feild, $table, $col, $id )
    {
        $sql   = "SELECT $feild FROM $table WHERE $col=?";
        $param = array(
             $id 
        );
        $stmt  = $this->conn->prepare( $sql );
        $stmt->execute( $param );
        $res = $stmt->fetch( PDO::FETCH_ASSOC );
        return $res[ $feild ];
    }
    //Get Information about any All using this function 
    // @param1 - table from which you want to retrive
    // @param2 - coloumn of the table for condition
    // @param3 - id for condition
    // @return - json encoded object
    public function getAllInfo( $table, $col, $id )
    {
        $sql   = "SELECT * FROM $table WHERE $col=?";
        $param = array(
             $id 
        );
        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $param );
            return $stmt->fetch( PDO::FETCH_ASSOC );
        }
        catch ( Exception $e ) {
            return false;
        }
    }
    //this function checks that the value exists in the table or not
    // @param1 - table from which you want to retrive
    // @param2 - coloumn of the table for condition
    // @param3 - id for condition
    // @return - true or false
    public function checkExiststance( $table, $coloumn, $id )
    {
        $id   = (float) $id;
        $sql  = "SELECT * FROM $table where $coloumn = $id";
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
        if ( !$stmt->fetch( PDO::FETCH_ASSOC ) ) {
            return true;
        } //!$stmt->fetch( PDO::FETCH_ASSOC )
        else {
            return false;
        }
    }
    public function checkExiststance2( $table, $coloumn, $id )
    {
        $sql  = "SELECT * FROM $table where $coloumn = '$id'";
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
        if ( !$stmt->fetch( PDO::FETCH_ASSOC ) ) {
            return true;
        } //!$stmt->fetch( PDO::FETCH_ASSOC )
        else {
            return false;
        }
    }
    public function checkExiststance3( $feild, $table, $coloumn, $id )
    {
        $sql  = "SELECT $feild FROM $table where $coloumn = '$id'";
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
        if ( !$stmt->fetch( PDO::FETCH_ASSOC ) ) {
            return true;
        } //!$stmt->fetch( PDO::FETCH_ASSOC )
        else {
            return false;
        }
    }
    public function checkExiststanceWithAnd( $feild, $table, $arrColoumns, $arrValues )
    {
        $sql = "SELECT $feild FROM $table WHERE";
        $i   = 1;
        foreach ( $arrColoumns as $key => $value ) {
            if ( $i == count( $arrColoumns ) ) {
                $sql .= " $value=? ";
            } //$i == count( $arrColoumns )
            else {
                $sql .= " $value=? AND ";
            }
            $i++;
        } //$arrColoumns as $key => $value
        $res = $this->getRows( $sql, $arrValues );
        if ( count( $res ) ) {
            return true;
        } //count( $res )
        else {
            return false;
        }
    }
    public function checkExiststanceWithOr( $feild, $table, $arrColoumns, $arrValues )
    {
        $sql = "SELECT $feild FROM $table WHERE";
        $i   = 1;
        foreach ( $arrColoumns as $key => $value ) {
            if ( $i == count( $arrColoumns ) ) {
                $sql .= " $value=? ";
            } //$i == count( $arrColoumns )
            else {
                $sql .= " $value=? OR ";
            }
            $i++;
        } //$arrColoumns as $key => $value
        $res = $this->getRows( $sql, $arrValues );
        if ( count( $res ) ) {
            return true;
        } //count( $res )
        else {
            return false;
        }
    }
    public function generateBarcode(){
        $bar;
        $sql   = "SELECT MAX(barcode) as barcode_no FROM model_stock_d";
        $res   = $this->getRows( $sql );
        $bar = $res[ 0 ][ 'barcode_no' ];
       // $bar = (int) substr( $bar, strripos( $bar, "-" ) + 1 );
        $bar = $bar + 1;
        if ( $bar == "" || $bar == null ) {
            $bar = 1;
        } //$bar == "" || $bar == null
        if ( $bar <= 9 ) {
            $bar = '1000' . $bar;
        } //$bar <= 9
        if ( $bar <= 99 && $bar >= 10 ) {
            $bar = '100' . $bar;
        } //$bar <= 99 && $bar >= 10
        if ( $bar <= 999 && $bar >= 100 ) {
            $bar = '10' . $bar;
        } //$bar <= 999 && $bar >= 100
       
        return $bar;
    }
    public function getInvoice( )
    {
        $invno;
        $sql   = "SELECT MAX(invoice_no) as invoice_no FROM customer_bill_operation";
        $res   = $this->getRows( $sql );
        $invno = $res[ 0 ][ 'invoice_no' ];
        $invno = (int) substr( $invno, strripos( $invno, "-" ) + 1 );
        $invno = $invno + 1;
        if ( $invno == "" || $invno == null ) {
            $invno = 1;
        } //$invno == "" || $invno == null
        if ( $invno <= 9 ) {
            $invno = 'INV-A-000' . $invno;
        } //$invno <= 9
        if ( $invno <= 99 && $invno >= 10 ) {
            $invno = 'INV-A-00' . $invno;
        } //$invno <= 99 && $invno >= 10
        if ( $invno <= 999 && $invno >= 100 ) {
            $invno = 'INV-A-0' . $invno;
        } //$invno <= 999 && $invno >= 100
        if ( $invno <= 9999 && $invno >= 1000 ) {
            $invno = 'INV-A-' . $invno;
        } //$invno <= 9999 && $invno >= 1000
        return $invno;
    }
    //this function generate the data tables 
    // @param1 - Array of database columns which should be read and sent back to DataTables.
    //@param2 - index_coloun for fast use
    // @return - json data table
    public function getDataTables( $table, $index_coloun, $columns )
    {
        $sql           = "SELECT `" . implode( "`, `", $columns ) . "` FROM $table WHERE 1=1";
        $totalData     = count( $this->getRows( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->getRows( $sql );
        $totalFiltered = count( $totalData2 );
        //order by and limit
        $sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  LIMIT " . $_REQUEST[ 'start' ] . " ," . $_REQUEST[ 'length' ];
        //execute query
        $totalData1 = $this->getRows( $sql );
        $data       = array( );
        foreach ( $totalData1 as $key => $value ) {
            foreach ( $value as $key => $value ) {
                $outputData[ ] = $value;
            } //$value as $key => $value
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getdatatable function 
    //this function generate the data tables by using query query sould contain where condition 
    //@param1 - query which you want
    // @param2 - Array of database columns which should be read and sent back to DataTables.
    // @return - json data table
    public function getDataTablesByQuery( $sql, $columns, $key = "" )
    {
        $totalData     = count( $this->getRows( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->getRows( $sql );
        $totalFiltered = count( $totalData2 );
        //order by and limit
        $sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  LIMIT " . $_REQUEST[ 'start' ] . " ," . $_REQUEST[ 'length' ];
        //execute query
        $totalData1 = $this->getRows( $sql );
        // echo "<pre>",print_r($totalData1),"</pre>";
        $data       = array( );
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            foreach ( $value as $key => $value ) {
                $outputData[ ] = $value;
            } //$value as $key => $value
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function
    //this function generate the data tables by using query query sould contain where condition 
    //@param1 - query which you want
    // @param2 - Array of database columns which should be read and sent back to DataTables.
    // @return - json data table
    public function getDataTablesByQueryAndBtns( $sql, $columns, $index_coloun = "" )
    {
        $totalData     = count( $this->_getResult( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->_getResult( $sql );
        $totalFiltered = count( $totalData2 );
        //order by and limit
        $sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  LIMIT " . $_REQUEST[ 'start' ] . " ," . $_REQUEST[ 'length' ];
        //execute query
        $totalData1 = $this->_getResult( $sql );
        $data       = array( );
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            foreach ( $value as $key1 => $value1 ) {
                if ( $value1 != $value[ $index_coloun ] ) {
                    $outputData[ ] = $value1;
                } //$value1 != $value[ $index_coloun ]
                else {
                    $outputData[ ] = $value1;
                }
            } //$value as $key1 => $value1
            $outputData[ ] = '<a href="javascript:;" class="btn btn-warning btn-xs edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '"><i class="fa fa-edit"></i> Edit</a>';
            $outputData[ ] = '<a href="javascript:;" class="btn btn-danger btn-xs delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '"><i class="fa fa-trash"></i> Delete</a>';
            $data[ ]       = $outputData;
        } //$totalData1 as $key => $value
        // echo "<h1>",$key,"</h1>";
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function


    /*************************************************************************
                                    IMPORTANT   
    ***************************************************************************/
    public function _getResult( $sql, $param = array( ) )
    {
        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $param );
            return $stmt->fetchAll( PDO::FETCH_ASSOC );
        }
        catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }

   
    //this function generate the data tables by using query query sould contain where condition 
    //@param1 - query which you want
    // @param2 - Array of database columns which should be read and sent back to DataTables.
    // @param3 - index_coloun/primary key of the table to show records
    // @param4 - Show serial no for every response. just pass 'show' in it 
    // @return - json data table
    public function error_datatable( $sql, $columns, $index_coloun = "", $btns = array( ), $srno = '' )
    {
        $totalData     = count( $this->getRows( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->getRows( $sql );
        $totalFiltered = count( $totalData2 );
        /*
         * Paging
         */
        $sLimit        = "";
        if ( isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1' ) {
            $sLimit = "LIMIT " . intval( $_REQUEST[ 'start' ] ) . ", " . intval( $_REQUEST[ 'length' ] );
        } //isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1'
        /*
         * Ordering
         */
        $sOrder = "";
        if ( isset( $_GET['order'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['order'] ) ; $i++ )
            {
                if ( $_GET[ 'order' ][ $i ] != "" )
                {
                    $sOrder .= $columns[ intval( $_REQUEST[ 'order' ][ $i ][ 'column' ]  ) ]." ".($_REQUEST[ 'order' ][ $i ][ 'dir' ] === 'asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
        /* $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                        ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }*/
     

        //order by and limit
        //$sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  $sLimit ";
        $sql .= "  $sOrder $sLimit ";
        //execute query
        $totalData1 = $this->getRows( $sql );
        $data       = array( );
        $sno        = 0;
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            if ( $srno == 'show' ) {
                $sno++;
                $outputData[ ] = $sno;
            } //$srno == 'show'
            foreach ( $value as $key1 => $value1 ) {
                if ( $value1 != $value[ $index_coloun ] ) {
                    $outputData[ ] = $value1;
                } //$value1 != $value[ $index_coloun ]
                else {
                    $outputData[ ] = $value1;
                }
            } //$value as $key1 => $value1
            $str     = '';
            $buttons = array( );
            if ( is_array( $btns ) ) {
                $check_session_passed = array_filter( $btns );
            } //is_array( $btns )
            else {
                $check_session_passed = array( );
            }
           

            //$check_session_passed = array_filter($btns);
            if ( !empty( $check_session_passed ) ) {
                    foreach ($btns as $key => $value) {
                        $attr = array(
                                    'class' => $key,
                                    'data-id' => $value[ $index_coloun ],
                                    'title' => $value[ $index_coloun ],
                                    'role' => 'button'
                                   );
                    
                        $buttons[ ] = $this->_anchor('', $value, $attr);
                    
                    // print_r($buttons);
                    // echo "\n<br/>";
                    $str           = implode( $buttons );
                    $outputData[ ] = $str;
                } //$btns as $key => $edv
            } //!empty( $check_session_passed )
            else {
                $outputData[ ] = '<a class="btn btn-xs btn-primary viewbtn" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-eye"></i></a> <a class="btn btn-xs btn-warning edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-pencil"></i></a> <a class="btn btn-xs btn-danger delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-remove"></i></a>';
            }
            // $outputData[] = $action_button;   
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        /* return $data;
        return $buttons;*/
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function
    







    //this function generate the data tables by using query query sould contain where condition 
    //@param1 - query which you want
    // @param2 - Array of database columns which should be read and sent back to DataTables.
    // @param3 - index_coloun/primary key of the table to show records
    // @param4 - Show serial no for every response. just pass 'show' in it 
    // @return - json data table
    public function generateDatatables( $sql, $columns, $index_coloun = "", $sess = array( ), $srno = '' )
    {
        $totalData     = count( $this->getRows( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->getRows( $sql );
        $totalFiltered = count( $totalData2 );
        /*
         * Paging
         */
        $sLimit        = "";
        if ( isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1' ) {
            $sLimit = "LIMIT " . intval( $_REQUEST[ 'start' ] ) . ", " . intval( $_REQUEST[ 'length' ] );
        } //isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1'
        /*
         * Ordering
         */
        $sOrder = "";
        if ( isset( $_GET['order'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['order'] ) ; $i++ )
            {
                if ( $_GET[ 'order' ][ $i ] != "" )
                {
                    $sOrder .= $columns[ intval( $_REQUEST[ 'order' ][ $i ][ 'column' ]  ) ]." ".($_REQUEST[ 'order' ][ $i ][ 'dir' ] === 'asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
        /* $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                        ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }*/
     

        //order by and limit
        //$sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  $sLimit ";
        $sql .= "  $sOrder $sLimit ";
        //execute query
        $totalData1 = $this->getRows( $sql );
        $data       = array( );
        $sno        = 0;
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            if ( $srno == 'show' ) {
                $sno++;
                $outputData[ ] = $sno;
            } //$srno == 'show'
            foreach ( $value as $key1 => $value1 ) {
                if ( $value1 != $value[ $index_coloun ] ) {
                    $outputData[ ] = $value1;
                } //$value1 != $value[ $index_coloun ]
                else {
                    $outputData[ ] = $value1;
                }
            } //$value as $key1 => $value1
            $str     = '';
            $buttons = array( );
            if ( is_array( $sess ) ) {
                $check_session_passed = array_filter( $sess );
            } //is_array( $sess )
            else {
                $check_session_passed = array( );
            }
            //$check_session_passed = array_filter($sess);
            if ( !empty( $check_session_passed ) ) {
                foreach ( $sess as $key => $edv ) {
                    /* extract($edv);*/
                    if ( isset( $edv[ 'view' ] ) && $edv[ 'view' ] != 0 ) {
                        $buttons[ ] = '<a class="btn btn-xs btn-primary viewbtn" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-eye"></i></a> ';
                        // echo "yes view";
                    } //isset( $edv[ 'view' ] ) && $edv[ 'view' ] != 0
                    if ( isset( $edv[ 'edit' ] ) && $edv[ 'edit' ] != 0 ) {
                        $buttons[ ] = '<a class="btn btn-xs btn-warning edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-pencil"></i></a> ';
                        // echo "yes edit";
                    } //isset( $edv[ 'edit' ] ) && $edv[ 'edit' ] != 0
                    if ( isset( $edv[ 'delete' ] ) && $edv[ 'delete' ] != 0 ) {
                        $buttons[ ] = ' <a class="btn btn-xs btn-danger delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-remove"></i></a>';
                        // echo "yes delete";
                    } //isset( $edv[ 'delete' ] ) && $edv[ 'delete' ] != 0
                    // print_r($buttons);
                    // echo "\n<br/>";
                    $str           = implode( $buttons );
                    $outputData[ ] = $str;
                } //$sess as $key => $edv
            } //!empty( $check_session_passed )
            else {
                $outputData[ ] = '<a class="btn btn-xs btn-primary viewbtn" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-eye"></i></a> <a class="btn btn-xs btn-warning edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-pencil"></i></a> <a class="btn btn-xs btn-danger delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-remove"></i></a>';
            }
            // $outputData[] = $action_button;   
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        /* return $data;
        return $buttons;*/
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function
    



    //this function generate the data tables by using query query sould contain where condition 
    //@param1 - query which you want
    // @param2 - Array of database columns which should be read and sent back to DataTables.
    // @return - json data table
    public function generateDatatable($sql, $columns, $index_column=""){
        $totalData = count($this->getRows($sql));
        $totalFiltered = $totalData; 


        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if (!empty($_REQUEST['search']['value'])) {
            $sql .= " AND (";
            for ($i=0; $i < count($columns); $i++) { 
                $sql .= " ".$columns[$i]." LIKE '%".$_REQUEST['search']['value']."%' ";
                if ($i != count($columns)-1) {
                     $sql .= " OR ";
                }else if($i == count($columns)-1){
                    $sql .= ')';
                }

            }
        }
        $totalData2 = $this->getRows($sql);
        $totalFiltered = count($totalData2); 
        /*
         * Paging
         */
        $sLimit        = "";
        if ( isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1' ) {
            $sLimit = " LIMIT " . intval( $_REQUEST[ 'start' ] ) . ", " . intval( $_REQUEST[ 'length' ] );
        } //isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1'
        /*
         * Ordering
         */
        $sOrder = "";
        if ( isset( $_GET['order'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['order'] ) ; $i++ )
            {
                if ( $_GET[ 'order' ][ $i ] != "" )
                {
                    $sOrder .= $columns[ intval( $_REQUEST[ 'order' ][ $i ][ 'column' ]  ) ]." ".($_REQUEST[ 'order' ][ $i ][ 'dir' ] === 'asc' ? 'asc' : 'desc') .", ";
                    echo $sOrder;
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
        
        $sql .= "  $sOrder $sLimit ";
       
        //execute query
        $totalData1 = $this->getRows($sql);
      /*
       echo $sql;
       print_r($totalData1);*/
        $data = array();
        foreach ($totalData1 as $key => $value) {
            $outputData = array();
            foreach ($value as $key1 => $value1) {
                    if ($value1 != $value[$index_column]) {
                       $outputData[] = $value1;
                    }else{
                       $outputData[] = $value1;                        
                    }
            }
            $outputData[] = '<a href="javascript:;" title="Edit('.$value[$index_column].')" class="btn btn-primary btn-xs edit" data-id="'.$value[$index_column].'"><i class="fa fa-edit"></i> Edit</a> <a href="javascript:;" title="Delete('.$value[$index_column].')" class="btn btn-danger btn-xs delete" data-id="'.$value[$index_column].'"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $outputData;
        }
       $json_response = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
       return json_encode($json_response);
    }//end getDataTablesByQuery function



    public function generatePayDatatable($sql, $columns, $index_column=""){
        $totalData = count($this->getRows($sql));
        $totalFiltered = $totalData; 


        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if (!empty($_REQUEST['search']['value'])) {
            $sql .= " AND (";
            for ($i=0; $i < count($columns); $i++) { 
                $sql .= " ".$columns[$i]." LIKE '%".$_REQUEST['search']['value']."%' ";
                if ($i != count($columns)-1) {
                     $sql .= " OR ";
                }else if($i == count($columns)-1){
                    $sql .= ')';
                }

            }
        }

        $totalData2 = $this->getRows($sql);
        $totalFiltered = count($totalData2); 
        /*
         * Paging
         */
        $sLimit        = "";
        if ( isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1' ) {
            $sLimit = " LIMIT " . intval( $_REQUEST[ 'start' ] ) . ", " . intval( $_REQUEST[ 'length' ] );
        } //isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1'
        /*
         * Ordering
         */
        $sOrder = "";
       
        
        $sql.= "  ORDER BY id DESC $sLimit ";
       
        //execute query
        $totalData1 = $this->getRows($sql);
      
        $data = array();
        foreach ($totalData1 as $key => $value) {
            $outputData = array();
            foreach ($value as $key1 => $value1) {
                    if ($value1 != $value[$index_column]) {
                       $outputData[] = $value1;
                    }else{
                       $outputData[] = $value1;                        
                    }
            }
            $outputData[] = '<a href="javascript:;" title="Edit('.$value[$index_column].')" class="btn btn-primary btn-xs edit" data-id="'.$value[$index_column].'"><i class="fa fa-edit"></i> Edit</a> <a href="javascript:;" title="Delete('.$value[$index_column].')" class="btn btn-danger btn-xs delete" data-id="'.$value[$index_column].'"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $outputData;
        }
       $json_response = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
       return json_encode($json_response);
    }//end getDataTablesByQuery function

    public function getDataTablesByQueryAndTwoBtns( $sql, $columns, $index_coloun)
    {
        $totalData     = count( $this->_getResult( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->_getResult( $sql );
        $totalFiltered = count( $totalData2 );
        //order by and limit
        $sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  LIMIT " . $_REQUEST[ 'start' ] . " ," . $_REQUEST[ 'length' ];
        
         /*
         * Paging
         */
        $sLimit        = "";
        if ( isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1' ) {
            $sLimit = "LIMIT " . intval( $_REQUEST[ 'start' ] ) . ", " . intval( $_REQUEST[ 'length' ] );
        } //isset( $_REQUEST[ 'start' ] ) && $_REQUEST[ 'length' ] != '-1'
        /*
         * Ordering
         */
        $sOrder = "";
        if ( isset( $_GET['order'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['order'] ) ; $i++ )
            {
                if ( $_GET[ 'order' ][ $i ] != "" )
                {
                    $sOrder .= $columns[ intval( $_REQUEST[ 'order' ][ $i ][ 'column' ]  ) ]." ".($_REQUEST[ 'order' ][ $i ][ 'dir' ] === 'asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
        /* $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) ) {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                        ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                }
            }             
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }*/
     

        //order by and limit
        //$sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  $sLimit ";
        $sql .= "  $sOrder $sLimit ";

        //execute query
        $totalData1 = $this->_getResult( $sql );
        $data       = array( );
        print_r($totalData1);
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            foreach ( $value as $key1 => $value1 ) {
                if ( $value1 != $value[ $index_coloun ] ) {
                    $outputData[ ] = $value1;
                } //$value1 != $value[ $index_coloun ]
                else {
                    $outputData[ ] = $value1;
                }
            } //$value as $key1 => $value1
            // $outputData[] = '<a href="javascript:;" class="btn btn-warning btn-xs edit" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'"><i class="fa fa-edit"></i> Edit</a>';
            // $outputData[] = '<a href="javascript:;" class="btn btn-danger btn-xs delete" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'"><i class="fa fa-trash"></i> Delete</a>';
            
            
            $outputData[] = '<a class="btn btn-xs btn-primary viewbtn" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'" href="#" role="button"> <i class="fa fa-eye"></i></a> <a class="btn btn-xs btn-warning edit" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'" href="#" role="button"> <i class="fa fa-pencil"></i></a> ';
            
            
            // $outputData[] = $action_button;   
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        // echo "<h1>",$key,"</h1>";
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function
    public function getDataTablesByQueryAndDelEditBtns( $sql, $columns, $index_coloun, $sess = array( ) )
    {
        $totalData     = count( $this->_getResult( $sql ) );
        $totalFiltered = $totalData;
        // if there is a search parameter, $requestData['search']['value'] contains search parameter
        if ( !empty( $_REQUEST[ 'search' ][ 'value' ] ) ) {
            $sql .= " AND (";
            for ( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= " " . $columns[ $i ] . " LIKE '%" . $_REQUEST[ 'search' ][ 'value' ] . "%'";
                if ( $i != count( $columns ) - 1 ) {
                    $sql .= " OR ";
                } //$i != count( $columns ) - 1
                else if ( $i == count( $columns ) - 1 ) {
                    $sql .= ')';
                } //$i == count( $columns ) - 1
            } //$i = 0; $i < count( $columns ); $i++
        } //!empty( $_REQUEST[ 'search' ][ 'value' ] )
        $totalData2    = $this->_getResult( $sql );
        $totalFiltered = count( $totalData2 );
        //order by and limit
        $sql .= " ORDER BY " . $columns[ $_REQUEST[ 'order' ][ 0 ][ 'column' ] ] . "   " . $_REQUEST[ 'order' ][ 0 ][ 'dir' ] . "  LIMIT " . $_REQUEST[ 'start' ] . " ," . $_REQUEST[ 'length' ];
        //execute query
        $totalData1 = $this->_getResult( $sql );
        $data       = array( );
        foreach ( $totalData1 as $key => $value ) {
            $outputData = array( );
            foreach ( $value as $key1 => $value1 ) {
                if ( $value1 != $value[ $index_coloun ] ) {
                    $outputData[ ] = $value1;
                } //$value1 != $value[ $index_coloun ]
                else {
                    $outputData[ ] = $value1;
                }
            } //$value as $key1 => $value1
            // $outputData[] = '<a href="javascript:;" class="btn btn-warning btn-xs edit" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'"><i class="fa fa-edit"></i> Edit</a>';
            // $outputData[] = '<a href="javascript:;" class="btn btn-danger btn-xs delete" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'"><i class="fa fa-trash"></i> Delete</a>';
            /*  $outputData[] = ' <a class="btn btn-xs btn-warning edit" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'" href="#" role="button"> <i class="fa fa-pencil"></i></a> <a class="btn btn-xs btn-danger delete" title="'.$value[$index_coloun].'" data-id="'.$value[$index_coloun].'" href="#" role="button"> <i class="fa fa-remove"></i></a>';
            
            $data[] = $outputData;*/
            $str                  = '';
            $buttons              = array( );
            $check_session_passed = array_filter( $sess );
            if ( !empty( $check_session_passed ) ) {
                foreach ( $sess as $key => $edv ) {
                    /* extract($edv);*/
                    if ( isset( $edv[ 'edit' ] ) && $edv[ 'edit' ] != 0 ) {
                        $buttons[ ] = '<a class="btn btn-xs btn-warning edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-pencil"></i></a> ';
                        // echo "yes edit";
                    } //isset( $edv[ 'edit' ] ) && $edv[ 'edit' ] != 0
                    if ( isset( $edv[ 'delete' ] ) && $edv[ 'delete' ] != 0 ) {
                        $buttons[ ] = ' <a class="btn btn-xs btn-danger delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-remove"></i></a>';
                        // echo "yes delete";
                    } //isset( $edv[ 'delete' ] ) && $edv[ 'delete' ] != 0
                    $str           = implode( $buttons );
                    $outputData[ ] = $str;
                } //$sess as $key => $edv
            } //!empty( $check_session_passed )
            else {
                $outputData[ ] = ' <a class="btn btn-xs btn-warning edit" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-pencil"></i></a> <a class="btn btn-xs btn-danger delete" title="' . $value[ $index_coloun ] . '" data-id="' . $value[ $index_coloun ] . '" href="#" role="button"> <i class="fa fa-remove"></i></a>';
            }
            // $outputData[] = $action_button;   
            $data[ ] = $outputData;
        } //$totalData1 as $key => $value
        // echo "<h1>",$key,"</h1>";
        $json_response = array(
             "draw" => intval( $_REQUEST[ 'draw' ] ),
            "recordsTotal" => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data" => $data 
        );
        return json_encode( $json_response );
    } //end getDataTablesByQuery function
    public function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
} // end class
?>