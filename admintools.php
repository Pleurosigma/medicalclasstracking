<?php
	session_start();
	include('db_connect.php');
        include("LDAPHelper.php");
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
    <li><a class="active" href="admintools.php">Administrator</a></li>
</ul>

<div id="content">

<?php

if(!isset($_SESSION['adminonyen'])){
	echo 'You were not logged in. <br>';
	echo '<br><form action="adminlogin.html" method="link"><input type="submit" value="BACK"></form>';
	die();
}

$adminonyen = $_SESSION['adminonyen'];
$adminname = LDAPHelper::getName($adminonyen);

echo '<div id="addsearch">
        <form action="adminlogout.php" method="link">&nbsp;<input type="submit" value="LOG OUT" id="addsearchbutton">
        </form></div>
        
        <br><br><table id="dbtable"><tr><td>' . $adminname . '</td>
                <td style="text-align: right; font-weight: normal;"><i>Please be sure to log out after each visit to ensure your security for admin functionality.</i></td>
                </tr></table><br><br>
        
        <form action="adminreport.php" method="link"><input type="submit" value="ADMIN REPORT" id="button"></input></form><br><br>
        <form action="courselist.php" method="link"><input type="submit" value="CLASS COURSELIST" id="button"></input></form><br><br>
        <form action="addadmin.php" method="link"><input type="submit" value="ADD/DELETE ADMINISTRATOR(S)" id="button"></input></form><br><br>
        <form action="resettool.php" method="link"><input type="submit" value="FULL RESET" id="button"></input></form>';
?>

</div>

</body>
</html>