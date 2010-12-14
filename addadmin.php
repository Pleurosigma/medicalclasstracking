<?php
	/**
	Author: Logan Wilkerson
	addadmin.php
	Allows entering and deleting an admin
	*/
	session_start();
	include('db_connect.php');
	if(!isset($_SESSION['adminonyen'])){
		header('Location: adminlogin.html');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>

<head>
<title>Capstone</title>
<meta http-equiv="Content-Type" content="text/html">
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
    <li><a class="active" href="index.html">Student</a></li>
    <li><a href="addadmin.php">Administrator</a></li>
</ul>

<div id="content">

<br><br><table id="dbtable"><tr><td>ADD/DELETE AN ADMINISTRATOR</td></tr></table><br><br>
        
<form action="ver_addadmin.php" onsubmit="return validate_form( this )" id="" method="post">
<label>Admin Onyen: </label><input type="text" name="adminonyen" title="Admin Onyen">
<input type="submit" name="action" value="ADD" id="button"><input type="submit" name="action" value="DELETE" id="button">
</form>

<br><br><label></label><i>If this is the first admininstrator you are adding, the root name will thus be deleted. It will no longer work after you log out.</i>

<div id="addsearch"><form action="admintools.php" method="link"><input type="submit" value="RETURN TO ADMIN HOME" id="addsearchbutton"></form></div>

</div>

</body>
</html>
