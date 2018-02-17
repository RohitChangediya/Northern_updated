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
	

             $sql="Select  transports.trans_id,transports.transport,transport_destinations.destination,transport_destinations1.destination As destination1,transports.costing,transports.offcosting From  transports Inner Join  transport_destinations    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join transport_destinations transport_destinations1 On transports.dep_dest_id = transport_destinations1.dest_id where 1=1";	
		
		$columns = array('transports.trans_id', 'transports.transport','transport_destinations.destination','transport_destinations1.destination','transports.costing','transports.offcosting' );
		$isResult = $obj->generateDatatable($sql, $columns, 'trans_id');		
		echo $isResult;	  
		
	}
	
if($_POST['action']=="loaddest")
{
	$sql="select dest_id,destination from transport_destinations ";
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

	if($_POST['trans_id']=="")
	{
		
		  $id=$obj->get_max("transports","trans_id");
			
			 
	       		$query="insert into transports values(:id,:transport,:costing,:offcosting,:arrive_dest_id,:dep_dest_id,:description)";
		$param= array(
			'id' => $id,
			'transport' =>$_POST['transport'],
			'arrive_dest_id' =>$_POST['arrive_dest_id'],
			'dep_dest_id' =>$_POST['dep_dest_id'],
			'costing' =>$_POST['costing'],
			'offcosting'=>$_POST['offcosting'],
                        'description'=>$_POST['description']
			
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
	else
	{
		
					$query="update transports set transport=:transport,arrive_dest_id=:arrive_dest_id,dep_dest_id=:dep_dest_id,costing=:costing,offcosting=:offcosting,description=:description where trans_id=:id";
					$param= array(
					'id' => $_POST['trans_id'],
					'transport' =>$_POST['transport'],
					'arrive_dest_id' =>$_POST['arrive_dest_id'],
			'dep_dest_id' =>$_POST['dep_dest_id'],
					'costing' =>$_POST['costing'],
					'offcosting'=>$_POST['offcosting'],
                                        'description'=>$_POST['description']				
				
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
		$sql = "SELECT transports.trans_id, transports.transport,transports.arrive_dest_id,transports.dep_dest_id,transports.description,transports.costing,transports.offcosting FROM  transports WHERE trans_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["trans_id"]  = $row["trans_id"];
        $post["transport"]  = $row["transport"];
        $post["arrive_dest_id"] =$row["arrive_dest_id"];
		$post["dep_dest_id"] =$row["dep_dest_id"];
		$post["costing"]  = $row["costing"];
		$post["offcosting"]=$row["offcosting"];
	$post["description"]=$row["description"];
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('transports', 'trans_id', $id);
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