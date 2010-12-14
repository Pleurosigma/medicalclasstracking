<?php
	/**
	Author: Logan Wilkerosn
	ver_admin_login.php
	Verifies that the admin login is correct and sets up their data in the session.
	*/
	session_start();
	include('db_connect.php');
	include('LDAPHelper.php');
	include('AdminDBTools.php');
	selectDB(getConnection());
	if(!isset($_POST['adminonyen'])){
		die('no login');
	}
	else{
		$onyen = strtolower($_POST['adminonyen']);
		if($onyen == 'root'){
			if(AdminDBTools::isAdmin('root')){
				$_SESSION['adminonyen'] = 'root';
				die('root logged in');
			}
		}
		$password = $_POST['adminpassword'];
		if(LDAPHelper::authenticate($onyen, $password)){
			if(AdminDBTools::isAdmin($onyen)){
				$_SESSION['adminonyen'] = $onyen;
				die('logged in');
			}
			else{
				die('you were not logged in.');
			}
		}
		else{
			die('you were not logged in');
		}
	}
?>