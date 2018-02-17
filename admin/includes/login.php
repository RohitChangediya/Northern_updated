<?php  
	require '../../inc/inc.con.php';
	session_start();
	$obj = new db();
	$obj->connect();
	 if(isset($_POST))
	 {
		$sql="select * from user where user_name=:user_name and password=:password";
		$param= array(
			'user_name' => $_POST['user_name'],
			'password' => $_POST['password']	
		); 
		
		$res = $obj->getRows($sql, $param);
		$cnt=count($res);
		if($cnt>0) 
		{

			$_SESSION['uid']=$res[0]['id'];
			$_SESSION['role']="Admin";
			$_SESSION['username']=$res[0]['user_name'];
			$_SESSION['name']=$res[0]['first_name']." ".$res[0]['last_name'];			
			$status = true;
	        $msg = "Login Successful!!!";
			$obj->redirect('../dashboard.php#dashboard');
		}else
		{
			$status = false;
	        $msg = "Invalid Username or Password !!!";
	        $obj->redirect('../index.php?status=invalid&msg='.$msg);
		}
	}
  
?>  