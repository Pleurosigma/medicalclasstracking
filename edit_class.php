<?php
        session_start();
	include('TM.php');	
	include("ClassGateway.php");
        unset($_SESSION['editedclass']);
?>
<html>
<!--
Author: Logan Wilkerson and Hanna Palmerton
A page to add a class into the database
-->
<head>
<title>Capstone</title>
<script type = "text/javascript"src="validate.js"></script>
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
    <li><a class="active" href="edit_class.php">Administrator</a></li>
</ul>

<div id="content">

<?php

        //Set up db connection and select db
        include("db_connect.php");
        $con = getConnection();
        selectDB($con); 
               
        //Class codes        
        $classCode = $_POST["boxes"];
        $_SESSION['classCode'] = $classCode[0];
        $class = ClassGateway::selectClassByClassCode($_SESSION['classCode']);
    
        //Class times
        $startTime = $class['StartTime'];
        $endTime = $class['EndTime'];
        $startTime = explode(" ", $startTime);
        $endTime = explode(" ", $endTime);
        $startDate = explode("-", $startTime[0]);
        $startTime = TM::changeTo12Hr($startTime[1]);
        $endTime = TM::changeTo12Hr($endTime[1]);
        
        //Class time AM/PM value
        if($startTime[1] == "AM") $checked="checked";
        else $checked2="checked";
        if($endTime[1] == "AM") $checked3="checked";
        else $checked4="checked";
        
        $startTime = explode(":", $startTime[0]);
        $endTime = explode(":", $endTime[0]);
        
        //Class grace value
        if($class['Grace'] == 0) $checked5="checked";
        else $checked6="checked";

echo '<br><br><table id="dbtable">
        <tr><td>EDIT A COURSE</td></tr></table><br>

        <form id="addclassform" name="classForm" action="edit_ver.php" method="post"><br>
        <label>Session:</label><input type="text" name="classname" title="Class Name" value="' . $class['ClassName'] . '"><br>
        <label>Faculty:</label><input type="text" name="faculty" title="Faculty" value="' . $class['Faculty'] . '"><br>
        <label>Date:</label><input class="dateinput" type="text" name="year" title="Year" value="' . $startDate[0] . '">
                            <input class="dateinput" type="text" name="month" title="Month" value="' . $startDate[1] . '">
                            <input class="dateinput" type="text" name="day" title="Day" value="' . $startDate[2] . '"><br>
        <label>Start time:</label><input type="text" class="timeinput" name="starttimehr" title="Start time Hour" value="' . $startTime[0] . '">
                            <input class="timeinput" type="text" name="starttimemin" title="Start Time Minute" value="' . $startTime[1] . '">
                            &nbsp;<input type="radio" name="amstart" value=AM ' . $checked . '> AM
                            &nbsp;&nbsp;<input type="radio" name="amstart" value=PM ' . $checked2 . '> PM<br>
        <label>End time:</label><input type="text" class="timeinput" name="endtimehr" title="End Time Hour" value="' . $endTime[0] . '"> 
                            <input type="text" class="timeinput" name="endtimemin" title="End Time Minute" value="' . $endTime[1] . '">
                            &nbsp;<input type="radio" name="amend" value=AM ' . $checked3 . '> AM
                            &nbsp;&nbsp;<input type="radio" name="amend" value=PM ' . $checked4 . '> PM<br>
        <label>Grace Period:</label><input type="radio" name="grace" title="Day Grace" value="0" ' . $checked5 . '> SAME DAY UNTIL 8PM</input><br>
        <label></label><input type="radio" name="grace" title="Standard Grace" value="1" ' . $checked6 . '> 15 MINUTES</input><br>
        <label>Credit hours:</label><input type="text" name="credits" title="Credits" value="' . $class['CreditHrs'] . '"><br><br>
        <label></label><input type="submit" value="EDIT COURSE" id="addsearchbutton">
        </form>

        <div id="addsearch"><form action="courselist.php"><input type="submit" value="RETURN TO COURSELIST" id="addsearchbutton"></form></div>
        </div>';

?>
</body>
</html>