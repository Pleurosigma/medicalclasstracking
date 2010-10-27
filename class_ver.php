<html>
<!--
Author: Logan Wilkerson
A page to add the class to the database and verify it back to the user;
-->
<head>
<style type = "text/css">
	table {
	border: 0px solid;
	border-collapse: collapse;
	width: 100%;
	text-align: center;
	}
	
	th {
	border: 1px solid;
	}
	
	td {
	border: 1px solid;
	}
</style>
</head>
<body>
<h3>Class Entry Verification</h3>
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
	
	$classCode = "";
	$flag = true;
	while($flag){	
		$classCode = getClassCode($className);
		$flag = isClassCodeRedundant($classCode);		
	}
	$insert = getClassInsertQuery($classCode, $className, $startTime, $endTime, $credits, $faculty);
	if(!insertClass($insert)){
		echo "There was an error.";
	}
	else{
		echo "Class Inserted </br>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Class Code</th>";
		echo "<th>Class Name</th>";
		echo "<th>Start Time</th>";
		echo "<th>End Time</th>";
		echo "<th>Credits</th>";
		echo "<th>Faculty</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>" . $classCode . "</td>";
		echo "<td>" . $className . "</td>";
		echo "<td>" . $startTime . "</td>";
		echo "<td>" . $endTime . "</td>";
		echo "<td>" . $credits . "</td>";
		echo "<td>" . $faculty . "</td>";
		echo "</tr>";
		echo "</table>";
	}
?>
<form action="add_class.php">
	<input type="submit" value="Back">
</form>
</body>
</html>