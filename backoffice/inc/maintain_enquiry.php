<?php  
session_start();
require 'inc.con.php';
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


  if ( $_POST['action'] == "datatable") {
		
	$sql = " SELECT * FROM  enquiries where readflag='1'";		
		
		$columns = array('enquiries.enq_id', 'enquiries.name','enquiries.phone','enquiries.email', 'enquiries.enquiry_details','enquiries.addedon' );
		$isResult = $obj->generateDatatable($sql, $columns, 'enq_id');		
		echo $isResult;	  
		
	}
	 if ( $_POST['action'] == "newdatatable") {
		
	   $sql = "SELECT * FROM  enquiries where readflag='0'";		
		
		$columns = array('enquiries.enq_id', 'enquiries.name','enquiries.phone','enquiries.email', 'enquiries.enquiry_details','enquiries.addedon'  );
		$isResult = $obj->generateDatatable($sql, $columns, 'enq_id');		
		echo $isResult;	  

		  
		
	}
	 if ( $_POST['action'] == "change") {
	 $query="update enquiries set readflag=1";		
		   $inserted=$obj->update($query);
  }




?>  