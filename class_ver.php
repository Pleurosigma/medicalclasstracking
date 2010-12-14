<?php
	session_start();
	if(!isset($_SESSION['adminonyen'])){
		header('Location: adminlogin.html');
	}
	include('db_connect.php');
	include('TM.php');	
	include("ClassGateway.php");
?>
<html>
<!--
Author: Logan Wilkerson, Hanna Palmerton
A page to add the class to the database and verify it back to the user;
Update Nov 7, 2010: grace period stuff added.
Update Nov 9, 2010: merge css with new
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
    <li><a class="active" href="class_ver.php">Administrator</a></li>
</ul>

<div id="content">
    
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
        
        //Class name
	$className = $_POST["classname"];
        
        //Class date
	$year = $_POST["year"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	$date = $year . "-" . $month . "-" . $day;
        
        //Class start time
	$startHour = $_POST["starttimehr"];
	$startMinute = $_POST["starttimemin"];
	$startAM_PM = $_POST["amstart"];        
        $startTime = "$startHour:$startMinute";
	$startTime = TM::changeTo24Hr($startTime, $startAM_PM);
        
        //Class end time
	$endHour = $_POST["endtimehr"];
	$endMinute = $_POST["endtimemin"];
	$endAM_PM = $_POST["amend"];
	$endTime = "$endHour:$endMinute";
	$endTime = TM::changeTo24Hr($endTime, $endAM_PM);
        
        //Smash date and time together
	$startTime = $date . " " . $startTime;
	$endTime = $date . " " . $endTime;
        
        //Class credit hours
	$credits = $_POST["credits"];
        
        //Class faculty
	$faculty = $_POST["faculty"];
        
        //Class grace period
        $grace = (int)$_POST["grace"];
        if($grace == 1){ $graceValue = "15 minutes"; }
        else{ $graceValue = "All day"; }
	
        //Insert info into table for user to confirm
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
                echo 'Class inserted.<br><br>';
                echo '<table id="studentsched" class="schedule">
                        <th>Code</th><th>Session</th><th>Faculty</th><th>Start time</th><th>End time</th><th>Standard grace</th><th>Credit hours</th>
                        <tr><td>' . $classCode . '</td>
                        <td>' . $className . '</td>
                        <td>' . $faculty . '</td>
                        <td>' . $startTime . '</td>
                        <td>' . $endTime . '</td>
                        <td>' . $graceValue . '</td>
                        <td id="schedhours">' . $credits . '</td></tr>
                        </table>';
                echo '<br><form action="add_class.php"><input type="submit" value="Add another course" id="button"></form>
                        <input type="submit" value="Edit this course" id="button">
                        <input type="submit" value="Delete this course" id="button">';
                echo '<div id="addsearch"><form action="courselist.php"><input type="submit" value="RETURN TO COURSELIST" id="addsearchbutton"></form></div>';
                $_SESSION['newclass'] = 'omg';
        }
?>

</div>

</body>
</html>