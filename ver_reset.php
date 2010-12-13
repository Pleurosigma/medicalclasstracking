<?php
	/**
	Author: Logan Wilkerson
	This page checks to make sure the admin stuff was correct. And if so preforms the reset.
	*/
	session_start();
	include('db_connect.php');
	include('LDAPHelper.php');
	include('AdminDBTools.php');
	if(!isset($_SESSION['adminonyen']) || !isset($_POST['adminonyen'])){
		//return to admin login
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<title> FULL RESET</title>
	</head>
	<body>
		<?php
			$onyen = strtolower($_POST['adminonyen']);
			$password = $_POST['adminpassword'];
			selectDB(getConnection());
			if($_SESSION['adminonyen'] != $onyen){
				die('Please log in with your own information.');
			}
			if(LDAPHelper::authenticate($onyen, $password) && AdminDBTools::isAdmin($onyen)){
				if(AdminDBTools::clearAll())
					echo 'Reset Complete';
				else
					echo 'Reset Failed';
			}
			else{
				die('Incorrect login and password.');
			}
		?>
	</body>
</html>