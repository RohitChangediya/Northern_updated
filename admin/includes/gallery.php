<?php  
session_start();
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
			'image_title'=>$post["image_title"],
			'image_description'=>$post['image_description']
		); 
    	if($id==""){
    		$param['image_path']="";
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
			
                        $image_filename="http://".$_SERVER['SERVER_NAME'].$folder."/gallery/".$files['image']['name'];
		        $destination="../gallery/". basename($files["image"]["name"]);
				if(move_uploaded_file($files['image']['tmp_name'], $destination))
				{
					$param['image_path']=$image_filename;
				}
			}
		}
		return $param;
    }
  if ( $_POST['action'] == "list") {
		$sql = "SELECT * FROM  gallery WHERE 1";
		$res = $obj->ListRecords($sql);
    	echo json_encode($res);
    	return;
	}

	if($_POST['action']=="save")
	{ 
		if($_POST['id']=="")
		{
			if(!($obj->checkExiststance2("gallery","image_title",$_POST['image_title'])))
			{
		         $status = false;
	             $msg = "Image is already exists....!";
				 echo json_encode(array('status' => $status, 'msg' => $msg));
				 return;
			}
			else
			{
				
				$query="insert into gallery values(:id,:image_title,:image_path,:image_description)";
    			$param=setParameters($_POST,$_FILES);
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
			$query="update gallery set image_title=:image_title";
			if(isset($_FILES['image']))
					$query.=",image_path=:image_path";
			$query.=",image_description=:image_description where id=:id";
		 	$param=setParameters($_POST,$_FILES,$_POST['id']);
		 	//$param['id' ]=$_POST['author_id'];
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
		$sql = "SELECT * FROM  gallery WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
    	echo json_encode($res[0]);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "getimage") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT id,image_title FROM gallery WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
	    foreach ($res as $row)
	    {
	        $status = true;
	        $msg = $row["image_title"];
			
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg));
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('gallery', 'id', $id);
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