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



if (isset($_REQUEST['action']) && $_REQUEST['action'] == "load") {
	
		$sql = "SELECT * FROM  item_detail";
		
		$res = $obj->getRows($sql);
		$response["success"] = 1;
        $response["message"] = "Items Available!";
        $response["posts"]   = array();
		
    
    foreach ($res as $row)
    {
        $post = array();
        $post["key_id"]  = $row["key_id"];
        $post["key_item_name"]  = $row["key_item_name"];
	
        array_push($response["posts"], $post);
    }
     echo json_encode($response);
		
	}
	

?>  