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

function convert_number_to_words($number=NULL){
if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		
		$Ln = floor($number / 100000);
		/* Lakh (Lakh) */
		$number -= $Ln * 100000;
		
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= convert_number_to_words($Gn) .  "Million";
		}
		if ($Ln) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($Ln) . " Lakh";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
 
}
if($_POST['action']=="loaddescription")
{
	 $sql="select transports.description From
  transport_destinations Inner Join
  transports
    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join
  transport_destinations transport_destinations1
    On transports.dep_dest_id = transport_destinations1.dest_id  where transports.transport='".$_POST['trans_id']."' and transport_destinations.destination='".$_POST['pickup']."' and transport_destinations1.destination='".$_POST['drop']."'";
	$row=$obj->getRows($sql);
	
	 $msg="";
	 
	
	foreach($row as $rec)//foreach loop  
	{        $status = true;
		 $msg = $rec['description'];  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loadhotel")
{
	$sql="select hotel_id,hotelname from hotels where hoteltype='".$_POST['id']."' and halt_id='".$_POST['halt_id']."'";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotel_id']."'>".$rec['hotelname']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loaddest")
{
	$sql="select dest_id,destination from destinations ";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['dest_id']."'>".$rec['destination']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
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
if($_POST['action']=="loadtransdest")
{
	$sql="select dest_id,arrival_dest,departure_dest from tourdestination where dest_id='".$_POST['id']."'";
	$row=$obj->getRows($sql);
	
	 $msg1="";
	  $msg1 .="<option value=''>---Select---</option>";  
	  $msg2="";
	  $msg2 .="<option value=''>---Select---</option>"; 
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg1 .="<option value='".$rec['arrival_dest']."'>".$rec['arrival_dest']."</option>";  
		 $msg2 .="<option value='".$rec['departure_dest']."'>".$rec['departure_dest']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg1' => $msg1,'msg2' => $msg2));
}
if (isset($_POST['action']) && $_POST['action'] == "transpickupdrop") {
		extract(array_map("filterIn", $_POST));
		 $sql = "Select
  transport_destinations.destination as pickup,
  transport_destinations1.destination As droploc
From
  transport_destinations Inner Join
  transports
    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join
  transport_destinations transport_destinations1
    On transports.dep_dest_id = transport_destinations1.dest_id WHERE transport='".$id."' group by transport_destinations.destination";
	
		$res = $obj->getRows($sql);
	 
	  $msg1="";
	  $msg1 .="<option value=''>---Select---</option>";  
	  $msg2="";
	  $msg2 .="<option value=''>---Select---</option>";  
	foreach($res as $rec)//foreach loop  
	{   $status = true;
		 $msg1 .="<option value='".$rec['pickup']."'>".$rec['pickup']."</option>";  
		 $msg2 .="<option value='".$rec['droploc']."'>".$rec['droploc']."</option>"; 
	}
	
 echo json_encode(array('status' => $status, 'msg1' => $msg1,'msg2' => $msg2));
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "transpickup") {
		extract(array_map("filterIn", $_POST));
		 $sql = "Select
  transport_destinations.destination as pickup,
  transport_destinations1.destination As droploc
From
  transport_destinations Inner Join
  transports
    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join
  transport_destinations transport_destinations1
    On transports.dep_dest_id = transport_destinations1.dest_id WHERE transport='".$id."' and transport_destinations.destination ='".$pick."'  group by transport_destinations1.destination";
	
		$res = $obj->getRows($sql);
	 

	  $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	foreach($res as $rec)//foreach loop  
	{   $status = true;
		
		 $msg .="<option value='".$rec['droploc']."'>".$rec['droploc']."</option>"; 
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
		
	}
if($_POST['action']=="loadtrans")
{
	$sql="select trans_id,transport from transports group by transport";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['trans_id']."'>".$rec['transport']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loadmeal")
{
	$sql="select meal_id,mealtype from mealtypes where hotel_id='".$_POST['id']."'";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['meal_id']."'>".$rec['mealtype']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loadroom")
{
	$sql="select hotelroom_id,roomtype,actype from hotelroom where hotel_id=:id";
	$param= array(
			'id' => $_POST['id']
			);
	$row=$obj->getRows($sql,$param);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotelroom_id']."'>".$rec['roomtype']."-".$rec['actype']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loadservice")
{
	$sql="select serv_id,service from services ";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['serv_id']."'>".$rec['service']."</option>";  
	}
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
  if ( $_POST['action'] == "datatable") {
		
		if($_SESSION['usertype']=='ADMIN')
		{
			  $sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,destinations.destination,markup_detail.markup,admin.username  FROM  clientdetails,destinations,admin,markup_detail where clientdetails.tourdest=destinations.dest_id and markup_detail.quot_id=clientdetails.quot_id and clientdetails.user_id=admin.id  ";
		$columns = array('clientdetails.quot_id', 'clientdetails.clientname','clientdetails.mobile','clientdetails.email','clientdetails.arrivedate','clientdetails.departuredate','destinations.destination','markup_detail.markup','admin.username');
		$isResult = $obj->generateDatatableEmailPrint($sql, $columns, 'quot_id');		
		echo $isResult;	
                }
 
		/* if($_SESSION['usertype']=="HOTEL")
		{
		  $sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,destinations.destination,markup_detail.markup,hotels.username  FROM  clientdetails,destinations,hotels,hoteldetails,markup_detail where clientdetails.tourdest=destinations.dest_id and markup_detail.quot_id=clientdetails.quot_id and hoteldetails.quot_id=clientdetails.quot_id   and hoteldetails.hotel_id = hotels.hotel_id and hoteldetails.hotel_id='".$_SESSION['uid']."' ";
                 $columns = array('clientdetails.quot_id', 'clientdetails.clientname','clientdetails.mobile','clientdetails.email','clientdetails.arrivedate','clientdetails.departuredate','destinations.destination','markup_detail.markup','hotels.username');
		$isResult = $obj->generateDatatableHotel($sql, $columns, 'quot_id');		
		echo $isResult;		
		}*/
	  	
                  if($_SESSION['usertype']=="AGENT")
	         {
                     $sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,destinations.destination,markup_detail.markup,admin.username  FROM  clientdetails,destinations,admin,markup_detail where clientdetails.tourdest=destinations.dest_id and markup_detail.quot_id=clientdetails.quot_id and clientdetails.user_id=admin.id and clientdetails.user_id='".$_SESSION['uid']."' ";
                 $columns = array('clientdetails.quot_id', 'clientdetails.clientname','clientdetails.mobile','clientdetails.email','clientdetails.arrivedate','clientdetails.departuredate','destinations.destination','markup_detail.markup','admin.username');
		$isResult = $obj->generateDatatableAgentEmailPrint($sql, $columns, 'quot_id');		
		echo $isResult;

                 }
		
		  
		
	}
	


if($_POST['action']=="save1")
{ // print_r($_FILES);

	 if(isset($_SESSION['quot_id']))
	 {

	   $query="update clientdetails set clientname=:clientname,mobile=:mobile,email=:email,tourdest=:tourdest,arrivedate=:arrivedate,departuredate=:departuredate,trans_arrive_dest=:trans_arrive_dest,trans_dep_dest=:trans_dep_dest,tourduration=:tourduration,tourdurationnights=:tourdurationnights,season=:season,user_id=:user_id ,status=:status where quot_id=:id";
		$param= array(
			'id' => $_SESSION['quot_id'],
			'clientname' =>$_POST['clientname'],
			'mobile' =>$_POST['mobile'],
			'email' =>$_POST['email'],
			'tourdest' =>$_POST['tourdest'],
			'arrivedate' =>$_POST['arrivedate'],
			'departuredate' =>$_POST['departuredate'],			
			'trans_arrive_dest' =>$_POST['transarrivedest'],
			'trans_dep_dest' =>$_POST['transdeparturedest'],
			'tourduration' =>$_POST['tourduration'],
            'tourdurationnights' =>$_POST['tourdurationnight'],
			'season'=>$_POST['season'],
			'user_id'=>$_SESSION['uid'],
                         'status'=>0
			); 
			$inserted=$obj->update($query,$param);

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
		  $id=$obj->get_max("clientdetails","quot_id");
	 
	 
			
			 
	   $query="insert into clientdetails values(:id,:clientname,:mobile,:email,:tourdest,:arrivedate,:departuredate,:trans_arrive_dest,:trans_dep_dest,:tourduration,:tourdurationnight,:season,:user_id,:status)";
		$param= array(
			'id' => $id,
			'clientname' =>$_POST['clientname'],
			'mobile' =>$_POST['mobile'],
			'email' =>$_POST['email'],
			'tourdest' =>$_POST['tourdest'],
			'arrivedate' =>$_POST['arrivedate'],
			'departuredate' =>$_POST['departuredate'],
			'trans_arrive_dest' =>$_POST['transarrivedest'],
			'trans_dep_dest' =>$_POST['transdeparturedest'],
			'tourduration' =>$_POST['tourduration'],
            'tourdurationnight' =>$_POST['tourdurationnight'],
			'season'=>$_POST['season'],
			'user_id'=>$_SESSION['uid'],
                        'status'=>0
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$_SESSION['quot_id']=$id;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }
	    }         
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
if($_POST['action']=="save2")
{ // print_r($_FILES);

    $sql = "SELECT quot_id FROM  accomodetails where quot_id='".$_SESSION['quot_id']."' ";
    $res = $obj->getRows($sql);
    if(count($res)>0)
    {
    		$query="update accomodetails set noofroom=:noofroom,extrabeds=:extrabeds,childs=:childs,childs5yrs=:childs5yrs,actype=:actype where quot_id=:quot_id";
		$param= array(
			'quot_id' =>$_SESSION['quot_id'],
			'noofroom' =>$_POST['noofroom'],
			'extrabeds' =>$_POST['extrabeds'],
			'childs' =>$_POST['childs'],
			'childs5yrs' =>$_POST['childs5yrs'],					
			'actype' =>$_POST['actype']
			); 
			$inserted=$obj->update($query,$param);

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
    		
		  $id=$obj->get_max("accomodetails","accom_id");   			
			 
	    $query="insert into accomodetails values(:id,:quot_id,:noofroom,:extrabeds,:childs,:childs5yrs,:actype)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
			'noofroom' =>$_POST['noofroom'],
			'extrabeds' =>$_POST['extrabeds'],
			'childs' =>$_POST['childs'],
			'childs5yrs' =>$_POST['childs5yrs'],					
			'actype' =>$_POST['actype']
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted>0) {
					$status = true;					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }
	         }
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
if($_POST['action']=="save3")
{ // print_r($_FILES);
                $halt_id=explode(',',$_POST['halt_id']);
		$hotel_id=explode(',',$_POST['hotel_id']);
		$noofnights=explode(',',$_POST['noofnights']);
                $fromdate=explode(',',$_POST['fromdate']);
                $todate=explode(',',$_POST['todate']);
		$room_id=explode(',',$_POST['room_id']);
		$meal_id=explode(',',$_POST['meal_id']);
		
		$inserted=0;
		$sql = "SELECT quot_id FROM  hoteldetails where quot_id='".$_SESSION['quot_id']."' ";
   		 $res = $obj->getRows($sql);
        if(count($res)>0)
        {
        	$isDeleted = $obj->delete('hoteldetails', 'quot_id', $_SESSION['quot_id']);

        	for($i=0;$i<sizeof($hotel_id);$i++)
		{
	
		  $id=$obj->get_max("hoteldetails","halt_id");
			
			 
	   $query="insert into hoteldetails values(:id,:quot_id,:halt_id,:hotel_id,:noofnights,:fromdate,:todate,:room_id,:meal_id)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
                        'halt_id'=>$halt_id[$i],
			'hotel_id' =>$hotel_id[$i],
			'noofnights' =>$noofnights[$i],
                        'fromdate' =>$fromdate[$i],
                        'todate' =>$todate[$i],
			'room_id' =>$room_id[$i],			
			'meal_id' =>$meal_id[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($hotel_id)) {
					$status = true;
					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	          }
        }
        else
        {
		for($i=0;$i<sizeof($hotel_id);$i++)
		{
	
		  $id=$obj->get_max("hoteldetails","halt_id");
			
			 
	   $query="insert into hoteldetails values(:id,:quot_id,:halt_id,:hotel_id,:noofnights,:fromdate,:todate,:room_id,:meal_id)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
                        'halt_id'=>$halt_id[$i],
			'hotel_id' =>$hotel_id[$i],
			'noofnights' =>$noofnights[$i],
                        'fromdate' =>$fromdate[$i],
                        'todate' =>$todate[$i],
			'room_id' =>$room_id[$i],			
			'meal_id' =>$meal_id[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($hotel_id)) {
					$status = true;
					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	          }     
	      }
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}		
if($_POST['action']=="save4")
{ // print_r($_FILES);
		$day=explode(',',$_POST['day']);
		$description=explode(',',$_POST['description']);
		$trans_id=explode(',',$_POST['trans_id']);
		$pickup_loc=explode(',',$_POST['pickup_loc']);
		$drop_loc=explode(',',$_POST['drop_loc']);
                $noofcabs=explode(',',$_POST['noofcabs']);
             
		$inserted=0;
		$sql = "SELECT quot_id FROM  itinerary where quot_id='".$_SESSION['quot_id']."' ";
   		 $res = $obj->getRows($sql);
        if(count($res)>0)
        {
        	$isDeleted = $obj->delete('itinerary', 'quot_id', $_SESSION['quot_id']);
        	for($i=0;$i<sizeof($day);$i++)
		{
	
		  $id=$obj->get_max("itinerary","itinerary_id");
			
	$sql="Select
  transports.trans_id
From
  transport_destinations Inner Join
  transports
    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join
  transport_destinations transport_destinations1
    On transports.dep_dest_id = transport_destinations1.dest_id where transports.transport=:transport and transport_destinations.destination=:pickup_loc and transport_destinations1.destination=:drop_loc";
	$param= array(
			'transport' => $trans_id[$i],
			'pickup_loc' => $pickup_loc[$i],
			'drop_loc' => $drop_loc[$i],

			);
	$row=$obj->getRows($sql,$param);
	$transid=0;	
	foreach($row as $rec)//foreach loop  
	{  
		$transid=$rec['trans_id'];  
	}	

	   $query="insert into itinerary values(:id,:quot_id,:day,:description,:trans_id,:pickup_loc,:drop_loc,:noofcabs)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
			'day' =>$day[$i],
			'description' =>$description[$i],
			'trans_id' =>$transid,
			'pickup_loc' =>$pickup_loc[$i],
			'drop_loc' =>$drop_loc[$i],
                        'noofcabs'=>$noofcabs[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($day)) {
					$status = true;
					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }  
        }
        else
        {	
		for($i=0;$i<sizeof($day);$i++)
		{
	
		  $id=$obj->get_max("itinerary","itinerary_id");
			$sql="Select
  transports.trans_id
From
  transport_destinations Inner Join
  transports
    On transports.arrive_dest_id = transport_destinations.dest_id Inner Join
  transport_destinations transport_destinations1
    On transports.dep_dest_id = transport_destinations1.dest_id where transports.transport=:transport and transport_destinations.destination=:pickup_loc and transport_destinations1.destination=:drop_loc";
	$param= array(
			'transport' => $trans_id[$i],
			'pickup_loc' => $pickup_loc[$i],
			'drop_loc' => $drop_loc[$i],

			);
	$row=$obj->getRows($sql,$param);
	$transid=0;	
	foreach($row as $rec)//foreach loop  
	{  
		$transid=$rec['trans_id'];  
	}	
			 
	   $query="insert into itinerary values(:id,:quot_id,:day,:description,:trans_id,:pickup_loc,:drop_loc,:noofcabs)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
			'day' =>$day[$i],
			'description' =>$description[$i],
			'trans_id' =>$transid,
			'pickup_loc' =>$pickup_loc[$i],
			'drop_loc' =>$drop_loc[$i],
                        'noofcabs'=>$noofcabs[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($day)) {
					$status = true;
					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }     
	     }        
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}
if($_POST['action']=="save5")
{ // print_r($_FILES);

					
		$service=explode(',',$_POST['service']);
		$payable=explode(',',$_POST['payable']);
		
		$inserted=0;
			$sql = "SELECT quot_id FROM  service_details where quot_id='".$_SESSION['quot_id']."' ";
   		 $res = $obj->getRows($sql);
        if(count($res)>0)
        {
        	$isDeleted = $obj->delete('service_details', 'quot_id', $_SESSION['quot_id']);
            for($i=0;$i<sizeof($service);$i++)
		{
	
		  $id=$obj->get_max("service_details","serv_det_id");
			
			 
	   $query="insert into service_details values(:id,:quot_id,:service,:payable)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
			'service' =>$service[$i],
			'payable' =>$payable[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($service)) {
					$status = true;					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }  
        }
        else 
        {	
		for($i=0;$i<sizeof($service);$i++)
		{
	
		  $id=$obj->get_max("service_details","serv_det_id");
			
			 
	   $query="insert into service_details values(:id,:quot_id,:service,:payable)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
			'service' =>$service[$i],
			'payable' =>$payable[$i]
			); 
			$inserted+=$obj->insert($query,$param);

			
	     }   
	     if($inserted ==sizeof($service)) {
					$status = true;
					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }   
	           }    
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}
if($_POST['action']=="save6")
{ // print_r($_FILES);

    $sql = "SELECT quot_id FROM  markup_detail where quot_id='".$_SESSION['quot_id']."' ";
    $res = $obj->getRows($sql);
    if(count($res)>0)
    {           

                if($_FILES['file']['tmp_name']=="")
	       {
                
    		$query="update markup_detail set markup=:markup,nameofcompany=:nameofcompany,corp_office=:corp_office,reg_office=:reg_office,hotline=:hotline,emailat=:emailat,website=:website where quot_id=:quot_id";
		$param= array(
			'quot_id' =>$_SESSION['quot_id'],
                        'markup' =>$_POST['markup'],
			'nameofcompany' =>$_POST['nameofcompany'],
			'corp_office' =>$_POST['corp_office'],
			'reg_office' =>$_POST['reg_office'],
			'hotline' =>$_POST['hotline'],					
			'emailat' =>$_POST['emailat'],
                        'website' =>$_POST['website']
			); 
			$inserted=$obj->update($query,$param);

			if($inserted) {
					$status = true;	
                                        $_SESSION['quot_id']="";
					unset($_SESSION['quot_id']);				
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }
               }
               else
                {
                         $data = file_get_contents($_FILES['file']['tmp_name']);
                       $query="update markup_detail set markup=:markup,nameofcompany=:nameofcompany,corp_office=:corp_office,reg_office=:reg_office,hotline=:hotline,emailat=:emailat,website=:website,logoofcompany=:logoofcompany where quot_id=:quot_id";
		$param= array(
			'quot_id' =>$_SESSION['quot_id'],
                        'markup' =>$_POST['markup'],
			'nameofcompany' =>$_POST['nameofcompany'],
			'corp_office' =>$_POST['corp_office'],
			'reg_office' =>$_POST['reg_office'],
			'hotline' =>$_POST['hotline'],					
			'emailat' =>$_POST['emailat'],
                        'website' =>$_POST['website'],
                        'logoofcompany'=>$data
			); 
			$inserted=$obj->update($query,$param);

			if($inserted) {
					$status = true;	
                                        $_SESSION['quot_id']="";
					unset($_SESSION['quot_id']);				
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }

                }
    }
    else
    	{	
    	       if($_FILES['file']['tmp_name']=="")
	       {
                    $id=$obj->get_max("markup_detail","markup_id");   			
		$sql = "SELECT admin.nameofcompany,admin.corp_office,admin.reg_office,admin.hotline,admin.emailat,admin.website,admin.logoofcompany FROM  admin where id=:id";
		$param = array('id'=>$_SESSION['uid']);
		$res = $obj->getRows($sql, $param);
		
		$data="";
    
    foreach ($res as $row)
    {
      
       
        $data= $row["logoofcompany"];

    }		 
	    $query="insert into markup_detail values(:id,:quot_id,:markup,:nameofcompany,:corp_office,:reg_office,:hotline,:emailat,:website,:logoofcompany)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
                         'markup' =>$_POST['markup'],
			'nameofcompany' =>$_POST['nameofcompany'],
			'corp_office' =>$_POST['corp_office'],
			'reg_office' =>$_POST['reg_office'],
			'hotline' =>$_POST['hotline'],					
			'emailat' =>$_POST['emailat'],
                        'website' =>$_POST['website'],
                         'logoofcompany'=>$data
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted>0) {
					$status = true;	
                                        $_SESSION['quot_id']="";
					unset($_SESSION['quot_id']);				
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }    
               }
               else
               {
		  $id=$obj->get_max("markup_detail","markup_id");   			
		   $data = file_get_contents($_FILES['file']['tmp_name']);	 
	    $query="insert into markup_detail values(:id,:quot_id,:markup,:nameofcompany,:corp_office,:reg_office,:hotline,:emailat,:website,:logoofcompany)";
		$param= array(
			'id' => $id,
			'quot_id' =>$_SESSION['quot_id'],
                         'markup' =>$_POST['markup'],
			'nameofcompany' =>$_POST['nameofcompany'],
			'corp_office' =>$_POST['corp_office'],
			'reg_office' =>$_POST['reg_office'],
			'hotline' =>$_POST['hotline'],					
			'emailat' =>$_POST['emailat'],
                        'website' =>$_POST['website'],
                        'logoofcompany'=>$data
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted>0) {
					$status = true;	
                                        $_SESSION['quot_id']="";
					unset($_SESSION['quot_id']);				
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }

                 }





	         } 
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
if (isset($_POST['action']) && $_POST['action'] == "edit") {
		
		$sql = "SELECT admin.nameofcompany,admin.corp_office,admin.reg_office,admin.hotline,admin.emailat,admin.website,admin.logoofcompany FROM  admin where id=:id";
		$param = array('id'=>$_SESSION['uid']);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
       
        $post["nameofcompany"]  = $row["nameofcompany"];
        $post["corp_office"]  = $row["corp_office"];
        $post["reg_office"]  = $row["reg_office"];
        $post["hotline"]  = $row["hotline"];
        $post["emailat"]  = $row["emailat"];
        $post["website"]  = $row["website"];
        $post["logoofcompany"]  = base64_encode($row["logoofcompany"]);
       
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "print") {
		extract(array_map("filterIn", $_REQUEST));
		require('WriteHTML.php');

$seasontext="";

$sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,clientdetails.season,clientdetails.tourduration,clientdetails.tourdurationnights,	clientdetails.trans_arrive_dest,clientdetails.trans_dep_dest,destinations.destination FROM  clientdetails,destinations where clientdetails.tourdest=destinations.dest_id and clientdetails.quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
$seasontext=$row["season"];

}
if($seasontext=='ON')
		{
                   $seasontext="ON Season";
                }
                else
                {
                  $seasontext="OFF Season";
                }

echo '<style>
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.tr:nth-child(odd) td,tr:nth-child(odd) th {
    background-color: #f9f9f9;
}
th, td {
    word-break: break-word;
    padding: 8px 10px;
}

.td {
    word-break: break-word;
    padding: 0px 10px;
}
p{
	    word-wrap: break-word;
    width: 800px;
    white-space: pre-line;
}
div
{
	width:800px;
}
</style>';
$html=" 
<table class='table table-bordered table-hover table-condensed' style=\"margin-left:auto; margin-right:auto; border:1px solid #666; height:auto; width:800px\"  >
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>";
$markup=0;
$sql = "SELECT * FROM  markup_detail where quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
     $markup=$row["markup"];
if($row["logoofcompany"]!="")
 $html.="<img src='data:image/jpg;base64,".base64_encode($row["logoofcompany"])."' style='width:40%;float: left;'> <div>";
$html.="<h1>".$row["nameofcompany"]."</h1> ";
$html.="<p style='font-size:15px;  '>";
if($row["corp_office"]!="")
$html.="Corporate Office- ".$row["corp_office"]."<br />";
if($row["reg_office"]!="")
$html.="Regional Office- ".$row["reg_office"]."<br/>";
if($row["hotline"]!="")
$html.="Hotline : ".$row["hotline"]."<br/>";
if($row["emailat"]!="")
$html.="Email us : ".$row["emailat"]."<br/>";
if($row["website"]!="")
$html.="Website : ".$row["website"]."";

$html.="</p>";
}
$html.="</div><hr />
</td>
</tr>
<tr>
<td class='td'>
<table width='100%' >
<tr>
<td class='td' width='50%' height='25' valign='top' style='font-size:16px;'>
 <b>Quote No.".$_REQUEST['quoteid']." ( ".$seasontext." )</b> 
</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td> ";
$season="";
$tourdur=0;
$sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,clientdetails.season,clientdetails.tourduration,clientdetails.tourdurationnights,	clientdetails.trans_arrive_dest,clientdetails.trans_dep_dest,destinations.destination FROM  clientdetails,destinations where clientdetails.tourdest=destinations.dest_id and clientdetails.quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	 
$season=$row["season"];
$tourdur=$row["tourduration"];
$html.="
<table width='100%' border='' cellpadding='0' cellspacing='0' >

<tr>
<td>CLIENT NAME:</td><td>".$row["clientname"]."</td><td>MOBILE</td><td>".$row["mobile"]."</td>
</tr>
<tr>
<td>TOUR DESTINATION</td><td>".$row["destination"]."</td><td>MAIL</td><td>".$row["email"]."</td>
</tr>
<tr>
<td>ARRIVAL DATE</td><td>".$row["arrivedate"]."</td><td>DEPATURE DATE</td><td>".$row["departuredate"]."</td>
</tr>
<tr>
<td>ARRIVAL DESTINATION</td><td>".$row["trans_arrive_dest"]."</td><td>DEPARTURRE DESTINATION</td><td>".$row["trans_dep_dest"]."</td>
</tr>
<tr>
<td>TOUR DURATION</td><td>".$row["tourdurationnights"]." Nights & ".$row["tourduration"]." Days </td><td>&nbsp;</td><td>&nbsp;</td>
</tr>

</table>";
}

$html.="</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Accomodation & Transportation Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 
";
$noofrrom=0;$extrabeds=0;$childs=0;$childs5yrs=0;$transport=0;
$sql2 = "SELECT accomodetails.quot_id, accomodetails.noofroom,accomodetails.extrabeds,accomodetails.childs,accomodetails.childs5yrs,accomodetails.actype FROM  accomodetails where   accomodetails.quot_id='".$_REQUEST['quoteid']."' ";
$res2 = $obj->getRows($sql2);


    foreach ($res2 as $row2)
    {	
$noofroom=$row2['noofroom'];
$extrabeds=$row2['extrabeds'];
$childs=$row2['childs'];
$childs5yrs=$row2['childs5yrs'];



$html.="

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number Of Rooms</td><td>".$row2["noofroom"]."</td><td>Number Of Extra Beds</td><td>".$row2["extrabeds"]."</td>
</tr>
<tr>
<td>Number Of Childs Without Beds</td><td>".$row2["childs"]."</td><td>Childs Below 5 Yrs(Free)</td><td>".$row2["childs5yrs"]."</td>
</tr>

<tr>
<td>AC or NON-AC</td><td>".$row2["actype"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>

</table>";
}

$html.="</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Night Halting Places(EG)
<th>Nights
<th>Check In
<th>Check Out
<th>Hotel Type
<th>Room Type
<th>Meal Type
</tr>";
$sql3 = "SELECT hoteldetails.quot_id, hotels.hotelname,hotels.hoteltype,hoteldetails.fromdate,hoteldetails.todate,hoteldetails.noofnights,hotelroom.roomtype,hotelroom.charge_ep,hotelroom.extrabed_ep,hotelroom.extraperson_ep,hotelroom.extrachild_ep,hotelroom.charge_cp,hotelroom.extrabed_cp,hotelroom.extraperson_cp,hotelroom.extrachild_cp,hotelroom.charge_map,hotelroom.extrabed_map,hotelroom.extraperson_map,hotelroom.extrachild_map,hotelroom.charge_ap,hotelroom.extrabed_ap,hotelroom.extraperson_ap,hotelroom.extrachild_ap,hotelroom.off_charge_ep,hotelroom.off_extrabed_ep,hotelroom.off_extraperson_ep,hotelroom.off_extrachild_ep,hotelroom.off_charge_cp,hotelroom.off_extrabed_cp,hotelroom.off_extraperson_cp,hotelroom.off_extrachild_cp,hotelroom.off_charge_map,hotelroom.off_extrabed_map,hotelroom.off_extraperson_map,hotelroom.off_extrachild_map,hotelroom.off_charge_ap,hotelroom.off_extrabed_ap,hotelroom.off_extraperson_ap,hotelroom.off_extrachild_ap,hoteldetails.meal_id,haltdestinations.destination FROM  hoteldetails,hotels,hotelroom,haltdestinations where hoteldetails.hotel_id=hotels.hotel_id and hoteldetails.room_id=hotelroom.hotelroom_id and haltdestinations.dest_id =hoteldetails.halt_dest_id and hoteldetails.quot_id='".$_REQUEST['quoteid']."' ";
$res3 = $obj->getRows($sql3);
$totalcharge=0;$totalbed=0;$totaleperson=0;$totalextrachild=0;$nonights=0;
/*$totalmealexper=0;$totalmealexchild=0;*/
    foreach ($res3 as $row3)
    {
		$nonights=$row3["noofnights"];
		$charge=0;$extrabed=0;$extraperson=0;$extrachild=0;
		if($season=='ON')
		{


 
    	if($row3["meal_id"]=="EP") 
   		 {
   	  		$charge=$row3["charge_ep"];
      		        $extrabed=$row3["extrabed_ep"];
 			$extraperson=$row3["extraperson_ep"];
 			$extrachild=$row3["extrachild_ep"];
 		}
 		if($row3["meal_id"]=="CP") 
    	{
   	  		$charge=$row3["charge_cp"];
      		        $extrabed=$row3["extrabed_cp"];
 			$extraperson=$row3["extraperson_cp"];
 			$extrachild=$row3["extrachild_cp"];
 		}
 		if($row3["meal_id"]=="MAP") 
    	{
   	  		$charge=$row3["charge_map"];
      		        $extrabed=$row3["extrabed_map"];
 			$extraperson=$row3["extraperson_map"];
 			$extrachild=$row3["extrachild_map"];
 		}
 		if($row3["meal_id"]=="AP") 
   		 {
   	  		$charge=$row3["charge_ap"];
      		        $extrabed=$row3["extrabed_ap"];
 			$extraperson=$row3["extraperson_ap"];
 			$extrachild=$row3["extrachild_ap"];
 		}

		}
		else
		{
			if($row3["meal_id"]=="EP") 
   		 {
   	  		$charge=$row3["off_charge_ep"];
      		        $extrabed=$row3["off_extrabed_ep"];
 			$extraperson=$row3["off_extraperson_ep"];
 			$extrachild=$row3["off_extrachild_ep"];
 		}
 		if($row3["meal_id"]=="CP") 
    	{
   	  		$charge=$row3["off_charge_cp"];
      		        $extrabed=$row3["off_extrabed_cp"];
 			$extraperson=$row3["off_extraperson_cp"];
 			$extrachild=$row3["off_extrachild_cp"];
 		}
 		if($row3["meal_id"]=="MAP") 
    	{
   	  		$charge=$row3["off_charge_map"];
      		        $extrabed=$row3["off_extrabed_map"];
 			$extraperson=$row3["off_extraperson_map"];
 			$extrachild=$row3["off_extrachild_map"];
 		}
 		if($row3["meal_id"]=="AP") 
   		 {
   	  		$charge=$row3["off_charge_ap"];
      		        $extrabed=$row3["off_extrabed_ap"];
 			$extraperson=$row3["off_extraperson_ap"];
 			$extrachild=$row3["off_extrachild_ap"];
 		}

		}
$totalcharge=$totalcharge+($charge*$noofroom*$nonights);
$totalbed=$totalbed+($extrabed*$extrabeds*$nonights);
/*$totaleperson=$totaleperson+($extraperson*$childs10yrs*$nonights);*/
$totalextrachild=$totalextrachild+($extrachild*$childs5yrs*$nonights);
/*$totalmealexper=$totalmealexper+($row3["costing"]*$childs10yrs*$nonights);
$totalmealexchild=$totalmealexchild+(($row3["costing"]/2)*$childs5yrs*$nonights);*/

$html.="<tr>";
         $html.="<td>".$row3['hotelname']."<br>( ".$row3['destination']." )</td>";
         $html.="<td>".$row3['noofnights']." </td><td>".$row3['fromdate']." </td><td> ".$row3['todate']." </td>";

         switch($row3['hoteltype'])
          {
            case 1:   $html.="<td> Standard </td>";break;
            case 2:   $html.="<td> Deluxe </td>";break;
            case 3:   $html.="<td> Super Deluxe </td>";break;
            case 4:   $html.="<td> Comfort </td>";break;
            case 5:   $html.="<td> Luxury </td>";break;

          }
      
         $html.="<td>".$row3['roomtype']."</td>";
         $html.="<td>".$row3['meal_id']."</td>";
         $html.="</tr>";
    }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Ad-on Services</b> <br /> </p>

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Service
<th>Payable/Free

</tr>";
$sql4 = "SELECT service_details.quot_id, services.service, services.costing, services.offcosting,service_details.payable FROM  service_details,services where  service_details.serv_id=services.serv_id and  service_details.quot_id='".$_REQUEST['quoteid']."' ";
$res4 = $obj->getRows($sql4);
$servicetotal=0;$serv=0;
    foreach ($res4 as $row4)
    {	if($season=='ON')
  		{    $servicetotal=$servicetotal+ $row4['costing'];
                     $serv=$row4['costing'];
  		}
  		else
  		{
  			$servicetotal=$servicetotal+$row4['offcosting'];
                        $serv=$row4['offcosting'];
  		}
$html.="<tr>";
         $html.="<td> ".$row4['service']."</td>";        
         if($row4['payable']=='FREE')
         	 $html.="<td>".$row4['payable']."</td>"; 
         	else
            $html.="<td>".$serv."</td>";       
         $html.="</tr>";
    }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Tour Itinerary Daywise</b> <br /> </p> 

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >";
$sql5 = "SELECT itinerary.quot_id, itinerary.day,itinerary.description FROM  itinerary where   itinerary.quot_id='".$_REQUEST['quoteid']."' order by itinerary.Itinerary_id";
$res5 = $obj->getRows($sql5);
$cnt=count($res5);
$cnt=$cnt-1;
    foreach ($res5 as $row5)
    {
$html.="<tr>";
         $html.="<td width='50px'> Day ".$row5['day']."</td>";
         $html.="<td>".$row5['description']."</td>";        
         $html.="</tr>";
    }


$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Transportation Daywise</b> <br /> </p>

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' ><tr>
<th>Day
<th>Transport
<th>Pickup Location
<th>Drop Location
</tr>";
$sql6 = "SELECT itinerary.day,transports.transport,transports.costing,transports.offcosting,itinerary.pickup_loc,itinerary.drop_loc,itinerary.noofcabs FROM  itinerary,transports where  transports.trans_id=itinerary.trans_id and itinerary.quot_id='".$_REQUEST['quoteid']."' order by itinerary.Itinerary_id";
$res6 = $obj->getRows($sql6);
$cnt=count($res6);
$cnt=$cnt-1;
    foreach ($res6 as $row6)
    {
    	if($season=='ON')
{
 $chrg=$row6['costing'];
$cabs=$row6['noofcabs'];
 settype($chrg,'float');
 settype($cabs,'float');
$transport+=($chrg*$cabs);

}
else
{

$chrg=$row6['offcosting'];
 $cabs=$row6['noofcabs'];
 settype($chrg,'float');
 settype($cabs,'float');
$transport+=($chrg*$cabs);
}
$html.="<tr>";
         $html.="<td width='50px'> Day ".$row6['day']."</td>";
         $html.="<td>".$row6['transport']."</td>"; 
         $html.="<td>".$row6['pickup_loc']."</td>";    
         $html.="<td>".$row6['drop_loc']."</td>";           
         $html.="</tr>";
    }

$acco=($totalcharge+$totalbed+$totalextrachild );
$ttrans=$transport;
/*$html.="Charge".$totalcharge."/ ExtraBed".$totalbed."/Trans".$transport."/Servic".$servicetotal;*/
$billtotal=($acco +$servicetotal+$ttrans);

/*$markupper=($markup*$billtotal)/100;*/
$finaltotal=$billtotal+$markup;
$html.="</table>
</td>
</tr>
<tr>
<td align='left' style='border-bottom:1px solid #999l;'>  

<p style='font-size:18px;'> <b>Total Package For the Above Services : ".$finaltotal." /- INR. </b> <br /> 
<b> In-Words :".convert_number_to_words($finaltotal)." Only.</b>

</p>

</td>
</tr>
<tr>
<td  style='font-size:16px;' > 
<table width='80%' border='0' cellpadding='0' cellspacing='0' >
<tr>
<td>
<div>
<hr />
<h3>Terms & Conditions: </h3>
<p>The above is only the Quotation not a confirmation once we will receive confirmation from you after depositing advances in our companies account then we can mail you a confirmation voucher accordingly & the services and accommodation will be similar as per above agreement till we can get a mail from your side: </p>

<p>If circumstances make you cancel the booking, the cancellation must be intimated to us in writing. Such cancellation will attract the following cancellation charges:</p>
<ul>
<li>	Cancellation Charges for Hotel Bookings/ Hotel Packages
<li>	As per individual hotel norms
<li>	High Season Cancellation Charges ! - 100% of the Booking Amount in all circumstances
<li>	Cancellation charges for Tours/Tour Packages
<li>	Cancellation Charges attracted! 
<li>	16 to 30 days before arrival - 30% of the tour cost
<li>	07 to 15 days before arrival - 40% of the tour cost
<li>	Less than 06 days or no show -  100% of the Booking Amount in all circumstances
<li>    Agents markup = Total package cost x markup rate /100+markup rate ​
<li>    Off season will start from : 15th Aug to 31st March and season will start from 1st April to 14th Aug.
</ul>
<h3>Refund </h3>
<p>The Company reserves the right to determine the quantum of refund payable in case of cancellation or amendment of a Holiday due to Force Majeure or Vis Majeure. Such refund would be based on various number of factors and the decision of the Company on the quantum of refund shall be final. Refunds (if any) for amendment and/or cancellations will be paid directly to the Clients by the Company. Administrative costs of Rs. 500 in case of hotels and Rs. 1000 in case of tours will be deducted from the Refund Amount. It would take atleast 30 days to process such refunds.</p>
<p>Refunds are subject to us by collecting the refunds from the independent contractors !!!</p>
<p>There shall be no refund if the Client does not or cannot utilize the Hotels or the services provided therein. Nor can any refund be made for loss of hotel vouchers etc. by the clients. </p>
<h3>Arbitration </h3>
<p>For all claims or disputes of whatsoever nature relating to the Clients, claim of deficiency in service or the like, the same shall be resolved by a Sole Arbitrator to be nominated by the Company. The arbitration shall be in held in   Cashmir . The arbitration shall be governed by the provisions of the Indian Arbitration & Conciliation Act 1996.</p>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
<script type='text/javascript'>
window.print(); 
</script>";
echo $html;

	}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "mail") {
		extract(array_map("filterIn", $_REQUEST));
		require('WriteHTML.php');

$seasontext="";

$sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,clientdetails.season,clientdetails.tourduration,clientdetails.tourdurationnights,	clientdetails.trans_arrive_dest,clientdetails.trans_dep_dest,destinations.destination FROM  clientdetails,destinations where clientdetails.tourdest=destinations.dest_id and clientdetails.quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
$seasontext=$row["season"];

}
if($seasontext=='ON')
		{
                   $seasontext="ON Season";
                }
                else
                {
                  $seasontext="OFF Season";
                }

$html='<html><head><style rel="stylesheet" type="text/css">
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.tr:nth-child(odd) td,tr:nth-child(odd) th {
    background-color: #f9f9f9;
} 
th, td {
    font-size: 13px;
    word-break: break-word;
    padding: 8px 10px;
}

.td {
     font-size: 13px;
    word-break: break-word;
    padding: 0px 10px;
}
p{font-size: 13px;
	    word-wrap: break-word;
    width: 800px;
    white-space: pre-line;
}
div
{
	width:100%;
}
</style></head><body>';
 
$html.=" <div style=\" font-family: Arial,Helvetica,sans-serif;font-size: 13px; color: #000;line-height: 20px;width:100% \">
<table style=\"width:832px;font-family:Calibri;border:1px solid rgb(223,223,223)\"  >
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>";
$markup=0;
$sql = "SELECT * FROM  markup_detail where quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
     $markup=$row["markup"];
if($row["logoofcompany"]!="")
 $html.="<img src='data:image/jpg;base64,".base64_encode($row["logoofcompany"])."' style='width:40%;float: left;'> <div>";
$html.="<h1>".$row["nameofcompany"]."</h1> ";
$html.="<p style='font-size:15px;  '>";
if($row["corp_office"]!="")
$html.="Corporate Office- ".$row["corp_office"]."<br />";
if($row["reg_office"]!="")
$html.="Regional Office- ".$row["reg_office"]."<br/>";
if($row["hotline"]!="")
$html.="Hotline : ".$row["hotline"]."<br/>";
if($row["emailat"]!="")
$html.="Email us : ".$row["emailat"]."<br/>";
if($row["website"]!="")
$html.="Website : ".$row["website"]."";

$html.="</p>";
}
$html.="<hr />
</td>
</tr>
<tr>
<td class='td'>
<table width='100%' >
<tr>
<td class='td' width='50%' height='25' valign='top' style='font-size:16px;'>
 <b>Quote No.".$_REQUEST['quoteid']." ( ".$seasontext." )</b> 
</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td> ";
$season="";
$cemail="";
$cname="";
$tourdur=0;
$sql = "SELECT clientdetails.quot_id, clientdetails.clientname,clientdetails.mobile,clientdetails.email,clientdetails.arrivedate,clientdetails.departuredate,clientdetails.season,clientdetails.tourduration,clientdetails.tourdurationnights,	clientdetails.trans_arrive_dest,clientdetails.trans_dep_dest,destinations.destination FROM  clientdetails,destinations where clientdetails.tourdest=destinations.dest_id and clientdetails.quot_id='".$_REQUEST['quoteid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	 
$season=$row["season"];
$cemail=$row["email"];
$cname=$row["clientname"];
$tourdur=$row["tourduration"];
$html.="
<table width='100%' border='' cellpadding='0' cellspacing='0' >

<tr>
<td>CLIENT NAME:</td><td>".$row["clientname"]."</td><td>MOBILE</td><td>".$row["mobile"]."</td>
</tr>
<tr>
<td>TOUR DESTINATION</td><td>".$row["destination"]."</td><td>MAIL</td><td>".$row["email"]."</td>
</tr>
<tr>
<td>ARRIVAL DATE</td><td>".$row["arrivedate"]."</td><td>DEPATURE DATE</td><td>".$row["departuredate"]."</td>
</tr>
<tr>
<td>ARRIVAL DESTINATION</td><td>".$row["trans_arrive_dest"]."</td><td>DEPARTURRE DESTINATION</td><td>".$row["trans_dep_dest"]."</td>
</tr>
<tr>
<td>TOUR DURATION</td><td>".$row["tourdurationnights"]." Nights & ".$row["tourduration"]." Days </td><td>&nbsp;</td><td>&nbsp;</td>
</tr>

</table>";
}

$html.="</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Accomodation & Transportation Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 
";
$noofrrom=0;$extrabeds=0;$childs=0;$childs5yrs=0;$transport=0;
$sql2 = "SELECT accomodetails.quot_id, accomodetails.noofroom,accomodetails.extrabeds,accomodetails.childs,accomodetails.childs5yrs,accomodetails.actype FROM  accomodetails where   accomodetails.quot_id='".$_REQUEST['quoteid']."' ";
$res2 = $obj->getRows($sql2);


    foreach ($res2 as $row2)
    {	
$noofroom=$row2['noofroom'];
$extrabeds=$row2['extrabeds'];
$childs=$row2['childs'];
$childs5yrs=$row2['childs5yrs'];



$html.="

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number Of Rooms</td><td>".$row2["noofroom"]."</td><td>Number Of Extra Beds</td><td>".$row2["extrabeds"]."</td>
</tr>
<tr>
<td>Number Of Childs Without Beds</td><td>".$row2["childs"]."</td><td>Childs Below 5 Yrs(Free)</td><td>".$row2["childs5yrs"]."</td>
</tr>

<tr>
<td>AC or NON-AC</td><td>".$row2["actype"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>

</table>";
}

$html.="</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Night Halting Places(EG)
<th>Nights
<th>Check In
<th>Check Out
<th>Hotel Type
<th>Room Type
<th>Meal Type
</tr>";
$sql3 = "SELECT hoteldetails.quot_id, hotels.hotelname,hotels.hoteltype,hoteldetails.fromdate,hoteldetails.todate,hoteldetails.noofnights,hotelroom.roomtype,hotelroom.charge_ep,hotelroom.extrabed_ep,hotelroom.extraperson_ep,hotelroom.extrachild_ep,hotelroom.charge_cp,hotelroom.extrabed_cp,hotelroom.extraperson_cp,hotelroom.extrachild_cp,hotelroom.charge_map,hotelroom.extrabed_map,hotelroom.extraperson_map,hotelroom.extrachild_map,hotelroom.charge_ap,hotelroom.extrabed_ap,hotelroom.extraperson_ap,hotelroom.extrachild_ap,hotelroom.off_charge_ep,hotelroom.off_extrabed_ep,hotelroom.off_extraperson_ep,hotelroom.off_extrachild_ep,hotelroom.off_charge_cp,hotelroom.off_extrabed_cp,hotelroom.off_extraperson_cp,hotelroom.off_extrachild_cp,hotelroom.off_charge_map,hotelroom.off_extrabed_map,hotelroom.off_extraperson_map,hotelroom.off_extrachild_map,hotelroom.off_charge_ap,hotelroom.off_extrabed_ap,hotelroom.off_extraperson_ap,hotelroom.off_extrachild_ap,hoteldetails.meal_id,haltdestinations.destination FROM  hoteldetails,hotels,hotelroom,haltdestinations where hoteldetails.hotel_id=hotels.hotel_id and hoteldetails.room_id=hotelroom.hotelroom_id and haltdestinations.dest_id =hoteldetails.halt_dest_id and hoteldetails.quot_id='".$_REQUEST['quoteid']."' ";
$res3 = $obj->getRows($sql3);
$totalcharge=0;$totalbed=0;$totaleperson=0;$totalextrachild=0;$nonights=0;
/*$totalmealexper=0;$totalmealexchild=0;*/
    foreach ($res3 as $row3)
    {
		$nonights=$row3["noofnights"];
		$charge=0;$extrabed=0;$extraperson=0;$extrachild=0;
		if($season=='ON')
		{


 
    	if($row3["meal_id"]=="EP") 
   		 {
   	  		$charge=$row3["charge_ep"];
      		        $extrabed=$row3["extrabed_ep"];
 			$extraperson=$row3["extraperson_ep"];
 			$extrachild=$row3["extrachild_ep"];
 		}
 		if($row3["meal_id"]=="CP") 
    	{
   	  		$charge=$row3["charge_cp"];
      		        $extrabed=$row3["extrabed_cp"];
 			$extraperson=$row3["extraperson_cp"];
 			$extrachild=$row3["extrachild_cp"];
 		}
 		if($row3["meal_id"]=="MAP") 
    	{
   	  		$charge=$row3["charge_map"];
      		        $extrabed=$row3["extrabed_map"];
 			$extraperson=$row3["extraperson_map"];
 			$extrachild=$row3["extrachild_map"];
 		}
 		if($row3["meal_id"]=="AP") 
   		 {
   	  		$charge=$row3["charge_ap"];
      		        $extrabed=$row3["extrabed_ap"];
 			$extraperson=$row3["extraperson_ap"];
 			$extrachild=$row3["extrachild_ap"];
 		}

		}
		else
		{
			if($row3["meal_id"]=="EP") 
   		 {
   	  		$charge=$row3["off_charge_ep"];
      		        $extrabed=$row3["off_extrabed_ep"];
 			$extraperson=$row3["off_extraperson_ep"];
 			$extrachild=$row3["off_extrachild_ep"];
 		}
 		if($row3["meal_id"]=="CP") 
    	{
   	  		$charge=$row3["off_charge_cp"];
      		        $extrabed=$row3["off_extrabed_cp"];
 			$extraperson=$row3["off_extraperson_cp"];
 			$extrachild=$row3["off_extrachild_cp"];
 		}
 		if($row3["meal_id"]=="MAP") 
    	{
   	  		$charge=$row3["off_charge_map"];
      		        $extrabed=$row3["off_extrabed_map"];
 			$extraperson=$row3["off_extraperson_map"];
 			$extrachild=$row3["off_extrachild_map"];
 		}
 		if($row3["meal_id"]=="AP") 
   		 {
   	  		$charge=$row3["off_charge_ap"];
      		        $extrabed=$row3["off_extrabed_ap"];
 			$extraperson=$row3["off_extraperson_ap"];
 			$extrachild=$row3["off_extrachild_ap"];
 		}

		}
$totalcharge=$totalcharge+($charge*$noofroom*$nonights);
$totalbed=$totalbed+($extrabed*$extrabeds*$nonights);

/*$totaleperson=$totaleperson+($extraperson*$childs10yrs*$nonights);*/

$totalextrachild=$totalextrachild+($extrachild*$childs5yrs*$nonights);

/*$totalmealexper=$totalmealexper+($row3["costing"]*$childs10yrs*$nonights);
$totalmealexchild=$totalmealexchild+(($row3["costing"]/2)*$childs5yrs*$nonights);*/

$html.="<tr>";
        $html.="<td>".$row3['hotelname']." <br>( ".$row3['destination']." )</td>";
         $html.="<td>".$row3['noofnights']." </td><td>".$row3['fromdate']." </td><td> ".$row3['todate']." </td>";

         switch($row3['hoteltype'])
          {
            case 1:   $html.="<td> Standard </td>";break;
            case 2:   $html.="<td> Deluxe </td>";break;
            case 3:   $html.="<td> Super Deluxe </td>";break;
            case 4:   $html.="<td> Comfort </td>";break;
            case 5:   $html.="<td> Luxury </td>";break;

          }
      
         $html.="<td>".$row3['roomtype']."</td>";
         $html.="<td>".$row3['meal_id']."</td>";
         $html.="</tr>";
    }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Ad-on Services</b> <br /> </p>

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Service
<th>Payable/Free

</tr>";
$sql4 = "SELECT service_details.quot_id, services.service, services.costing, services.offcosting,service_details.payable FROM  service_details,services where  service_details.serv_id=services.serv_id and  service_details.quot_id='".$_REQUEST['quoteid']."' ";
$res4 = $obj->getRows($sql4);
$servicetotal=0;$serv=0;
    foreach ($res4 as $row4)
    {	if($season=='ON')
  		{    $servicetotal=$servicetotal+ $row4['costing'];
                     $serv=$row4['costing'];
  		}
  		else
  		{
  			$servicetotal=$servicetotal+$row4['offcosting'];
                        $serv=$row4['offcosting'];
  		}
$html.="<tr>";
         $html.="<td> ".$row4['service']."</td>";        
         if($row4['payable']=='FREE')
         	 $html.="<td>".$row4['payable']."</td>"; 
         	else
            $html.="<td>".$serv."</td>";       
         $html.="</tr>";
    }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Tour Itinerary Daywise</b> <br /> </p> 

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >";
$sql5 = "SELECT itinerary.quot_id, itinerary.day,itinerary.description FROM  itinerary where   itinerary.quot_id='".$_REQUEST['quoteid']."' order by itinerary.Itinerary_id";
$res5 = $obj->getRows($sql5);
$cnt=count($res5);
$cnt=$cnt-1;
    foreach ($res5 as $row5)
    {
$html.="<tr>";
         $html.="<td width='50px'> Day ".$row5['day']."</td>";
         $html.="<td>".$row5['description']."</td>";        
         $html.="</tr>";
    }


$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Transportation Daywise</b> <br /> </p>

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' ><tr>
<th>Day
<th>Transport
<th>Pickup Location
<th>Drop Location
</tr>";
$sql6 = "SELECT itinerary.day,transports.transport,transports.costing,transports.offcosting,itinerary.pickup_loc,itinerary.drop_loc,itinerary.noofcabs FROM  itinerary,transports where  transports.trans_id=itinerary.trans_id and itinerary.quot_id='".$_REQUEST['quoteid']."' order by itinerary.Itinerary_id";
$res6 = $obj->getRows($sql6);
$cnt=count($res6);
$cnt=$cnt-1;
    foreach ($res6 as $row6)
    {
    	if($season=='ON')
{
 $chrg=$row6['costing'];
 $cabs=$row6['noofcabs'];
 settype($chrg,'float');
 settype($cabs,'float');
 $transport+=($chrg*$cabs);

}
else
{

 $chrg=$row6['offcosting'];
 $cabs=$row6['noofcabs'];
 settype($chrg,'float');
 settype($cabs,'float');
 $transport+=($chrg*$cabs);
}
$html.="<tr>";
         $html.="<td width='50px'> Day ".$row6['day']."</td>";
         $html.="<td>".$row6['transport']."</td>"; 
         $html.="<td>".$row6['pickup_loc']."</td>";    
         $html.="<td>".$row6['drop_loc']."</td>";           
         $html.="</tr>";
    }

$acco=($totalcharge+$totalbed+$totalextrachild );
$ttrans=$transport;

$billtotal=($acco +$servicetotal+$ttrans);

/*$markupper=($markup*$billtotal)/100;*/
$finaltotal=$billtotal+$markup;
$html.="</table>
</td>
</tr>
<tr>
<td align='left' style='border-bottom:1px solid #999l;'>  

<p style='font-size:18px;'> <b>Total Package For the Above Services : ".$finaltotal." /- INR. </b> <br /> 
<b> In-Words :".convert_number_to_words($finaltotal)." Only.</b>

</p>

</td>
</tr>
<tr>
<td  style='font-size:16px;' > 
<table width='80%' border='0' cellpadding='0' cellspacing='0' >
<tr>
<td>
<div>
<hr />
<h3>Terms & Conditions: </h3>
<p>The above is only the Quotation not a confirmation once we will receive confirmation from you after depositing advances in our companies account then we can mail you a confirmation voucher accordingly & the services and accommodation will be similar as per above agreement till we can get a mail from your side: </p>

<p>If circumstances make you cancel the booking, the cancellation must be intimated to us in writing. Such cancellation will attract the following cancellation charges:</p>
<ul>
<li>	Cancellation Charges for Hotel Bookings/ Hotel Packages
<li>	As per individual hotel norms
<li>	High Season Cancellation Charges ! - 100% of the Booking Amount in all circumstances
<li>	Cancellation charges for Tours/Tour Packages
<li>	Cancellation Charges attracted! 
<li>	16 to 30 days before arrival - 30% of the tour cost
<li>	07 to 15 days before arrival - 40% of the tour cost
<li>	Less than 06 days or no show -  100% of the Booking Amount in all circumstances
<li>    Agents markup = Total package cost x markup rate /100+markup rate ​
<li>    Off season will start from : 15th Aug to 31st March and season will start from 1st April to 14th Aug.
</ul>
<h3>Refund </h3>
<p>The Company reserves the right to determine the quantum of refund payable in case of cancellation or amendment of a Holiday due to Force Majeure or Vis Majeure. Such refund would be based on various number of factors and the decision of the Company on the quantum of refund shall be final. Refunds (if any) for amendment and/or cancellations will be paid directly to the Clients by the Company. Administrative costs of Rs. 500 in case of hotels and Rs. 1000 in case of tours will be deducted from the Refund Amount. It would take atleast 30 days to process such refunds.</p>
<p>Refunds are subject to us by collecting the refunds from the independent contractors !!!</p>
<p>There shall be no refund if the Client does not or cannot utilize the Hotels or the services provided therein. Nor can any refund be made for loss of hotel vouchers etc. by the clients. </p>
<h3>Arbitration </h3>
<p>For all claims or disputes of whatsoever nature relating to the Clients, claim of deficiency in service or the like, the same shall be resolved by a Sole Arbitrator to be nominated by the Company. The arbitration shall be in held in   Cashmir . The arbitration shall be governed by the provisions of the Indian Arbitration & Conciliation Act 1996.</p>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table></div></body></html>";



	
  
   
	$from_mail='support@northern-travels.com';
	$from_name='Northern Travels';
	
	$subject='Quotation from northern-travels';

 
 require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "</pre>
<div>";
$body .= " Hello ".$cname."<br>,
";
$body .= $html."<br>";
$body .= "Sincerely,<br>
";
$body .= "Northern Travels";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "bh-61.webhostbox.net";
$mail->Port = 465; //465 or 587
$mail->IsHTML(true);
$mail->Username = "support@northern-travels.com";//"enquiry@kalpakpeb.com";
$mail->Password = "support@northern1";
$mail->SetFrom($from_mail);
$mail->Subject =$subject;



$mail->AddAddress($cemail);//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
//$mail->AddAttachment($file);
if(!$mail->Send()) {
	$status = false;
			$msg = 'There is an error sending the message'; 
exit;
}
else
{
			$status = true;
			$msg = 'Email sent successfully'; 
}
echo json_encode(array('status' => $status, 'msg' => $msg));
       //unlink($file);

	}

	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('clientdetails', 'quot_id', $id);
$isDeleted = $obj->delete('accomodetails', 'quot_id', $id);
$isDeleted = $obj->delete('hoteldetails', 'quot_id', $id);
$isDeleted = $obj->delete('itinerary', 'quot_id', $id);
$isDeleted = $obj->delete('service_details', 'quot_id', $id);
		if ($isDeleted) {
			$status = true;
			$msg = ' Record no.: '.$id.', Successfully Deleted!'; 
		} else {
			$status = false;
			$msg = 'Error, while Deleted Record no.: '.$id; 
		}
	 echo json_encode(array('status' => $status, 'msg' => $msg));
	}

if (isset($_POST['action']) && $_POST['action'] == "approve") {
		extract(array_map("filterIn", $_POST));
		$query="update clientdetails set status=:status where quot_id=:id";
					$param= array(
					'id' => $id,
			                'status' =>'1'
					); 
		$inserted=$obj->update($query,$param);
		if ($inserted) {
			$status = true;
			$msg = ' Record no.: '.$id.', Successfully Approved!'; 
		} else {
			$status = false;
			$msg = 'Error, while Deleted Record no.: '.$id; 
		}
	 echo json_encode(array('status' => $status, 'msg' => $msg));
	}


if($_REQUEST['action']=="ssss")
{

 
$from_mail='northerntravelsindiapvtltd@gmail.com';
	$from_name='Northern Travels';
	
	$subject='Quotation from northern-travels';

 
 require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "<div>";
$body .= " Hello User<br>,";
$body .= "<br>";
$body .= "Sincerely,<br>";
$body .= "Northern Travels";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // 465 or 587
$mail->IsHTML(true);
$mail->Username = "northerntravelsindiapvtltd@gmail.com";//"enquiry@kalpakpeb.com";
$mail->Password = "AMIR@1234#";
$mail->SetFrom($from_mail);
$mail->Subject =$subject;

$mail->AddAddress("rahul.samrut@gmail.com");//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
echo $res=$mail->Send();
if($res) {
echo "Error";
}
else
{
echo "success";
}
}
?>  