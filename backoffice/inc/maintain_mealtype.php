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
		
	    $sql = " SELECT mealtypes.meal_id, hotels.hotelname,mealtypes.mealtype,mealtypes.costing,mealtypes.offcosting FROM  mealtypes,hotels where mealtypes.hotel_id=hotels.hotel_id";		
		
		$columns = array('mealtypes.meal_id','hotels.hotelname','mealtypes.mealtype','mealtypes.costing',',mealtypes.offcosting' );
		$isResult = $obj->generateDatatable($sql, $columns, 'meal_id');		
		echo $isResult;	  
		
	}
	


if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['meal_id']=="")
	{
		if($obj->checkExiststanceWithAnd("mealtype","mealtypes",array("mealtype","hotel_id"),array($_POST['mealtype'],$_POST['hotel_id'])))			
		{
	         $status =false;
             $msg = "mealtype is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		  $id=$obj->get_max("mealtypes","meal_id");
			
			 
	       		$query="insert into mealtypes values(:id,:hotel_id,:mealtype,:costing,:offcosting)";
		$param= array(
			'id' => $id,
			'hotel_id'=>$_POST['hotel_id'],
			'mealtype' =>$_POST['mealtype'],
			'costing' =>$_POST['costing'],
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
		
					$query="update mealtypes set hotel_id=:hotel_id,mealtype=:mealtype,costing=:costing,offcosting=:offcosting where meal_id=:id";
					$param= array(
					'id' => $_POST['meal_id'],
					'hotel_id'=>$_POST['hotel_id'],
					'mealtype' =>$_POST['mealtype'],
					'costing' =>$_POST['costing'],
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
		$sql = "SELECT mealtypes.meal_id,mealtypes.hotel_id, mealtypes.mealtype,mealtypes.costing,mealtypes.offcosting FROM  mealtypes WHERE meal_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["meal_id"]  = $row["meal_id"];
        $post["hotel_id"]  = $row["hotel_id"];
        $post["mealtype"]  = $row["mealtype"];
		 $post["costing"]  = $row["costing"];
		 $post["offcosting"]=$row["offcosting"];
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('mealtypes', 'meal_id', $id);
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