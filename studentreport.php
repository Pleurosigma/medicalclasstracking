<?php 
	/**
	Author: Logan Wilkerson, Hanna Palmerton
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
    <li><a class="active" href="studentreport.html">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">

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

                echo '<div id="addsearch"><form name="studentClassCodeForm" action="ver_student_class.php" onsubmit="return validate_form( this )" method="post" align="right">
                        <input type="text" name="classcode" title="Class Code" id="addsearchtext">&nbsp;<input type="submit" value="ADD CLASS" id="addsearchbutton">
                        </form></div>';

                $studentClasses = StudentClassGateway::selectStudentClassesByOnyen($_SESSION['onyen']);
                echo '<br>
                <table id="studentsched" class="schedule">
                    <tr><td id="student">' . $_SESSION['name'] . '</td></tr>
                    <th>Session(s) attended</th><th>Faculty</th><th>Start time</th><th>End time</th><th>Credit hours</th>';

                foreach($studentClasses as $sc){
                    $class = ClassGateway::selectClassByClassCode($sc['ClassCode']);
                    $startDay = TM::getDayOfWeek($class['StartTime']);
                    $endDay = TM::getDayOfWeek($class['EndTime']);
                    $st_split = explode(" ", $class['StartTime']);
                    $et_split = explode(" ", $class['EndTime']);
                    $st_12Hr = TM::changeTo12Hr($st_split[1]);
                    $et_12Hr = TM::changeTo12Hr($et_split[1]);
                    
                    echo '<tr><td>' . $class['ClassName'] . '</td>
                            <td>' . $class['Faculty'] . '</td>
                            <td id="allcaps">' . $startDay . ' ' . $st_12Hr[0] . ' ' . $st_12Hr[1] . '</td>
                            <td id="allcaps">' . $endDay . ' ' . $et_12Hr[0] . ' ' . $et_12Hr[1] . '</td>';
                    
                    $classHours = $class['CreditHrs'];
                    echo '<td id="schedhours">' . $classHours . '</td></tr>';
                    $hours += $classHours;
                }
                echo '<tr><td id="studschedinvis"></td>
                        <td id="studschedinvis"></td>
                        <td id="studschedvis">Total hours:</td>
                        <td id="studschedvis" style="text-align: right;">' . $hours . '</td></tr>
                        </table>';
?>

</div>

</body>
</html>