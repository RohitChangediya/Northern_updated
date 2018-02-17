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
			'tour_id' =>$id,
			'tour_category'=>$post["tour_category"],
			'tour_title'=>$post['tour_title'],
			'tour_destination'=>$post['tour_destination'],
			'tour_duration'=>$post['tour_duration'],
			'tour_price'=>$post['tour_price'],
			'tour_description'=>$post['tour_description'],
                        'tour_longitude'=>$post['tour_longitude'],
                        'tour_latitude'=>$post['tour_latitude']

		); 
		
		return $param;
    }


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT tour_id,tour_category ,tour_title,tour_destination,tour_duration,tour_price FROM tbl_tour where 1=1";		
		$columns = array('tour_id','tour_category' ,'tour_title','tour_destination','tour_duration','tour_price');
		$isResult = $obj->generateDatatable($sql, $columns, 'tour_id');		
		echo $isResult;	  
	}

	if(isset($_POST['action']) && $_POST['action']=="save")
	{ 
		if($_POST['tour_id']=="")
		{
			if(!($obj->checkExiststance2("tbl_tour","tour_title",$_POST['tour_title'])))
			{
		         $status = false;
	             $msg = "This tour is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				$id=$obj->get_max('tbl_tour','tour_id');
				$query="insert into tbl_tour values(:tour_id,:tour_category,:tour_title,:tour_destination,:tour_duration,:tour_price,:tour_description,:tour_longitude,:tour_latitude)";
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
			$query="update tbl_tour set tour_category=:tour_category,tour_title=:tour_title,tour_destination=:tour_destination,tour_duration=:tour_duration,tour_price=:tour_price,tour_description=:tour_description,tour_longitude=:tour_longitude,tour_latitude=:tour_latitude where tour_id=:tour_id";
		 	$param=setParameters($_POST,$_POST['tour_id']);
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
		$sql = "SELECT * FROM  tbl_tour WHERE tour_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getcat") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT tour_id,tour_title FROM tbl_tour WHERE tour_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
	    foreach ($res as $row)
	    {
	        $status = true;
	        $msg = $row["tour_title"];
			
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('tbl_tour', 'tour_id', $id);
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