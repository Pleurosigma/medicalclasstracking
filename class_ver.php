<?php
	session_start();
	include('db_connect.php');
	include('TM.php');	
	include("ClassGateway.php");
?>
<html>
<!--
Author: Logan Wilkerson
A page to add the class to the database and verify it back to the user;
Update Nov 7, 2010: grace period stuff added.
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
	if(isset($_SESSION['newclass'])){	
		$resetflag = true;
	}
	else{
		$resetflag = false;
	}
	//Set up db connection and select db
	$con = getConnection();
	selectDB($con);
	
	//Get Post Values
//	include("db_class_functions.php");
	$className = $_POST["classname"];
	$year = $_POST["year"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	$date = $year . "-" . $month . "-" . $day;
	$startHour = $_POST["starttimehr"];
	$startMinute = $_POST["starttimemin"];
	$startAM_PM = $_POST["amstart"];
	
//	Removed to use the TM class	
//	if($startAM != "True"){
//		$startHour = (int)$startHour + 12;
//	}	
//	$startTime = $startHour . ":" . $startMinute;

	$startTime = "$startHour:$startMinute";
	$startTime = TM::changeTo24Hr($startTime, $startAM_PM);
	
	$endHour = $_POST["endtimehr"];
	$endMinute = $_POST["endtimemin"];
	$endAM_PM = $_POST["endam"];

//	Removes to use TM class
//	if($endAM != "True"){
//		$endHour = (int)$endHour + 12;
//	}
//	$endTime = $endHour . ":" . $endMinute;

	$endTime = "$endHour:$endMinute";
	$endTime = TM::changeTo24Hr($endTime, $endAM_PM);
	
	$credits = $_POST["credits"];
	$faculty = $_POST["faculty"];
	$grace = (int)$_POST["grace"];
	
	//Smash the times together
	$startTime = $date . " " . $startTime;
	$endTime = $date . " " . $endTime;
	
	$classCode = "";
	$flag = true;
	while($flag){	
		$classCode = ClassGateway::getClassCode($className);
		$flag = ClassGateway::isClassCodeRedundant($classCode);		
	}
	if($resetflag){		
		echo 'Page refresh detected. I\'m just gonna stop now.</br>';	
	}
	elseif(!ClassGateway::insertClass($classCode, $className, $startTime, $endTime, $credits, $faculty, $grace)){
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
		echo "<th>Standard Grace</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>" . $classCode . "</td>";
		echo "<td>" . $className . "</td>";
		echo "<td>" . $startTime . "</td>";
		echo "<td>" . $endTime . "</td>";
		echo "<td>" . $credits . "</td>";
		echo "<td>" . $faculty . "</td>";
		echo "<td>" . $grace . "</td>";
		echo "</tr>";
		echo "</table>";
		$_SESSION['newclass'] = 'omg';
	}
?>
<form action="add_class.php">
	<input type="submit" value="Back">
</form>
</body>
</html>