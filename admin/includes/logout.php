<?php
	session_start();
	require '../../inc/inc.con.php';
	$obj = new db();
	if(!empty($_SESSION))
	{
		$user_role=$_SESSION['role'];
		$_SESSION=array();
		session_destroy();
	}
	$obj->redirect('../');
?>