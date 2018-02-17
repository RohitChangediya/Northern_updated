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
{    $sql="";
	 if($_POST['id']=='0')
	 {
	 	$sql = "SELECT sub_category.key_id, sub_category.key_sub_category_name FROM  main_category,sub_category where main_category.key_id =sub_category.key_main_category_id   and sub_category.key_active=1";
	 }
	 else
	 {
	$sql = "SELECT sub_category.key_id, sub_category.key_sub_category_name FROM  main_category,sub_category where main_category.key_id =sub_category.key_main_category_id and sub_category.key_main_category_id='".$_POST['id']."'   and sub_category.key_active=1";
		}
		$res = $obj->getRows($sql);
		
	$html="";
    $html.="<option value=''>---SELECT---</option>"; 
    foreach ($res as $row)
    {
		 $html.="<option value='".$row["key_id"]."'>".$row["key_sub_category_name"]."</option>";
        
    }
	        $status = true;
            $msg = $html;
			echo json_encode(array('status' => $status, 'msg' => $msg));
}
  if ( $_POST['action'] == "datatable") {
		
	$sql = " SELECT key_id,key_item_name,key_item_description,qty,prod_size,actual_price_india,actual_price_uae,discount,offer_india,offer_uae,availability_india,availability_uae FROM  item_detail";		
		
		$columns = array('key_id','key_item_name','key_item_description','qty','prod_size','actual_price_india','actual_price_uae','discount','offer_india','offer_uae','availability_india','availability_uae' );
		$isResult = $obj->generateDatatable($sql, $columns, 'key_id');		
		echo $isResult;
	}
	


if($_POST['action']=="save")
{ //print_r($_FILES);
	//print_r($_POST);
	if($_POST['prod_id']=="")
	{
		if(!($obj->checkExiststance2("item_detail","key_item_name",$_POST['product'])))
		{
	         $status = false;
             $msg = "Product is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		//$id=$obj->get_max("main_category","id");
			if(isset($_FILES))
			{   $columns="";
				$colname="";
				$param= array(
					
					'subcat'=>$_POST['subcategory'],
					'product' =>$_POST['product'],
					'description' => $_POST['description'],
					'key_active' =>$_POST['active']
				); 
				$totfiles=count($_FILES);
				for($k=1;$k<=$totfiles;$k++)
				{
				$folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
			   	{$folder="/catelog";}
				 $filename="http://".$_SERVER['SERVER_NAME'].$folder."/admin/uploads/".$_FILES['file'.$k]['name']; 
		         $destination="../uploads/".$_FILES['file'.$k]['name'];
		       
				if(move_uploaded_file($_FILES['file'.$k]['tmp_name'], $destination))
				{
	       		 $paramtemp=array('image'.$k=>$filename);
		        $columns.=':image'.$k.",";
		        $colname.='image'.$k.",";
		        $param=$param+$paramtemp;
		 	    }//move uploded files
		 		
			
		  }//end for loop
		        $paramtemp=array(
		        		'price_rupee'=>$_POST['price_rupee'],
		        		'price_uae'=>$_POST['price_uae'],
		        		'discount'=>$_POST['discount'],
		        		'qty'=>$_POST['qty'],
		        		'fabric'=>$_POST['fabric'],
		        		'available_india'=>$_POST['available_india'],
		        		'available_uae'=>$_POST['available_uae'],
		        		'prod_size'=>$_POST['prod_size'],
		        		'offer_rupee'=>$_POST['offer_rupee'],
		        		'offer_uae'=>$_POST['offer_uae']	        		
		        		
		        	);
		        $param=$param+$paramtemp;
		 // print_r($param);
		   $query="insert into item_detail(key_sub_category_id,key_item_name,key_item_description,active,".$colname."actual_price_india,actual_price_uae,discount,qty,fabric,availability_india,availability_uae,prod_size,offer_india,offer_uae) values(:subcat,:product,:description,:key_active,".$columns.":price_rupee,:price_uae,:discount,:qty,:fabric,:available_india,:available_uae,:prod_size,:offer_rupee,:offer_uae)";
		
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
	}
	else
	{
		if(isset($_FILES))
			{   $columns="";
			
				$param= array(
					'id'=> $_POST['prod_id'],
					'subcat'=>$_POST['subcategory'],
					'product' =>$_POST['product'],
					'description' => $_POST['description'],
					'key_active' =>$_POST['active']
				); 
				$totfiles=count($_FILES);
				for($k=1;$k<=$totfiles;$k++)
				{
				$folder="";
			   if($_SERVER['SERVER_NAME']=="localhost")
			   	{$folder="/catelog";}
				 $filename="http://".$_SERVER['SERVER_NAME'].$folder."/admin/uploads/".$_FILES['file'.$k]['name']; 
		         $destination="../uploads/".$_FILES['file'.$k]['name'];
		       
				if(move_uploaded_file($_FILES['file'.$k]['tmp_name'], $destination))
				{
	       		 $paramtemp=array('image'.$k=>$filename);
		        $columns.=',image'.$k.'=:image'.$k;
		      
		        $param=$param+$paramtemp;
		 	    }//move uploded files
		 		
			
		  }//end for loop
		        $paramtemp=array(
		        		'price_rupee'=>$_POST['price_rupee'],
		        		'price_uae'=>$_POST['price_uae'],
		        		'discount'=>$_POST['discount'],
		        		'qty'=>$_POST['qty'],
		        		'fabric'=>$_POST['fabric'],
		        		'available_india'=>$_POST['available_india'],
		        		'available_uae'=>$_POST['available_uae'],
		        		'prod_size'=>$_POST['prod_size'],
		        		'offer_rupee'=>$_POST['offer_rupee'],
		        		'offer_uae'=>$_POST['offer_uae']	        		
		        		
		        	);
		        $param=$param+$paramtemp;
		  //print_r($param);
		$query="update item_detail set key_sub_category_id=:subcat,key_item_name=:product,key_item_description=:description,active=:key_active,actual_price_india=:price_rupee,actual_price_uae=:price_uae,discount=:discount,qty=:qty,fabric=:fabric,availability_india=:available_india,availability_uae=:available_uae,prod_size=:prod_size,offer_india=:offer_rupee,offer_uae=:offer_uae".$columns." where key_id=:id";
		
			$inserted=$obj->update($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Updated";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
		 }
		
	}
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	

if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT * FROM  item_detail WHERE key_id={$id}";
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
       
       
        $post["key_sub_category_id"]  = $row["key_sub_category_id"];
		$post["product"]  = $row["key_item_name"];
		$post["key_item_description"]  = $row["key_item_description"];
		$post["active"]  = $row["active"];
		$post["image1"]  = $row["image1"];
		$post["image2"]  = $row["image2"];
		$post["image3"]  = $row["image3"];
		$post["image4"]  = $row["image4"];
		$post["image5"]  = $row["image5"];
		$post["image6"]  = $row["image6"];
		$post["image7"]  = $row["image7"];
		$post["image8"]  = $row["image8"];
		$post["image9"]  = $row["image9"];
		$post["image10"]  = $row["image10"];

		$post["actual_price_india"]  = $row["actual_price_india"];
		$post["actual_price_uae"]  = $row["actual_price_uae"];
		$post["discount"]  = $row["discount"];
		$post["qty"]  = $row["qty"];
		$post["fabric"]  = $row["fabric"];
		$post["availability_india"]  = $row["availability_india"];
		$post["availability_uae"]  = $row["availability_uae"];
		$post["prod_size"]  = $row["prod_size"];
		$post["offer_india"]  = $row["offer_india"];
		$post["offer_uae"]  = $row["offer_uae"];
       // $post["password"]  = md5($row["password"]);
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('item_detail', 'key_id', $id);
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