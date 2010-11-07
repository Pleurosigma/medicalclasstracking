<?php
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
	include('TimeVerification.php');
	include('StudentClassGateway.php');
	include('TM.php');
?>
<html>
<head>
	<title>Verify Class </title>
</head>
<body>
	<h2>Verify Student Class</h2>
	<?php
		if(!isset($_POST['classcode'])){
			die('Error: Please return to Login page.');
		}
		selectDB(getConnection());
		$backButton = '
		<form action="add_student_class.php" method="link">
			<input type="submit" value="Back">
		</form>
		';
		
		$classCode = $_POST['classcode'];		
		$class = ClassGateway::selectClassByClassCode(strtoupper($classCode));
		
		if(StudentClassGateway::studentHasClass($_SESSION['onyen'], $classCode)){
			echo '<p> You have already added that class.</p>';
			echo $backButton;
		}
		elseif($class == null){
			echo '<p> No class with that class code found. </p>';
			echo $backButton;
		}
		//If a class was found
		else{
			$_SESSION['class'] = $class;
			$inTime = TimeVerification::checkTime($_SESSION['class']['StartTime'], $_SESSION['class']['EndTime'], $_SESSION['class']['StandardGrace']);
			if(1){
				echo '
					Are you sure you want to sign up for the class ' . $_SESSION['class']['ClassName'] . 
					' on ' . TM::getStandardDateAndTime($_SESSION['class']['StartTime']) . '.
				';
				echo '
					<form name="verify" action="add_student_class.php" method="post">
						<input type="radio" name="add" value="1" checked/> Yes </br>
						<input type="radio" name="add" value="0" /> No </br>
						<input type="submit" value="Enter" /> </br>
					</form>
				';
			}
			//if it is not a valid entry time
			else{
				$className = $_SESSION['class']['ClassName'];
				echo '
				<p> You may not sign up for ' . $className . ' at this time. </p>
				';
				echo $backButton; 
			}
		}
	?>
</body>
</html>