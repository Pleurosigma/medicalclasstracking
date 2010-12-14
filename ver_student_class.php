<?php
	/**
	Author: Logan Wilkerson, Hanna Palmerton
	ver_student_class.php 
	Verifies that a students class can be added and checks with the student to see if it
	should be added.
	*/
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
	include('TimeVerification.php');
	include('StudentClassGateway.php');
	include('TM.php');
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
    <li><a class="active" href="ver_student_class.php">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">
    
<?php
        if(!isset($_POST['classcode'])){
                die('Error: Please return to Login page.');
        }
        selectDB(getConnection());
        $backButton = '<br><form action="add_student_class.php" method="link">
                        <input type="submit" value="Back" id="addsearchbutton">
                        </form>';
                        
        $classCode = $_POST['classcode'];		
        $class = ClassGateway::selectClassByClassCode(strtoupper($classCode));
    
        if(StudentClassGateway::studentHasClass($_SESSION['onyen'], $classCode)){
                echo 'You have already added that class.';
                echo $backButton;
        }
        elseif($class == null){
                echo 'No class with that class code found.';
                echo $backButton;
        }
        
        //If a class was found
        else{
                $_SESSION['class'] = $class;
		$studentclass = StudentClassGateway::selectStudentClassesByOnyen($_SESSION['onyen']);
		$overlap = false;
		if($studentclass){
			foreach($studentclass as $c){
				$overlap = $overlap || TimeVerification::timesOverlap($_SESSION['class']['StartTime'], $_SESSION['class']['EndTime'], $c['StartTime'], $c['EndTime']);
			}
		}
		if($overlap){
			echo 'You may not add overlapping classes.';
			echo $backButton;
		}
		else{
			$inTime = TimeVerification::checkTime($_SESSION['class']['StartTime'], $_SESSION['class']['EndTime'], $_SESSION['class']['StandardGrace']);                
			if($inTime){
				echo 'Are you sure you want to add <b>' . $_SESSION['class']['ClassName'] . ' (' . TM::getStandardDateAndTime($_SESSION['class']['StartTime']) . ')</b>?<br>';
				
				echo '<form name="verify" action="add_student_class.php" method="post"><br>
					<input type="radio" name="add" value="1" checked>Yes<br>
					<input type="radio" name="add" value="0">No<br><br>
					<input type="submit" id="addsearchbutton" value="SUBMIT">
					</form>';
			}
			//If it is not a valid entry time
			else{
			    $className = $_SESSION['class']['ClassName'];
			    echo 'You may not sign up for <b>' . $className . '</b> at this time.';
			    echo $backButton; 
			}
		}
        }
?>

</div>

</body>
</html>