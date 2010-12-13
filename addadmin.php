<?php
	/**
	Author: Logan Wilkerson
	addadmin.php
	Allows entering and deleting an admin
	*/
	session_start();
	include('db_connect.php');
	if(!isset($_SESSION['adminonyen'])){
		//return to admin login
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<script type = "text/javascript" src="validate.js"></script>
		<title> Add Admin</title>
	</head>
	<body>
		<form action = "ver_addadmin.php" onsubmit="return validate_form( this )" method="post" />
			Admin Onyen: <input type="text" name="adminonyen" title="Admin Onyen"/> <br />
			<input type="submit" name="action" value="Add" />
			<input type="submit" name="action" value="Delete" />
		</form>
		
		<form action="admintools.php" method="link">
			<input type="submit" value="Back">
		</form>
		NOTE: If this is the first admin you are adding the root name will be deleted. 
		It will no longer work after you log out.
	</body>
</html>
