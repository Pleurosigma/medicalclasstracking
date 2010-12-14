<?php
	/**
	Author: Logan Wilkerson
	ver_addadmin.php
	Actually adds the admin to the database and informs the use it was added
	*/
	session_start();
	include('db_connect.php');
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
    <li><a class="active" href="adminreport.php">Administrator</a></li>
</ul>

<div id="content">

		<?php
			selectDB(getConnection());
			$adminonyen = $_POST['adminonyen'];
			$action = $_POST['action'];
			if($action == 'ADD'){
				if(AdminDBTools::addAdmin(strtolower($adminonyen))){
					echo "<b>$adminonyen</b> has been added as an admininistrator.";
				}else{
					echo 'Admin could not be added. They may already be an admin.';
				}
			}
			elseif($action == 'DELETE'){
				if(AdminDBTools::numberAdmins() == 1){
					echo 'You may not delete the last administrator.';
				}
				elseif(strtolower($_SESSION['adminonyen']) == strtolower($adminonyen)){
					echo 'You may not delete yourself.';
				}
				elseif(AdminDBTools::deleteAdmin($adminonyen)){
					echo "<b>$adminonyen</b> is no longer an administrator.";
				}
			}
		?>		
		<br><br><form action="addadmin.php" method="link"><input type="submit" value="BACK" id="button"></input></form>
</div>

</body>
</html>