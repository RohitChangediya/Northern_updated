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
			'name'=>$post["name"]

		); 
		if($id==""){
    		$param['logo']="";
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
			
                        $image_filename="http://".$_SERVER['SERVER_NAME'].$folder."/clients/".$files['image']['name'];
		        $destination="../clients/". basename($files["image"]["name"]);
				if(move_uploaded_file($files['image']['tmp_name'], $destination))
				{
					$param['logo']=$image_filename;
				}
			}
			
		}
		return $param;
    }


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT id,name FROM tbl_clients where 1=1";		
		$columns = array('id', 'name');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
	}

	if(isset($_POST['action']) && $_POST['action']=="save")
	{ 
		if($_POST['id']=="")
		{
			if(!($obj->checkExiststance2("tbl_clients","name",$_POST['name'])))
			{
		         $status = false;
	             $msg = "This name is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				$id=$obj->get_max('tbl_clients','id');
				$query="insert into tbl_clients values(:id,:name,:logo)";
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
					$query1=",logo=:logo";
			$query="update tbl_clients set name=:name ".$query1." where id=:id";
			
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
		$sql = "SELECT * FROM  tbl_clients WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getcat") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT id,name FROM tbl_clients WHERE id={$id}";
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
		$isDeleted = $obj->delete('tbl_clients', 'id', $id);
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