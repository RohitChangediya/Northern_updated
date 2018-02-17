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
		
	    $sql = " SELECT services.serv_id, services.service,services.costing,services.offcosting FROM  services where 1=1";		
		
		$columns = array('services.serv_id', 'services.service','services.costing','services.offcosting' );
		$isResult = $obj->generateDatatable($sql, $columns, 'serv_id');		
		echo $isResult;	  
		
	}
	


if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['serv_id']=="")
	{
		if(!($obj->checkExiststance2("services","service",$_POST['service'])))
		{
	         $status = false;
             $msg = "service is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		  $id=$obj->get_max("services","serv_id");
			
			 
	       		$query="insert into services values(:id,:service,:costing,:offcosting)";
		$param= array(
			'id' => $id,
			'service' =>$_POST['service'],
					'costing'=>$_POST['costing'],
					'offcosting'=>$_POST['offcosting']	
			
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
		
					$query="update services set service=:service,costing=:costing,offcosting=:offcosting where serv_id=:id";
					$param= array(
					'id' => $_POST['serv_id'],
					'service' =>$_POST['service'],
					'costing'=>$_POST['costing'],
					'offcosting'=>$_POST['offcosting']				
				
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
		$sql = "SELECT services.serv_id, services.service,services.costing,services.offcosting FROM  services WHERE serv_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["serv_id"]  = $row["serv_id"];
        $post["service"]  = $row["service"];
         $post["costing"]  = $row["costing"];
        $post["offcosting"]  = $row["offcosting"];
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('services', 'serv_id', $id);
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