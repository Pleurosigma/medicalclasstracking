<?php
	/**
	Author: Logan Wilkerson
	student_edit.php
	Edits a student classes data and then tells the admin what was changed.
	*/
	session_start();
	include('db_connect.php');
	include('LDAPHelper.php');
	include('ClassGateway.php');
	include('StudentClassGateway.php');
	include('TM.php');
	if(!isset($_POST['action']) || !isset($_SESSION['adminonyen'])){
		header('Location: adminlogin.html');
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
			$backButton = '<br><br><form action="adminreport.php" method="link">
			<input type="submit" value="BACK" id="button">
			</form>';
			$classCode = strtoupper($_POST['classcode']);
			$onyen = $_POST['onyen'];
			$action = $_POST['action'];
                        
			$class = ClassGateway::selectClassByClassCode($classCode);
			if($class == false){
				echo 'No class with that class code found.';
				echo $backButton;
			}
			elseif(!LDAPHelper::getName($onyen)){
				echo 'That is not an onyen.';
				echo $backButton;
			}
			else{
				if($action == 'ADD'){
					if(StudentClassGateway::studentHasClass($onyen, $classCode)){
						echo 'The student already has this class';
						echo $backButton;
					}
					else{
						if(StudentClassGateway::insertStudentClass($onyen, $classCode)){
							echo '<b>' . $class['ClassName'] . ' (' . TM::getStandardDateAndTime($class['StartTime']) .')<b> was added for <b>' . $onyen . '<b>.';
							echo $backButton;						
						}
						else{
							echo 'This class could not be added';
							echo $backButton;
						}
					}
				}
				else{
					if(!StudentClassGateway::studentHasClass($onyen, $classCode)){
						echo 'The student is not in this class';
						echo $backButton;
					}
					else{
						if(StudentClassGateway::deleteStudentClass($onyen, $classCode)){
							echo '<b>' . $class['ClassName'] . ' (' . TM::getStandardDateAndTime($class['StartTime']) .')</b> was removed for <b>' . $onyen . '<b>';
							echo $backButton;
						}
					}
				}
			}
		?>
                
</div>

</body>
</html>