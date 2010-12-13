<?php
	/**
	Author: Logan Wilkerson, Hanna Palmerton
	addconfirmation.html
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
    <li><a class="active" href="addconfirmation.html">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">
    
<?php
        if(!isset($_POST['classcode'])){
                die('Error: Please return to Login page.');
        }
        selectDB(getConnection());
        $backButton = '<br><form action="add_student_class.php" method="link">
                        <input type="submit" value="BACK" id="addsearchbutton">
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
                $inTime = TimeVerification::checkTime($_SESSION['class']['StartTime'], $_SESSION['class']['EndTime'], $_SESSION['class']['StandardGrace']);
                //THIS VALUE SHOULD BE CHANGED TO $inTime when not testing the addition features
                
                if(1){
                        echo 'Are you sure you want to add <b>' . $_SESSION['class']['ClassName'] . '</b>, 
                                on' . TM::getStandardDateAndTime($_SESSION['class']['StartTime']) . ', to your schedule?<br>';
                        
                        echo '<form name="verify" action="add_student_class.php" method="post">
                                <input type="radio" name="add" value="1" checked>Yes<br>
                                <input type="radio" name="add" value="0">No<br>
                                <input type="submit" value="ENTER">
                                </form>';
                }
                //If it is not a valid entry time
                else{
                    $className = $_SESSION['class']['ClassName'];
                    echo 'You may not sign up for <b>' . $className . '</b> at this time.';
                    echo $backButton; 
                }
        }
?>

</div>

</body>
</html>