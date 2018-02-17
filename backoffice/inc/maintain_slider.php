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
		
	$sql = " SELECT promo_picture.key_id, promo_picture.key_file_name  FROM  promo_picture";		
		
		$columns = array('promo_picture.key_id', 'promo_picture.key_file_name');
		$isResult = $obj->generateDatatable($sql, $columns, 'key_id');		
		echo $isResult;	  
		}


if($_POST['action']=="save")
{ // print_r($_FILES);
	//print_r($_POST);
	if($_POST['key_id']=="")
	{
		
	
		//$id=$obj->get_max("main_category","id");
			if(isset($_FILES))
			{   $folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
				{$folder="/catelog";}
				$filename="http://".$_SERVER['SERVER_NAME'].$folder."/admin/uploads/".$_FILES['file']['name'];
		         $destination="../uploads/".$_FILES['file']['name'];
		         if(!($obj->checkExiststance2("promo_picture","key_file_name",$filename)))
				{
	       				 		 $status = false;
            			  		 $msg = "Image is already exists....!";
							     echo json_encode(array('status' => $status, 'msg' => $msg));
							     return;
				}
				if(move_uploaded_file($_FILES['file']['tmp_name'], $destination))
				{
	       		$query="insert into promo_picture values(:id,:key_file_name)";
			$param= array(
			'id' => '',
			'key_file_name' => $filename
			); 
				$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
		  }//move uploded files
		  else
		  {
		  	    $status = false;
				$msg = "Something went wrong while Uploading image, please try again.";
		  }
		 }
	   
	}
	else
	{
		if($_POST['file']!="undefined")
			{ 
				 $folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
				{$folder="/catelog";}
				$filename="http://".$_SERVER['SERVER_NAME'].$folder."/admin/uploads/".$_FILES['file']['name'];
		         $destination="../uploads/".$_FILES['file']['name'];
				if(move_uploaded_file($_FILES['file']['tmp_name'], $destination))
				{
					$query="update promo_picture set key_file_name=:key_file_name where key_id=:id";
						$param= array(
			'id' => $_POST['key_id'],
			'key_file_name' => $filename
			); 
					$inserted=$obj->update($query,$param);

					if($inserted) {
						$status = true;
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}
				}
				else
		 		 {
		  	   		$status = false;
					$msg = "Something went wrong while Uploading image, please try again.";
		  		}

			}
			
		 
	}
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	

if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT promo_picture.key_id, promo_picture.key_file_name FROM  promo_picture WHERE key_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		/*$send_data = array();
		foreach ($res as $key => $value) {
 			$send_data[] = array_map('filterOut',$value);
		}*/
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["key_id"]  = $row["key_id"];
        $post["key_file_name"]  = $row["key_file_name"];
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('promo_picture', 'key_id', $id);
		if ($isDeleted) {
			$status = true;
			$msg = ' Record no.: '.$id.', Successfully Deleted!'; 
		} else {
			$status = false;
			$msg = 'Error, while Deleted Record no.: '.$id; 
		}
	 echo json_encode(array('status' => $status, 'msg' => $msg));
	}

?>  