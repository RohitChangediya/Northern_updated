<?php  
session_start();
if($_POST['from']=="index")
	require 'inc/inc.con.php';
else
	require '../../inc/inc.con.php';
$obj = new db();
$obj->connect();
function filterIn($str)
	{
		return addslashes(htmlspecialchars($str));		
	}
function filterOut($str)
	{
		return stripslashes(htmlspecialchars_decode($str));		
	}


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT id,transdate,txnid,amount,firstname,email,phone FROM tbl_online_payments where 1=1";		
		$columns = array('id','transdate','txnid','amount','firstname','email','phone');
		$isResult = $obj->generatePayDatatable($sql, $columns, 'id');		
		echo $isResult;	  
	}

	
	
?>  