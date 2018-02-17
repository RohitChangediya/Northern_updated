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
function setParameters($post,$files,$id="")
    {
    	$param= array(
			'id' =>$id,
			'tour_id'=>$post["tour_id"],
			'day'=>$post["day"],
			'title'=>$post["title"],
			'description'=>$post["description"]

		); 
		if($id==""){
    		$param['img_path']="";
		}
		if(!empty($files))
		{   
			$folder="";
		    if($_SERVER['SERVER_NAME']=="localhost")
			{
				$folder="/travel/admin";
			}
			else{
				$folder="/admin";
			}
			if(isset($files['image']))
			{
			
                        $image_filename="http://".$_SERVER['SERVER_NAME'].$folder."/itinerary/".$files['image']['name'];
		        $destination="../itinerary/". basename($files["image"]["name"]);
				if(move_uploaded_file($files['image']['tmp_name'], $destination))
				{
					$param['img_path']=$image_filename;
				}
			}
			
		}
		return $param;
    }


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT id,tbl_tour.tour_title as name,day,title FROM tour_itinerary,tbl_tour where tbl_tour.tour_id=tour_itinerary.tour_id";		
		$columns = array('id', 'name','day','title');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
	}

	if(isset($_POST['action']) && $_POST['action']=="save")
	{ 
		if($_POST['id']=="")
		{

                         $sql = "Select  * From  tour_itinerary Where day=:day and tour_id=:tour_id";
		         $param = array('day'=> $_POST['day'],'tour_id'=>["tour_id"]);
		         $res = $obj->getRows($sql,$param);
			if(count($res)>0)
			{
		         $status = false;
	             $msg = "This day is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				$id=$obj->get_max('tour_itinerary','id');
				$query="insert into tour_itinerary values(:id,:tour_id,:day,:img_path,:title,:description)";
				$param=setParameters($_POST,$_FILES,$id);
				
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
			$query1="";
			if(isset($_FILES['image']))
					$query1=",img_path=:img_path";
			$query="update tour_itinerary set tour_id=:tour_id,day=:day,title=:title,description=:description ".$query1." where id=:id";
			
		 	$param=setParameters($_POST,$_FILES,$_POST['id']);
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
		$sql = "SELECT * FROM  tour_itinerary WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getcat") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT id,day as name FROM tour_itinerary where id={$id}";
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
		$isDeleted = $obj->delete('tour_itinerary', 'id', $id);
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