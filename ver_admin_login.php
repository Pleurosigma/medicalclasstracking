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
?>

<html>
<head>
<title>Capstone</title>

<link rel="stylesheet" type="text/css" href="default.css">
<script type = "text/javascript" src="validate.js"></script>

</head>
<body>

<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a href="index.html">Student</a></li>
    <li><a class="active" href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">

<?php
	selectDB(getConnection());
	if(!isset($_POST['adminonyen'])){
		die('No login.');
	}
	else{
		$onyen = strtolower($_POST['adminonyen']);
		if($onyen == 'root'){
			if(AdminDBTools::isAdmin('root')){
				$_SESSION['adminonyen'] = 'root';
				die('Root logged in.');
			}
		}
		$password = $_POST['adminpassword'];
		if(LDAPHelper::authenticate($onyen, $password)){
			if(AdminDBTools::isAdmin($onyen)){
				$_SESSION['adminonyen'] = $onyen;
				die('Logged in.');
			}
			else{
				die('You were not logged in.');
			}
		}
		else{
			die('You were not logged in.');
		}
	}
?>

</div>

</body>
</html>