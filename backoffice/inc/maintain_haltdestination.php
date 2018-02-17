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
		
	    $sql = " SELECT haltdestinations.dest_id, haltdestinations.destination FROM  haltdestinations where 1=1";		
		
		$columns = array('haltdestinations.dest_id', 'haltdestinations.destination' );
		$isResult = $obj->generateDatatable($sql, $columns, 'dest_id');		
		echo $isResult;	  
		
	}
	


if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['dest_id']=="")
	{
		if(!($obj->checkExiststance2("haltdestinations","destination",$_POST['destination'])))
		{
	         $status = false;
             $msg = "destination is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		  $id=$obj->get_max("haltdestinations","dest_id");
			
			 
	       		$query="insert into haltdestinations values(:id,:destination)";
		$param= array(
			'id' => $id,
			'destination' =>$_POST['destination']
			
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		
	  }
	 }
	}
	else
	{
		
					$query="update haltdestinations set destination=:destination where dest_id=:id";
					$param= array(
					'id' => $_POST['dest_id'],
					'destination' =>$_POST['destination']				
				
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
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	

if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT haltdestinations.dest_id, haltdestinations.destination FROM  haltdestinations WHERE dest_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["dest_id"]  = $row["dest_id"];
        $post["destination"]  = $row["destination"];
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('haltdestinations', 'dest_id', $id);
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