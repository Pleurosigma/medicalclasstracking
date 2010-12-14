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
    <li><a href="resettool.php">Administrator</a></li>
</ul>

<div id="content">

<br><br><table id="dbtable"><tr><td>RESET ALL</td></tr></table><br>

<label><b>Warning</b></label><br><br>

<form action="ver_reset.php" onsubmit="return validate_form( this )" method="post">
<label>Admin Onyen: </label><input type="text" name="adminonyen" title="Admin Onyen"><br>
<label>Password: </label><input type="password" name="adminpassword" title="Password"> <input type="submit" value="RESET" id="button">
</form><br><br>

<label></label>If you are sure you want to <b>reset all the information within the site</b>, enter your admin login and password below and press RESET.
            
<div id="addsearch"><form action="admintools.php" method="link"><input type="submit" value="RETURN TO ADMIN HOME" id="addsearchbutton"></form></div>

</div>

</body>
</html>
