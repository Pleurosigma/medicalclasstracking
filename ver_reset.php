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
		header('Location: adminlogin.html');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
        <title>Capstone</title>
        <meta http-equiv="Content-Type" content="text/html" />
        <link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>
    
<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a href="index.html">Student</a></li>
    <li><a class="active" href="resettool.php">Administrator</a></li>
</ul>

<div id="content">

		<?php
			$onyen = strtolower($_POST['adminonyen']);
			$password = $_POST['adminpassword'];
			selectDB(getConnection());
                        $backButton = '<br><br><form action="resettool.php" method="link">
			<input type="submit" value="BACK">
			</form>';
			if($_SESSION['adminonyen'] != $onyen){
				die('Please log in with your own information if you wish to reset the website.' . $backButton);
			}
			if(LDAPHelper::authenticate($onyen, $password) && AdminDBTools::isAdmin($onyen)){
				if(AdminDBTools::clearAll()){
					echo 'Reset Complete';
					unset($_SESSION['adminonyen']);
				}
				else
					echo 'Reset Failed' . $backButton;
			}
			else{
				die('Incorrect login and password.' . $backButton);
			}
		?>
</div>

</body>
</html>