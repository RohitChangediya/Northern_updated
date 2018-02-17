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

if($_POST['action']=="load")
{
	$sql = "SELECT main_category.key_id, main_category.key_category_name FROM  main_category where key_active=1";
		
		$res = $obj->getRows($sql);
		
	$html="";
    $html.="<option value=''>---SELECT---</option>"; 
    foreach ($res as $row)
    {
		 $html.="<option value='".$row["key_id"]."'>".$row["key_category_name"]."</option>";
        
    }
	        $status = true;
            $msg = $html;
			echo json_encode(array('status' => $status, 'msg' => $msg));
}

  if ( $_POST['action'] == "datatable") {
		
	$sql = " SELECT sub_category.key_id, main_category.key_category_name, sub_category.key_sub_category_name FROM  main_category,sub_category where main_category.key_id=sub_category.key_main_category_id";		
		
		$columns = array('sub_category.key_id', 'main_category.key_category_name','sub_category.key_sub_category_name' );
		$isResult = $obj->generateDatatable($sql, $columns, 'key_id');		
		echo $isResult;	  
		/*$sql = "SELECT main_category.key_id, main_category.key_category_name, main_category.key_category_image FROM  main_category";
		
		$res = $obj->getRows($sql);
		
	$html="";
    
    foreach ($res as $row)
    {
        $html.= "<tr>";
		$html.="<td style='width: 7%;' class='text-center'>".$row["key_id"]."</td>";
		 $html.="<td>".$row["key_category_name"]."</td>";
          $html.="<td>".$row["key_category_image"]."</td>"; 
          
         $html.="<td>";
         $html.="<button class='btn btn-sm btn-primary btn-round' data-toggle='modal' data-target='#myModal' onclick='viewUser(".$row["key_id"].");'><i class='material-icons'>edit</i> Edit<div class='ripple-container'></div></button>";
          $html.="<button class='btn btn-sm btn-danger btn-round' onclick='delfunc(".$row["key_id"].")'><i class='material-icons'>delete</i> Delete<div class='ripple-container'></div></button>";
         $html.="</td>";
        $html.="</tr>";
    }
	        $status = true;
            $msg = $html;
			echo json_encode(array('status' => $status, 'msg' => $msg));*/
	}
	


if($_POST['action']=="save")
{
	//print_r($_POST);
	if($_POST['cat_id']=="")
	{
		if(!($obj->checkExiststance2("sub_category","key_sub_category_name",$_POST['subcategory'])))
		{
	         $status = false;
             $msg = "Sub-Category is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		//$id=$obj->get_max("main_category","id");
			
	      $query="insert into sub_category values(:key_id,:key_main_category_id,:key_sub_category_name,:key_active)";
		$param= array(
			'key_id' => '',
			'key_main_category_id' =>$_POST['category'],
			'key_sub_category_name' => $_POST['subcategory'],
			'key_active' =>$_POST['active']
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
		
					$query="update sub_category set key_main_category_id=:key_main_category_id,key_sub_category_name=:key_sub_category_name,key_active=:key_active where key_id=:id";
					$param= array(
					'id' => $_POST['cat_id'],
					'key_main_category_id' =>$_POST['category'],
					'key_sub_category_name' => $_POST['subcategory'],
			 	    'key_active' =>$_POST['active']
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
		$sql = "SELECT sub_category.key_id, sub_category.key_main_category_id, sub_category.key_sub_category_name,sub_category.key_active FROM  main_category,sub_category WHERE main_category.key_id=sub_category.key_main_category_id and sub_category.key_id={$id}";
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
        $post["key_id"]  = $row["key_id"];
        $post["key_main_category_id"]  = $row["key_main_category_id"];
        $post["key_sub_category_name"]  = $row["key_sub_category_name"];
		$post["key_active"]  = $row["key_active"];

       // $post["password"]  = md5($row["password"]);
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('sub_category', 'key_id', $id);
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