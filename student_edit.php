<?php
	/**
	Author: Logan Wilkerson
	student_edit.php
	Edits a student classes data and then tells the admin what was changed.
	*/
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
	include('StudentClassGateway.php');
	include('TM.php');
	if(!isset($_POST['action']) || !isset($_SESSION['adminonyen'])){
		//return to admin login
		//die('no action or login');
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
        <title>Capstone</title>
        <meta http-equiv="Content-Type" content="text/html" />
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
    <li><a class="active" href="adminreport.php">Administrator</a></li>
</ul>

<div id="content">

		<?php
			selectDB(getConnection());
			
                        $backButton = '<br><br><form action="adminreport.php" method="link"><input type="submit" value="BACK" id="button"></form>';
			
                        $classCode = $_POST['classcode'];
			$onyen = $_POST['onyen'];
			$action = $_POST['action'];
			$class = ClassGateway::selectClassByClassCode(strtoupper($classCode));
			
                        echo '<br><br>';
                        
                        if($action == 'ADD'){
				if(!$class){
					echo 'No class with that class code found.';
					echo $backButton;
				}
				elseif(StudentClassGateway::studentHasClass($onyen, $classCode)){
					echo 'The student already has this class';
					echo $backButton;
				}
				else{
					if(StudentClassGateway::insertStudentClass($onyen, $classCode)){
						echo $class['ClassName'] . '(' . TM::getStandardDateAndTime($class['StartTime']) .') was added for ' . $onyen;
						echo $backButton;						
					}
					else{
						echo 'The class could not be added';
						echo $backButton;
					}
				}
			}
			else{
				if(!$class){
					echo 'No class with that class code found.';
					echo $backButton;
				}
				elseif(!StudentClassGateway::studentHasClass($onyen, $classCode)){
					echo 'The student is not in this class';
					echo $backButton;
				}
				else{
					if(StudentClassGateway::deleteStudentClass($onyen, $classCode)){
						echo $class['ClassName'] . '(' . TM::getStandardDateAndTime($class['StartTime']) .') was removed for ' . $onyen;
						echo $backButton;
					}
				}
			}
		?>
                
</div>

</body>
</html>