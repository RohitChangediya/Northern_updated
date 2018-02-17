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
	   	extract(array_map("filterIn", $_POST));
	   	if($_SESSION['usertype']=='ADMIN')
		{
		$sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m')";
		
		$res = $obj->getRows($sql);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["cust_name"]  = $row["cust_name"];
 $post["user"]  = $row["name"];
         $post["cust_contact"]  = $row["cust_contact"];
        $post["cust_email"]  = $row["cust_email"];
     $post["cust_location"]  = $row["cust_location"];
         $post["cust_status"]  = $row["cust_status"];
        $post["cust_details"]  = $row["cust_details"];
	
        array_push($response, $post);
    }
  }
    if($_SESSION['usertype']=='AGENT')
		{
			$sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m')";
		/*$param = array('lead_date'=>date("Y-m-d"));*/
		$res = $obj->getRows($sql);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["cust_name"]  = $row["cust_name"];
 $post["user"]  = $row["name"];
         $post["cust_contact"]  = $row["cust_contact"];
        $post["cust_email"]  = $row["cust_email"];
		 $post["cust_location"]  = $row["cust_location"];
         $post["cust_status"]  = $row["cust_status"];
        $post["cust_details"]  = $row["cust_details"];
	
        array_push($response, $post);
    }
		}
    echo json_encode($response);
		
	}
if ( $_POST['action'] == "datewise") {
		
	   	extract(array_map("filterIn", $_POST));

	   		if($_SESSION['usertype']=='ADMIN')
		{
		$sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date  From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m')";
		
		$res = $obj->getRows($sql);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["cust_name"]  = $row["cust_name"];
         $post["user"]  = $row["name"];
         $post["cust_contact"]  = $row["cust_contact"];
        $post["cust_email"]  = $row["cust_email"];
		 $post["cust_location"]  = $row["cust_location"];
         $post["cust_status"]  = $row["cust_status"];
        $post["cust_details"]  = $row["cust_details"];
	
        array_push($response, $post);
    }
}
 if($_SESSION['usertype']=='AGENT')
		{
			$sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date  From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m')";
		
		$res = $obj->getRows($sql);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["cust_name"]  = $row["cust_name"];
 $post["user"]  = $row["name"];
         $post["cust_contact"]  = $row["cust_contact"];
        $post["cust_email"]  = $row["cust_email"];
		 $post["cust_location"]  = $row["cust_location"];
         $post["cust_status"]  = $row["cust_status"];
        $post["cust_details"]  = $row["cust_details"];
	
        array_push($response, $post);
    }
			}
    echo json_encode($response);
		
	}	


if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['cust_id']=="")
	{
		
		  $id=$obj->get_max("leads","id");
			
			 
	       		$query="insert into leads values(:id,:cust_name,:cust_contact,:cust_email,:cust_location,:cust_status,:cust_details,:user_id,:lead_date)";
		$param= array(
			'id' => $id,
			'cust_name' =>$_POST['cust_name'],
					'cust_contact'=>$_POST['cust_contact'],
					'cust_email'=>$_POST['cust_email'],	
					'cust_location' =>$_POST['cust_location'],
					'cust_status'=>$_POST['cust_status'],
					'cust_details'=>$_POST['cust_details'],
					'user_id'=>$_SESSION['uid'],
					'lead_date'=>$_POST['leadsdate1']		

			
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					
					$cust_name=$_POST['cust_name'];
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		
	  }
	 
	}
	else
	{
		
					$query="update leads set cust_name=:cust_name,cust_contact=:cust_contact,cust_email=:cust_email,cust_location=:cust_location,cust_status=:cust_status,cust_details=:cust_details,user_id=:user_id,lead_date=:lead_date where id=:id";
					$param= array(
					'id' => $_POST['cust_id'],
					'cust_name' =>$_POST['cust_name'],
					'cust_contact'=>$_POST['cust_contact'],
					'cust_email'=>$_POST['cust_email'],	
					'cust_location' =>$_POST['cust_location'],
					'cust_status'=>$_POST['cust_status'],
					'cust_details'=>$_POST['cust_details'],
					'user_id'=>$_SESSION['uid'],
					'lead_date'=>$_POST['leadsdate1']					
				
					); 
					$inserted=$obj->update($query,$param);

					if($inserted) {
						$status = true;
						$id=$_POST['cust_id'];
						$cust_name=$_POST['cust_name'];
                                               
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}
			
		
	}
            $sql = "SELECT * From admin WHERE id='".$_SESSION['uid']."' ";
		$param = array($id);
		$res = $obj->getRows($sql, $param);		
		$response= array();    
$user=""; 
    foreach ($res as $row)
    {         
        $user= $row["name"];
    }
        echo json_encode(array('status' => $status, 'msg' => $msg,'id'=>$id,'cust_name'=>$cust_name,'user'=>$user,'info'=>$_POST['cust_details']));
		
}	
if (isset($_POST['action']) && $_POST['action'] == "leaddatecnt") {

   $cntconfirm=0;$cnthot=0;$cntwarm=0;$cntcold=0;
   	if($_SESSION['usertype']=='ADMIN')
		{
		  $sqlconfirm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Confirm' ";
		
		  $resconfirm = $obj->getRows($sqlconfirm);
		  $cntconfirm=count($resconfirm);

		   $sqlhot = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Hot' ";
		
		  $reshot = $obj->getRows($sqlhot);
		  $cnthot=count($reshot);

		   $sqlwarm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Warm' ";
		
		  $reswarm = $obj->getRows($sqlwarm);
		  $cntwarm=count($reswarm);

		   $sqlcold = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Cold' ";
		
		  $rescold = $obj->getRows($sqlcold);
		  $cntcold=count($rescold);
		   $status=true;

	    }
	if($_SESSION['usertype']=='AGENT')
		{
			$sqlconfirm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Confirm' ";
		
		   	 $resconfirm = $obj->getRows($sqlconfirm);
		 	 $cntconfirm=count($resconfirm);

		 	 $sqlhot = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Hot' ";
		
		   	$reshot = $obj->getRows($sqlhot);
		  	$cnthot=count($reshot);

		 	 $sqlwarm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' aand STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Warm' ";
		
		   	$reswarm = $obj->getRows($sqlwarm);
		  	$cntwarm=count($reswarm);

		 	 $sqlcold = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$_POST['leadsdate']."','%Y-%m') and cust_status='Cold' ";
		
		   	   $rescold = $obj->getRows($sqlcold);
		  		$cntcold=count($rescold);
		  		 $status=true;
	   }
	   $total=$cntconfirm+$cnthot+$cntwarm+$cntcold;
	echo json_encode(array('status' => $status,'cntconfirm'=>$cntconfirm,'cnthot'=>$cnthot,'cntwarm'=>$cntwarm,'cntcold'=>$cntcold,'total'=>$total));

}	
if (isset($_POST['action']) && $_POST['action'] == "leadcnt") {

   $cntconfirm=0;$cnthot=0;$cntwarm=0;$cntcold=0;
   	if($_SESSION['usertype']=='ADMIN')
		{
		  $sqlconfirm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Confirm' ";
		
		  $resconfirm = $obj->getRows($sqlconfirm);
		  $cntconfirm=count($resconfirm);

		   $sqlhot = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Hot' ";
		
		  $reshot = $obj->getRows($sqlhot);
		  $cnthot=count($reshot);

		   $sqlwarm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Warm' ";
		
		  $reswarm = $obj->getRows($sqlwarm);
		  $cntwarm=count($reswarm);

		   $sqlcold = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Cold' ";
		
		  $rescold = $obj->getRows($sqlcold);
		  $cntcold=count($rescold);
		   $status=true;

	    }
	if($_SESSION['usertype']=='AGENT')
		{
			$sqlconfirm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Confirm' ";
		
		   	 $resconfirm = $obj->getRows($sqlconfirm);
		 	 $cntconfirm=count($resconfirm);

		 	 $sqlhot = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Hot' ";
		
		   	$reshot = $obj->getRows($sqlhot);
		  	$cnthot=count($reshot);

		 	 $sqlwarm = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Warm' ";
		
		   	$reswarm = $obj->getRows($sqlwarm);
		  	$cntwarm=count($reswarm);

		 	 $sqlcold = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".date("Y-m")."','%Y-%m') and cust_status='Cold' ";
		
		   	   $rescold = $obj->getRows($sqlcold);
		  		$cntcold=count($rescold);
		  		 $status=true;
	   }
	   $total=$cntconfirm+$cnthot+$cntwarm+$cntcold;
	echo json_encode(array('status' => $status,'cntconfirm'=>$cntconfirm,'cnthot'=>$cnthot,'cntwarm'=>$cntwarm,'cntcold'=>$cntcold,'total'=>$total));

}

if (isset($_POST['action']) && $_POST['action'] == "vouchercnt") {

          $cntconfirm=0;    	
		  $sqlconfirm = "SELECT *  From confirm_voucher";		
		  $resconfirm = $obj->getRows($sqlconfirm);
		  $cntconfirm=count($resconfirm);
		  $status=true;	   
	   	  $total=$cntconfirm;
		  echo json_encode(array('status' => $status,'total'=>$total));

}
if (isset($_POST['action']) && $_POST['action'] == "quotcnt") {

          $cntconfirm=0;    
          	if($_SESSION['usertype']=='ADMIN')
		 {	
		  $sqlconfirm = "SELECT *  From clientdetails";		
		  $resconfirm = $obj->getRows($sqlconfirm);
		  $cntconfirm=count($resconfirm);
		  $status=true;	   
		}
		if($_SESSION['usertype']=='AGENT')
		{
			 $sqlconfirm = "SELECT *  From clientdetails where user_id='".$_SESSION['uid']."'  ";		
		  $resconfirm = $obj->getRows($sqlconfirm);
		  $cntconfirm=count($resconfirm);
		  $status=true;	   
		}
	   	  $total=$cntconfirm;
		  echo json_encode(array('status' => $status,'total'=>$total));

}
if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT * From leads WHERE user_id='".$_SESSION['uid']."' and id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["cust_name"]  = $row["cust_name"];
         $post["cust_contact"]  = $row["cust_contact"];
        $post["cust_email"]  = $row["cust_email"];
		 $post["cust_location"]  = $row["cust_location"];
         $post["cust_status"]  = $row["cust_status"];
        $post["cust_details"]  = $row["cust_details"];
	$post["lead_date"]  = $row["lead_date"];	
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "change") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT * From leads WHERE user_id='".$_SESSION['uid']."' and id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $id  = $row["id"];
        $cust_name= $row["cust_name"];

    }
    $lead="";
    switch($lead_type)
    {
    	case "confirm_lead":$lead="Confirm";break;
        case "hot_lead":$lead="Hot";break;
        case "warm_lead":$lead="Warm";break;
        case "cold_lead":$lead="Cold";break;
            
    }
	 
					$query="update leads set cust_status=:cust_status,user_id=:user_id where id=:id";
					$param= array(
					'id' => $id,					
					'cust_status'=>$lead,					
					'user_id'=>$_SESSION['uid']				
				
					); 
					$inserted=$obj->update($query,$param);
                  
                      if($inserted) {
						$status = true;						
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}
$sql = "SELECT * From admin WHERE id='".$_SESSION['uid']."' ";
		
		$res = $obj->getRows($sql);		
		$response= array();   
$user=""; $info= "";
    foreach ($res as $row)
    {         
        $user= $row["name"];
    }
$sql = "SELECT * From leads WHERE id='".$id."' ";		
		$res = $obj->getRows($sql);		
		$response= array();    
    foreach ($res as $row)
    {         
        $info= $row["cust_details"];
    }
 echo json_encode(array('status' => $status, 'msg' => $msg,'id'=>$id,'cust_name'=>$cust_name,'lead_type'=>$lead,'user'=>$user,'info'=>$info));
		
    }

	
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('leads', 'id', $id);
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