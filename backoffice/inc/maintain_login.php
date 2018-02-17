<?php  
session_start();
require 'inc.con.php';
	$obj = new db();
	$obj->connect();

if($_POST['action']=="login")
{      if($_POST['loginas']=='A')
         {
	$sql="select * from admin where username =:username and password=:password";
	$param= array(
'username' => $_POST['username'],
'password' => $_POST['password']
); 
	$res = $obj->getRows($sql, $param);
	$cnt=count($res);
	$uid=0;
	foreach($res as $row)//foreach loop  
	{  
		
		$_SESSION['uid']=$row['id'];
		$_SESSION['usertype']=$row['usertype'];
		$_SESSION['username']=$row['username'];
	}

	 if($cnt>0) {
             $sql4 = "DELETE FROM blockroom  Where  createat <= now() - INTERVAL 1 DAY and status='BLOCK' ";
	$isDeleted = $obj->customdelete($sql4);
            $status = true;
            $msg = "Login Successful!!!";
        } else {
            $status = false;
            $msg = "Invalid Username or Password !!!";
        }
     }
      else if($_POST['loginas']=='H') 
         {
	$sql="select * from hotels where username =:username and password=:password";
	$param= array(
'username' => $_POST['username'],
'password' => $_POST['password']
); 
	$res = $obj->getRows($sql, $param);
	$cnt=count($res);
	$uid=0;
	foreach($res as $row)//foreach loop  
	{  
		
		$_SESSION['uid']=$row['hotel_id'];
		$_SESSION['usertype']="HOTEL";
		$_SESSION['username']=$row['username'];
	}

	 if($cnt>0) {

        $sql4 = "DELETE FROM blockroom  Where  createat <= now() - INTERVAL 1 DAY and status='BLOCK' ";
	$isDeleted = $obj->customdelete($sql4);
		
            $status = true;
            $msg = "Login Successful!!!";
        } else {
            $status = false;
            $msg = "Invalid Username or Password !!!";
        }
     }
     else if($_POST['loginas']=='C') 
         {
	$sql="select * from confirm_voucher where voucher_id =:username and secret_key=:password";
	$param= array(
'username' => $_POST['username'],
'password' => $_POST['password']
); 
	$res = $obj->getRows($sql, $param);
	$cnt=count($res);
	$uid=0;
	foreach($res as $row)//foreach loop  
	{  
		
		$_SESSION['uid']=$row['voucher_id'];
		$_SESSION['usertype']="USER";
		$_SESSION['username']="USER";
	}

	 if($cnt>0) {

       /* $sql4 = "DELETE FROM blockroom  Where  createat <= now() - INTERVAL 1 DAY and status='BLOCK' ";
	$isDeleted = $obj->customdelete($sql4);*/
		
            $status = true;
            $msg = "Login Successful!!!";
        } else {
            $status = false;
            $msg = "Invalid Username or Password !!!";
        }
     }
        echo json_encode(array('status' => $status, 'msg' => $msg));
}
  
?>  