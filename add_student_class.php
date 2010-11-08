<?php 
	/**
	Author: Logan Wilkerson
	add_student_class.php
	This class sets up the page for allowing a student to add a class to their
	student list
	*/
	session_start();
	include('db_connect.php');
	include("LDAPHelper.php");
	include('StudentClassGateway.php');
	include('ClassGateway.php');
	include('TM.php');
?>
<html>
<head>
	<title> Add Class </title>	
	<script type = "text/javascript" src="validate.js"></script>
	
</head>
<body>
	<h2> Add Student Class Page </h2>
	<?php
		if(!isset($_SESSION['onyen'])){
			if(!isset($_POST['onyen'])){
				die("Error: Please return to login page");
			}
			$onyen = $_POST['onyen'];
			$password = $_POST['password'];
			if(LDAPHelper::authenticate($onyen, $password)){
				$_SESSION['name'] = LDAPHelper::getName($onyen);
				$_SESSION['onyen'] = $onyen;
			}
			else{
				echo 'You were not logged in :(';
			}
		}
		if(isset($_SESSION['onyen'])){
			selectDB(getConnection());
			//Adds a class
			if(isset($_SESSION['class'])){
				$add = (int)$_POST['add'];
				if($add){
					if(!StudentClassGateway::insertStudentClass($_SESSION['onyen'], $_SESSION['class']['ClassCode'])){
						unset($_SESSION['class']);
						die('Error: Could not add class!');
					}
					else{
						unset($_SESSION['class']);
					}
				}
			}
			echo 'Welcome ' . $_SESSION['name'] .  '</br></br>';
			echo '
			<form name="studentClassCodeForm" action="ver_student_class.php" onsubmit="return validate_form( this )" method="post">
				Class Code: <input type="text" name="classcode" title="Class Code" />
				<input type="submit" value="Enter">
			</form></br>
			';
			$studentClasses = StudentClassGateway::selectStudentClassesByOnyen($_SESSION['onyen']);
			echo '
			<table border="1" style="border-collapse: collapse;">
				<tr>
				<th>Class Name</th>
				<th>Faculty</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Credits</th>
				</tr>
			';
			foreach($studentClasses as $sc){
				$class = ClassGateway::selectClassByClassCode($sc['ClassCode']);
				$startDay = TM::getDayOfWeek($class['StartTime']);
				$endDay = TM::getDayOfWeek($class['EndTime']);
				$st_split = explode(" ", $class['StartTime']);
				$et_split = explode(" ", $class['EndTime']);
				$st_12Hr = TM::changeTo12Hr($st_split[1]);
				$et_12Hr = TM::changeTo12Hr($et_split[1]);
				echo "
				<tr>
				<td> " . $class['ClassName'] . " </td>
				<td> " . $class['Faculty'] . "</td>
				<td> " . $startDay . ' ' . $st_12Hr[0] . ' ' . $st_12Hr[1] . "</td>
				<td> " . $endDay . ' ' . $et_12Hr[0] . ' ' . $et_12Hr[1] . "</td>
				<td> " . $class['CreditHrs'] . "</td>
				</tr>
				";
			}
			echo '</table>';
		}
	?>
</body>
</html>