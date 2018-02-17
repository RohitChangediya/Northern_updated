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
function setParameters($post,$id="")
    {
    	$param= array(
			'id' =>$id,
			'tour_id'=>$post["tour_id"],
			'tag'=>$post["tag"],
			'description'=>$post["description"],
			'pax'=>$post["pax"],
			'april_sep'=>$post["april_sep"],
			'oct_march'=>$post["oct_march"]

		); 
		
		return $param;
    }


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT id,tbl_tour.tour_title as name,tag,pax,april_sep,oct_march FROM tour_details,tbl_tour where tbl_tour.tour_id=tour_details.tour_id";		
		$columns = array('id', 'name','tag','pax','april_sep','oct_march');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
	}

	if(isset($_POST['action']) && $_POST['action']=="save")
	{ 
		if($_POST['id']=="")
		{
			$sql = "Select  * From  tour_details Where tag=:tag and tour_id=:tour_id";
		         $param = array('tag'=> $_POST['tag'],'tour_id'=>["tour_id"]);
		         $res = $obj->getRows($sql,$param);
			if(count($res)>0)
			{
		         $status = false;
	             $msg = "This tag is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				$id=$obj->get_max('tour_details','id');
				$query="insert into tour_details values(:id,:tour_id,:tag,:description,:pax,:april_sep,:oct_march)";
				$param=setParameters($_POST,$id);
				
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
			
			$query="update tour_details set tour_id=:tour_id,tag=:tag,description=:description,pax=:pax,april_sep=:april_sep,oct_march=:oct_march where id=:id";
			
		 	$param=setParameters($_POST,$_POST['id']);
		 	$inserted=$obj->update($query,$param);
              
			if($inserted) {
				$status = true;
				$msg = "Successfully updated";
			} else {
				$status = false;
				$msg = "Something went wrong while updating the Record, please try again.";
			}
			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));		
	}	


	if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT * FROM  tour_details WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getcat") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT id,tag as name FROM tour_details where id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
	    foreach ($res as $row)
	    {
	        $status = true;
	        $msg = $row["name"];
			
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('tour_details', 'id', $id);
		if ($isDeleted) {
			$status = true;
			$msg = ' Record no.: '.$id.', Successfully Deleted!'; 
		} else {
			$status = false;
			$msg = 'Error, while Deleted Record no.: '.$id; 
		}
	 	echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	if (isset($_POST['action']) && $_POST['action'] == "listtours") {
		$obj = new db();
	    $obj->connect();
		$result=$obj->ListRecords("select tour_id as id,tour_title as title FROM tbl_tour");
		if(!empty($result))
			$status=true;
		else
			$status=false;
	 	echo json_encode(array('status' => $status, 'result' => $result));
	}
	
?>  