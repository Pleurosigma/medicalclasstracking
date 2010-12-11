<?php
	/**
	Author: Logan Wilkerson
	This is the class varification page
	*/
	$classCode = $_POST['classCode'];
	setcookie("classCode", $classCode, time() + 3600);
?>
<html>
<head>
<title>Capstone</title>
<link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>

<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a class="active" href="login3.html">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">

		<?php
			echo '<table id="dbtable">
                                <tr><td>ADD A COURSE</td></tr></table>';
			$pid = $_COOKIE['pid'];
			if($pid == null || $classCode == null){
				die("PID or ClassCode null");
			}
			
			$con = mysql_connect("localhost", "root", "");
			if(!$con){
				die('Lost database connection: ' . mysql_error());
			}
			mysql_select_db("test", $con);
			
			$query = "SELECT * FROM classes WHERE classCode = '" . $classCode . "'";
			$result = mysql_query($query);
			if(!($class = mysql_fetch_array($result))){
				die('No class with this class id');
			}
                        echo '<br>Are you sure you want to add <b>'. $class['className'] . '</b> to your schedule?<br>
                                <form action="login2.php" method="post"><input type="radio" name="yesno" value="true">Yes</input>
                                &nbsp;<input type="radio" name="yesno" value="false checked">No</input><br>
                                <input type="submit" id="addsearchbutton" value="ENTER">
                                </form>';
		?>
</div>

</body>
</html>