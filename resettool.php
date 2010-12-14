<?php
	/**
	Author: Logan Wilkerson
	resettool.php
	Checks to make sure that the user wants to reset everything.
	*/
	session_start();
	if(!isset($_SESSION['adminonyen'])){
		//return to login page
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<script type = "text/javascript" src="validate.js"></script>
		<title> FULL RESET</title>
	</head>
	<body>
		If you are sure you want to reset every place enter your admin login and password below and press Reset.
		<form action="ver_reset.php" onsubmit="return validate_form( this )" method="post" />
			Admin Onyen: <input type="text" name="adminonyen" title="Admin Onyen" /> <br />
			Password: <input type="password" name="adminpassword" title="Password" /> <br />
			<input type="submit" value="Reset" />
		</form>
		
		<form action="admintools.php" method="link">
			<input type="submit" value="Back">
		</form>
	</body>
</html>
