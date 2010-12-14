<?php 
	/**
	Author: Logan Wilkerson, Hanna Palmerton
	add_student_class.php
	This class sets up the page for allowing a student to add a class to their
	student list. This class will also add a studentclass to the database if one is found
	*/
	session_start();
	include('db_connect.php');
	include("LDAPHelper.php");
	include('StudentClassGateway.php');
	include('ClassGateway.php');
	include('TM.php');
        include error_reporting(0);
?>
<html>
<head>
<title>Capstone</title>

<link rel="stylesheet" type="text/css" href="default.css">
<script type = "text/javascript" src="validate.js"></script>

</head>

<body>
    
<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a class="active" href="add_student_class.php">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">
    <?php
		if(isset($_POST['onyen'])){
			$onyen = $_POST['onyen'];
			$password = $_POST['password'];
			unset($_SESSION['onyen']);
			unset($_SESSION['name']);
			if(LDAPHelper::authenticate($onyen, $password)){
				$_SESSION['name'] = LDAPHelper::getName($onyen);
				$_SESSION['onyen'] = $onyen;
			}
			else{
				echo 'You were not logged in :(<br />';
			}
		}
		if(!isset($_SESSION['onyen'])){
			echo 'Please return to login page.';
		}
		if(isset($_SESSION['onyen'])){
			selectDB(getConnection());
			//Adds a student class if one is found
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

                echo '<div id="addsearch"><form name="studentClassCodeForm" action="ver_student_class.php" onsubmit="return validate_form( this )" method="post" align="right">
                        <input type="text" name="classcode" title="Class Code" id="addsearchtext">&nbsp;<input type="submit" value="ADD CLASS" id="addsearchbutton"></form>
                        <form action="studentlogout.php" method="link">&nbsp;<input type="submit" value="LOG OUT" id="addsearchbutton">
                        </form></div>';

                $studentClasses = StudentClassGateway::selectStudentClassesByOnyen($_SESSION['onyen']);
                echo '<br>
                <table id="studentsched" class="schedule">
                    <tr><td id="student">' . $_SESSION['name'] . '</td></tr>
                    <th>Session(s) attended</th><th>Faculty</th><th>Date and time</th><th>Credit hours</th>';

                $hours = 0;
                foreach($studentClasses as $sc){
                    $class = ClassGateway::selectClassByClassCode($sc['ClassCode']);
                    $et_split = explode(" ", $class['EndTime']);
                    $newET = TM::getStandardTime($et_split[1]);
                    
                    echo '<tr><td>' . $class['ClassName'] . '</td>
                            <td>' . $class['Faculty'] . '</td>
                            <td>' . TM::getStandardDateAndTime($class['StartTime']) . '-' . $newET . $et_12Hr[1] . '</td>';
                    
                    $classHours = $class['CreditHrs'];
                    echo '<td id="schedhours">' . $classHours . '</td></tr>';
                    $hours += $classHours;
                }
                echo '<tr><td id="studschedinvis"></td>
                        <td id="studschedinvis"></td>
                        <td id="studschedvis">Total hours:</td>
                        <td id="studschedvis" style="text-align: right;">' . $hours . '</td></tr>
                        </table>';
            }
    ?>

</div>

</body>
</html>
