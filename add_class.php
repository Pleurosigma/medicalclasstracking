<?php
	session_start();
	unset($_SESSION['newclass'])
?>
<html>
<!--
Author: Logan Wilkerson, Hanna Palmerton
A page to add a class into the database
Update Nov 7, 2010: grace period stuff added
Update Nov 9, 2010: merged css with new
-->
<head>
<title>Capstone</title>
<link rel="stylesheet" type="text/css" href="default.css">
<script type = "text/javascript"src="validate.js"></script>
</head>
<body>

<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a href="index.html">Student</a></li>
    <li><a class="active" href="add_class.php">Administrator</a></li>
</ul>

<div id="content">

<br><br><table id="dbtable">
    <tr><td>ADD A COURSE</td></tr></table><br>

<form id="addclassform" name="classForm" action="class_ver.php" onsubmit = 'return validate_form( this )' method="post"><br>
<label>Session:</label><input type="text" name="classname" title="Class Name" value=""><br>
<label>Faculty:</label><input type="text" name="faculty" title="Faculty" value=""><br>
<label>Date:</label><input class="dateinput" type="text" name="year" title="Year" value="yyyy">
                    <input class="dateinput" type="text" name="month" title="Month" value="mm">
                    <input class="dateinput" type="text" name="day" title="Day" value="dd"><br>
<label>Start time:</label><input type="text" class="timeinput" name="starttimehr" title="Start time Hour" value="hh">
                    <input class="timeinput" type="text" name="starttimemin" title="Start Time Minute" value="mm">
                    &nbsp;<input type="radio" name="amstart" value="AM"> AM</input>
                    &nbsp;&nbsp;<input type="radio" name="amstart" value="PM"> PM</input><br>
<label>End time:</label><input type="text" class="timeinput" name="endtimehr" title="End Time Hour" value="hh"> 
                    <input type="text" class="timeinput" name="endtimemin" title="End Time Minute" value="mm">
                    &nbsp;<input type="radio" name="amend" value="AM"> AM</input>
                    &nbsp;&nbsp;<input type="radio" name="amend" value="PM"> PM</input><br>
<label>Grace Period:</label><input type="radio" name="grace" title="Day Grace" value="0" checked> SAME DAY UNTIL 8PM</input><br>
<label></label><input type="radio" name="grace" title="Standard Grace" value="1"> 15 MINUTES</input><br>
<label>Credit hours:</label><input type="text" name="credits" title="Credits"><br><br><br>
<label></label><input type="submit" value="ADD COURSE" id="addsearchbutton">
</form>

<div id="addsearch"><form action="courselist.php"><input type="submit" value="RETURN TO COURSELIST" id="addsearchbutton"></form></div>
        
</div>
</body>
</html>