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
			'name'=>$post["name"],
			'profession'=>$post['profession'],
			'description'=>$post['description']

		); 
		
		return $param;
    }


  if (isset($_POST['action']) && $_POST['action'] == "datatable") {
		
		$sql = " SELECT * FROM tbl_testimonials where 1=1";		
		$columns = array('id', 'name','profession','description');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
	}

	if(isset($_POST['action']) && $_POST['action']=="save")
	{ 
		if($_POST['id']=="")
		{
			if(!($obj->checkExiststance2("tbl_testimonials","name",$_POST['name'])))
			{
		         $status = false;
	             $msg = "This name is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				$id=$obj->get_max('tbl_testimonials','id');
				$query="insert into tbl_testimonials values(:id,:name,:profession,:description)";
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
			$query="update tbl_testimonials set name=:name,profession=:profession,description=:description where id=:id";
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
		$sql = "SELECT * FROM  tbl_testimonials WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getcat") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT id,name FROM tbl_testimonials WHERE id={$id}";
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
		$isDeleted = $obj->delete('tbl_testimonials', 'id', $id);
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