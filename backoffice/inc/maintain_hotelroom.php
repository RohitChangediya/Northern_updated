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
	if($_SESSION['usertype']=="HOTEL")
          {
        $sql="select hotel_id,hotelname from hotels where hotel_id='".$_SESSION['uid']."'";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotel_id']."'>".$rec['hotelname']."</option>";  
	}
	}
        else
        {
          $sql="select hotel_id,hotelname from hotels ";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotel_id']."'>".$rec['hotelname']."</option>";  
	}
        }
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
  if ( $_POST['action'] == "datatable") {
		
	    $sql = "SELECT hotelroom.hotelroom_id, hotels.hotelname,hotelroom.roomtype,hotelroom.actype  FROM  hotelroom,hotels where hotelroom.hotel_id=hotels.hotel_id ";		
		
		$columns = array('hotelroom.hotelroom_id', 'hotels.hotelname','hotelroom.roomtype','hotelroom.actype' );
		$isResult = $obj->generateDatatable($sql, $columns, 'hotelroom_id');		
		echo $isResult;	  
		
	}
	


if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['hotelroom_id']=="")
	{//array("hotel_id"=>"hotel_id","roomtype"=>"roomtype")array("hotel_id"=>$_POST['hotelname'],"roomtype"=>$_POST['roomtype'])
		if(($obj->checkExiststanceWithAnd("hotel_id","hotelroom",array("hotel_id","roomtype","actype"),array($_POST['hotelname'],$_POST['roomtype'],$_POST['actype']))))
		{
	         $status = false;
             $msg = "Room type for this hotelname is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}
		else
		{
		  $id=$obj->get_max("hotelroom","hotelroom_id");
			
			 
	       		$query="insert into hotelroom values(:id,:hotelname,:roomtype,:actype,:noofrooms,:charge_ep,:charge_cp,:charge_map,:charge_ap,:extrabed_ep,:extrabed_cp,:extrabed_map,:extrabed_ap,:extraperson_ep,:extraperson_cp,:extraperson_map,:extraperson_ap,:extrachild_ep,:extrachild_cp,:extrachild_map,:extrachild_ap,:off_charge_ep,:off_charge_cp,:off_charge_map,:off_charge_ap,:off_extrabed_ep,:off_extrabed_cp,:off_extrabed_map,:off_extrabed_ap,:off_extraperson_ep,:off_extraperson_cp,:off_extraperson_map,:off_extraperson_ap,:off_extrachild_ep,:off_extrachild_cp,:off_extrachild_map,:off_extrachild_ap)";
		$param= array(
			'id' => $id,
			'hotelname' =>$_POST['hotelname'],
			'roomtype' =>$_POST['roomtype'],
			'actype' =>$_POST['actype'],
                        'noofrooms' =>$_POST['noofrooms'],			
			'charge_ep' =>$_POST['charge_ep'],
			'charge_cp' =>$_POST['charge_cp'],
			'charge_map' =>$_POST['charge_map'],
			'charge_ap' =>$_POST['charge_ap'],
                        'extrabed_ep' =>$_POST['extrabed_ep'],
			'extrabed_cp' =>$_POST['extrabed_cp'],
			'extrabed_map' =>$_POST['extrabed_map'],
			'extrabed_ap' =>$_POST['extrabed_ap'],
'extraperson_ep' =>$_POST['extraperson_ep'],
			'extraperson_cp' =>$_POST['extraperson_cp'],
			'extraperson_map' =>$_POST['extraperson_map'],
			'extraperson_ap' =>$_POST['extraperson_ap'],
                        'extrachild_ep' =>$_POST['extrachild_ep'],
			'extrachild_cp' =>$_POST['extrachild_cp'],
			'extrachild_map' =>$_POST['extrachild_map'],
			'extrachild_ap' =>$_POST['extrachild_ap'],
'off_charge_ep' =>$_POST['off_charge_ep'],
			'off_charge_cp' =>$_POST['off_charge_cp'],
			'off_charge_map' =>$_POST['off_charge_map'],
			'off_charge_ap' =>$_POST['off_charge_ap'],
                        'off_extrabed_ep' =>$_POST['off_extrabed_ep'],
			'off_extrabed_cp' =>$_POST['off_extrabed_cp'],
			'off_extrabed_map' =>$_POST['off_extrabed_map'],
			'off_extrabed_ap' =>$_POST['off_extrabed_ap'],
'off_extraperson_ep' =>$_POST['off_extraperson_ep'],
			'off_extraperson_cp' =>$_POST['off_extraperson_cp'],
			'off_extraperson_map' =>$_POST['off_extraperson_map'],
			'off_extraperson_ap' =>$_POST['off_extraperson_ap'],
                        'off_extrachild_ep' =>$_POST['off_extrachild_ep'],
			'off_extrachild_cp' =>$_POST['off_extrachild_cp'],
			'off_extrachild_map' =>$_POST['off_extrachild_map'],
			'off_extrachild_ap' =>$_POST['off_extrachild_ap']
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
		
					$query="update hotelroom set hotel_id=:hotelname,roomtype=:roomtype,actype=:actype,noofrooms=:noofrooms,charge_ep=:charge_ep,charge_cp=:charge_cp,charge_map=:charge_map,charge_ap=:charge_ap,extrabed_ep=:extrabed_ep,extrabed_cp=:extrabed_cp,extrabed_map=:extrabed_map,extrabed_ap=:extrabed_ap,extraperson_ep=:extraperson_ep,extraperson_cp=:extraperson_cp,extraperson_map=:extraperson_map,extraperson_ap=:extraperson_ap,extrachild_ep=:extrachild_ep,extrachild_cp=:extrachild_cp,extrachild_map=:extrachild_map,extrachild_ap=:extrachild_ap,off_charge_ep=:off_charge_ep,off_charge_cp=:off_charge_cp,off_charge_map=:off_charge_map,off_charge_ap=:off_charge_ap,off_extrabed_ep=:off_extrabed_ep,off_extrabed_cp=:off_extrabed_cp,off_extrabed_map=:off_extrabed_map,off_extrabed_ap=:off_extrabed_ap,off_extraperson_ep=:off_extraperson_ep,off_extraperson_cp=:off_extraperson_cp,off_extraperson_map=:off_extraperson_map,off_extraperson_ap=:off_extraperson_ap,off_extrachild_ep=:off_extrachild_ep,off_extrachild_cp=:off_extrachild_cp,off_extrachild_map=:off_extrachild_map,off_extrachild_ap=:off_extrachild_ap where hotelroom_id=:id";
					$param= array(
					'id' => $_POST['hotelroom_id'],
					'hotelname' =>$_POST['hotelname'],
			'roomtype' =>$_POST['roomtype'],
			'actype' =>$_POST['actype'],
                        'noofrooms' =>$_POST['noofrooms'],	
			'charge_ep' =>$_POST['charge_ep'],
			'charge_cp' =>$_POST['charge_cp'],
			'charge_map' =>$_POST['charge_map'],
			'charge_ap' =>$_POST['charge_ap'],
                        'extrabed_ep' =>$_POST['extrabed_ep'],
			'extrabed_cp' =>$_POST['extrabed_cp'],
			'extrabed_map' =>$_POST['extrabed_map'],
			'extrabed_ap' =>$_POST['extrabed_ap'],
'extraperson_ep' =>$_POST['extraperson_ep'],
			'extraperson_cp' =>$_POST['extraperson_cp'],
			'extraperson_map' =>$_POST['extraperson_map'],
			'extraperson_ap' =>$_POST['extraperson_ap'],
                        'extrachild_ep' =>$_POST['extrachild_ep'],
			'extrachild_cp' =>$_POST['extrachild_cp'],
			'extrachild_map' =>$_POST['extrachild_map'],
			'extrachild_ap' =>$_POST['extrachild_ap'],
'off_charge_ep' =>$_POST['off_charge_ep'],
			'off_charge_cp' =>$_POST['off_charge_cp'],
			'off_charge_map' =>$_POST['off_charge_map'],
			'off_charge_ap' =>$_POST['off_charge_ap'],
                        'off_extrabed_ep' =>$_POST['off_extrabed_ep'],
			'off_extrabed_cp' =>$_POST['off_extrabed_cp'],
			'off_extrabed_map' =>$_POST['off_extrabed_map'],
			'off_extrabed_ap' =>$_POST['off_extrabed_ap'],
'off_extraperson_ep' =>$_POST['off_extraperson_ep'],
			'off_extraperson_cp' =>$_POST['off_extraperson_cp'],
			'off_extraperson_map' =>$_POST['off_extraperson_map'],
			'off_extraperson_ap' =>$_POST['off_extraperson_ap'],
                        'off_extrachild_ep' =>$_POST['off_extrachild_ep'],
			'off_extrachild_cp' =>$_POST['off_extrachild_cp'],
			'off_extrachild_map' =>$_POST['off_extrachild_map'],
			'off_extrachild_ap' =>$_POST['off_extrachild_ap']
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
		$sql = "SELECT *  FROM  hotelroom WHERE hotelroom_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["hotelroom_id"]  = $row["hotelroom_id"];
        $post["hotel_id"]  = $row["hotel_id"];
		 $post["roomtype"]  = $row["roomtype"];
		 $post["actype"]  = $row["actype"];
                  $post["noofrooms"]  = $row["noofrooms"];
		 $post["charge_ep"]  = $row["charge_ep"];
		 $post["charge_cp"]  = $row["charge_cp"];
		 $post["charge_map"]  = $row["charge_map"];
	     $post["charge_ap"]  = $row["charge_ap"];
	      $post["extrabed_ep"]  = $row["extrabed_ep"];
		 $post["extrabed_cp"]  = $row["extrabed_cp"];
		 $post["extrabed_map"]  = $row["extrabed_map"];
	     $post["extrabed_ap"]  = $row["extrabed_ap"];

 $post["extraperson_ep"]  = $row["extraperson_ep"];
		 $post["extraperson_cp"]  = $row["extraperson_cp"];
		 $post["extraperson_map"]  = $row["extraperson_map"];
	     $post["extraperson_ap"]  = $row["extraperson_ap"];
	      $post["extrachild_ep"]  = $row["extrachild_ep"];
		 $post["extrachild_cp"]  = $row["extrachild_cp"];
		 $post["extrachild_map"]  = $row["extrachild_map"];
	     $post["extrachild_ap"]  = $row["extrachild_ap"];

 $post["off_charge_ep"]  = $row["off_charge_ep"];
		 $post["off_charge_cp"]  = $row["off_charge_cp"];
		 $post["off_charge_map"]  = $row["off_charge_map"];
	     $post["off_charge_ap"]  = $row["off_charge_ap"];
	      $post["off_extrabed_ep"]  = $row["off_extrabed_ep"];
		 $post["off_extrabed_cp"]  = $row["off_extrabed_cp"];
		 $post["off_extrabed_map"]  = $row["off_extrabed_map"];
	     $post["off_extrabed_ap"]  = $row["off_extrabed_ap"];

 $post["off_extraperson_ep"]  = $row["off_extraperson_ep"];
		 $post["off_extraperson_cp"]  = $row["off_extraperson_cp"];
		 $post["off_extraperson_map"]  = $row["off_extraperson_map"];
	     $post["off_extraperson_ap"]  = $row["off_extraperson_ap"];
	      $post["off_extrachild_ep"]  = $row["off_extrachild_ep"];
		 $post["off_extrachild_cp"]  = $row["off_extrachild_cp"];
		 $post["off_extrachild_map"]  = $row["off_extrachild_map"];
	     $post["off_extrachild_ap"]  = $row["off_extrachild_ap"];
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('hotelroom', 'hotelroom_id', $id);
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