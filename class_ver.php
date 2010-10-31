<html>
<!--
Author: Logan Wilkerson, Hanna Palmerton
A page to add the class to the database and verify it back to the user;
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
    <li><a class="active" href="addacourse.html">Administrator</a></li>
</ul>

<div id="content">
    
<?php
	//Set up db connection and select db
	include("db_connect.php");
	$con = getConnection();
	selectDB($con);
	
	//Get Post Values
	include("db_class_functions.php");
	$className = $_POST["classname"];
	$year = $_POST["year"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	$date = $year . "-" . $month . "-" . $day;
	$startHour = $_POST["starttimehr"];
	$startMinute = $_POST["starttimemin"];
	$startAM = $_POST["amstart"];
	if($startAM != "True"){
		$startHour = (int)$startHour + 12;
	}
	$startTime = $startHour . ":" . $startMinute;
	$endHour = $_POST["endtimehr"];
	$endMinute = $_POST["endtimemin"];
	$endAM = $_POST["endam"];
	if($endAM != "True"){
		$endHour = (int)$endHour + 12;
	}
	$endTime = $endHour . ":" . $endMinute;
	$credits = $_POST["credits"];
	$faculty = $_POST["faculty"];
	
	//Smash the times together
	$startTime = $date . " " . $startTime;
	$endTime = $date . " " . $endTime;
	
        //Insert info into table for user to confirm
	$classCode = "";
	$flag = true;
	while($flag){	
		$classCode = getClassCode($className);
		$flag = isClassCodeRedundant($classCode);		
	}
	$insert = getClassInsertQuery($classCode, $className, $startTime, $endTime, $credits, $faculty);
	if(!insertClass($insert)){
		echo 'There was an error.';
	}
	else{
                echo 'Class inserted.<br><br>';
                echo '<table id="studentsched" class="schedule">
                        <th>Code</th><th>Session</th><th>Faculty</th><th>Start time</th><th>End time</th><th>Credit hours</th>
                        <tr><td>' . $classCode . '</td>
                        <td>' . $className . '</td>
                        <td>' . $faculty . '</td>
                        <td>' . $startTime . '</td>
                        <td>' . $endTime . '</td>
                        <td id="schedhours">' . $credits . '</td></tr>
                        </table>';
                echo '<br><form action="add_class.php"><input type="submit" value="Add another course" id="button"></form>
                        <input type="submit" value="Edit this course" id="button">
                        <input type="submit" value="Delete this course" id="button">';
                echo '<div id="dbadd"><form action="courselist.php"><input type="submit" value="RETURN TO COURSELIST" id="addsearchbutton"></form></div>';
        }
?>

</div>

</body>
</html>