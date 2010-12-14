<?php
	session_start();
	include('db_connect.php');
	include('LDAPHelper.php');
	include('AdminDBTools.php');
        
        /**
	Author: Logan Wilkerosn
	ver_admin_login.php
	Verifies that the admin login is correct and sets up their data in the session.
	*/
	selectDB(getConnection());
	if(!isset($_POST['adminonyen'])){
		header('Location: admintools.php');
	}
	else{
		$onyen = strtolower($_POST['adminonyen']);
		if($onyen == 'root'){
			if(AdminDBTools::isAdmin('root')){
				$_SESSION['adminonyen'] = 'root';
				header('Location: admintools.php');
			}
		}
		$password = $_POST['adminpassword'];
		if(LDAPHelper::authenticate($onyen, $password)){
			if(AdminDBTools::isAdmin($onyen)){
				$_SESSION['adminonyen'] = $onyen;
				header('Location: admintools.php');
			}
			else{
				header('Location: admintools.php');
			}
		}
		else{
			header('Location: admintools.php');
		}
	}
	
?>