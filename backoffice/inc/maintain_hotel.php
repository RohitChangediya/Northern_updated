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
		
	    $sql = " SELECT hotels.hotel_id, hotels.hotelname,hotels.hoteltype,haltdestinations.destination,hotels.contact,hotels.email,hotels.address,hotels.status FROM  hotels,haltdestinations where haltdestinations.dest_id=hotels.halt_id";		
		
		$columns = array('hotels.hotel_id', 'hotels.hotelname','hotels.hoteltype','haltdestinations.destination','hotels.contact','hotels.email','hotels.address','hotels.status' );
		$isResult = $obj->generateDatatable($sql, $columns, 'hotel_id');		
		echo $isResult;	  
		
	}
	
if($_POST['action']=="loadhalt")
{
	$sql="select dest_id,destination from haltdestinations";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['dest_id']."'>".$rec['destination']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}

if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['hotel_id']=="")
	{
		if(!($obj->checkExiststance2("hotels","hotelname",$_POST['hotelname'])))
		{
	         $status = false;
                 $msg = "hotelname is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
                if(!($obj->checkExiststance2("hotels","username",$_POST['username'])))
		{
	                 $status = false;
                         $msg = "Username is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		
		  $id=$obj->get_max("hotels","hotel_id");
			
			 
	       		$query="insert into hotels values(:id,:hotelname,:halt_id,:hoteltype,:contact,:email,:address,:username,:password,:status)";
		$param= array(
			'id' => $id,
			'hotelname' =>$_POST['hotelname'],
                        'halt_id' =>$_POST['halt_id'],
			'hoteltype' =>$_POST['hoteltype'],
			'contact' =>$_POST['contact'],
			'email' =>$_POST['email'],
			'address' =>$_POST['address'],
                        'username' =>$_POST['username'],
                        'password' =>$_POST['password'],
			'status' =>$_POST['status']
			
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
	else
	{
		if($obj->getInfo("hotelname","hotels","hotel_id",$_POST['hotel_id'])!=$_POST['hotelname'])
                    {  if(!($obj->checkExiststance2("hotels","hotelname",$_POST['hotelname'])))
		     {
	                      $status = false;
                              $msg = "hotelname is already exists....!";
			      echo json_encode(array('status' => $status, 'msg' => $msg));
			      return;
		     }
                 }   
                   if($obj->getInfo("username","hotels","hotel_id",$_POST['hotel_id'])!=$_POST['username'])
                    {
                         if(!($obj->checkExiststance2("hotels","username",$_POST['username'])))
		             {
	                         $status = false;
                                 $msg = "Username is already exists....!";
			         echo json_encode(array('status' => $status, 'msg' => $msg));
			         return;
			     } 
		   }
					$query="update hotels set hotelname=:hotelname,halt_id=:halt_id,hoteltype=:hoteltype,contact=:contact,email=:email,address=:address,username=:username,password=:password,status=:status where hotel_id=:id";
					$param= array(
					'id' => $_POST['hotel_id'],
					'hotelname' =>$_POST['hotelname'],
                               'halt_id' =>$_POST['halt_id'],
			'hoteltype' =>$_POST['hoteltype'],
			'contact' =>$_POST['contact'],
			'email' =>$_POST['email'],
			'address' =>$_POST['address'],
                         'username' =>$_POST['username'],
                        'password' =>$_POST['password'],
			'status' =>$_POST['status']	
				
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
		$sql = "SELECT hotels.hotel_id, hotels.hotelname,hotels.halt_id,hotels.hoteltype,hotels.contact,hotels.email,hotels.address,hotels.username,hotels.password,hotels.status  FROM  hotels WHERE hotel_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["hotel_id"]  = $row["hotel_id"];
        $post["halt_id"]  = $row["halt_id"];
            $post["hotelname"]  = $row["hotelname"];
		 $post["hoteltype"]  = $row["hoteltype"];
		 $post["contact"]  = $row["contact"];
		 $post["email"]  = $row["email"];
		 $post["address"]  = $row["address"];
                  $post["username"]  = $row["username"];
                   $post["password"]  = $row["password"];
		 $post["status"]  = $row["status"];
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('hotels', 'hotel_id', $id);
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