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
		
	$sql = " SELECT banner.id, banner.filepath  FROM  banner where 1=1";		
		
		$columns = array('banner.id', 'banner.filepath');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
		}


if($_POST['action']=="save")
{ // print_r($_FILES);
	//print_r($_POST);
	if($_POST['id']=="")
	{
		
	
		     $id=$obj->get_max("banner","id");
			if(isset($_FILES))
			{   $folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
				{$folder="/catelog";}
				 $filename="http://".$_SERVER['SERVER_NAME'].$folder."/ads/".$_FILES['file']['name'];
		         $destination="../ads/".$_FILES['file']['name'];
		         if(!($obj->checkExiststance2("banner","filepath",$filename)))
				{
	       				 		 $status = false;
            			  		 $msg = "Image is already exists....!";
							     echo json_encode(array('status' => $status, 'msg' => $msg));
							     return;
				}
				if(move_uploaded_file($_FILES['file']['tmp_name'], $destination))
				{
	       		$query="insert into banner values(:id,:filepath)";
			$param= array(
			'id' => $id,
			'filepath' => $filename
			); 
				$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
		  }//move uploded files
		  else
		  {
		  	    $status = false;
				$msg = "Something went wrong while Uploading image, please try again.";
		  }
		 }
	   
	}
	else
	{
		if($_POST['file']!="undefined")
			{ 
				 $folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
				{$folder="/catelog";}
				 $filename="http://".$_SERVER['SERVER_NAME'].$folder."/ads/".$_FILES['file']['name'];
		         $destination="../ads/".$_FILES['file']['name'];
				if(move_uploaded_file($_FILES['file']['tmp_name'], $destination))
				{
					$query="update banner set filepath=:filepath where id=:id";
						$param= array(
			'id' => $_POST['id'],
			'filepath' => $filename
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
				else
		 		 {
		  	   		$status = false;
					$msg = "Something went wrong while Uploading image, please try again.";
		  		}

			}
			
		 
	}
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	
if($_POST['action'] == "Image")
	{$sql = "SELECT banner.id, banner.filepath FROM  banner";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
                  $i=1;
                foreach ($res as $row) {
		    $path=$row['filepath'];
		 	
		 		if($i==1)
		 	{
		 		
		 	echo " <img src='".$path."' style='width:100%;height:400px;'  id='myimg' >";
			echo "<input type='hidden' class='gal active' value='".$path."'>";
			}
			else
			{
				echo "<input type='hidden' class='gal' value='".$path."'>";
			}
			settype($i, 'int');
			$i++;
		 }

	}	
if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT banner.id, banner.filepath FROM  banner WHERE id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		/*$send_data = array();
		foreach ($res as $key => $value) {
 			$send_data[] = array_map('filterOut',$value);
		}*/
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["filepath"]  = $row["filepath"];
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('banner', 'id', $id);
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