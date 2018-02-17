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
		
	    $sql = " SELECT tourdestination.tour_id, destinations.destination,tourdestination.arrival_dest,tourdestination.departure_dest FROM  tourdestination,destinations where tourdestination.dest_id=destinations.dest_id";		
		
		$columns = array('tourdestination.tour_id','destinations.destination','tourdestination.arrival_dest','tourdestination.departure_dest' );
		$isResult = $obj->generateDatatable($sql, $columns, 'tour_id');		
		echo $isResult;	  
		
	}
	
if($_POST['action']=="loaddest")
{
	$sql="select dest_id,destination from destinations ";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['dest_id']."'>".$rec['destination']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}

if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['tour_id']=="")
	{
		if($obj->checkExiststanceWithAnd("tour_id","tourdestination",array("dest_id","arrival_dest","departure_dest"),array($_POST['dest_id'],$_POST['arrivalid'],$_POST['departure'])))			
		{
	         $status =false;
             $msg = "Tour details is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		  $id=$obj->get_max("tourdestination","tour_id");
			
			 
	       		$query="insert into tourdestination values(:tour_id,:dest_id,:arrival_dest,:departure_dest)";
		$param= array(
			'tour_id' => $id,
			'dest_id'=>$_POST['dest_id'],
			'arrival_dest' =>$_POST['arrivalid'],
			'departure_dest' =>$_POST['departure']
			
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
		
					$query="update tourdestination set dest_id=:dest_id,arrival_dest=:arrival_dest,departure_dest=:departure_dest where tour_id=:tour_id";
					$param= array(
					'tour_id' => $_POST['tour_id'],					
					'dest_id'=>$_POST['dest_id'],
					'arrival_dest' =>$_POST['arrivalid'],
					'departure_dest' =>$_POST['departure']	
				
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
		$sql = "SELECT * FROM  tourdestination WHERE tour_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["tour_id"]  = $row["tour_id"];
        $post["dest_id"]  = $row["dest_id"];
		 $post["arrival_dest"]  = $row["arrival_dest"];
		 $post["departure_dest"]=$row["departure_dest"];
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('tourdestination', 'tour_id', $id);
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