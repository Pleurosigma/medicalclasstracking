<?php
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
//	include('StudentClassGateway.php');
//	include('TM.php');
	if(!isset($_POST['action']) || !isset($_SESSION['adminonyen'])){
		//return to admin login
		die('no action or login');
	}	
?>