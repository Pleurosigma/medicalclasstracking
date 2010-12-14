<?php
        session_start();
	include('TM.php');	
	include("ClassGateway.php");
	if(!isset($_POST['boxes'])){
		header('Location: courselist.php');
	}
	if(!isset($_SESSION['adminonyen'])){
		header('Location: adminlogin.html');
	}
?>
<html>
<!--
Author: Hanna Palmerton, Logan Wilkerson
A page to delete the class from the database;
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
        //Set up db connection and select db
        include("db_connect.php");
        $con = getConnection();
        selectDB($con); 
        
        //Class code
        $_SESSION['classCodes'] = $_POST['boxes'];
        
        echo 'Are you sure you want to delete these courses?';
        echo '<br><br><table id="studentsched" class="schedule">
                <tr><th>Code</th><th>Session</th><th>Faculty</th><th>Date</th><th>Day</th><th>Start time</th><th>End time</th><th>Standard grace</th><th>Credit hours</th></tr>';
        
        foreach($_SESSION['classCodes'] as $code) {
            $class = ClassGateway::selectClassByClassCode($code);
                    
            echo '<tr><td>' . $class['ClassCode'] . '</td>
                    <td>' . $class['ClassName'] . '</td>
                    <td>' . $class['Faculty'] . '</td>';
                    
            //Split date from StartTime, EndTime
            $startTime = $class['StartTime'];
            $endTime = $class['EndTime'];
            $date = substr($startTime, 0, 10);
            
            //Define times
            $st_split = explode(" ", $startTime);
            $et_split = explode(" ", $endTime);
            $st_12Hr = TM::changeTo12Hr($st_split[1]);
            $et_12Hr = TM::changeTo12Hr($et_split[1]);
                    
            //Define day of week
            $weekDay = TM::getDayOfWeek($startTime);
            
            //Grace period
            $grace = $class['Grace'];
            if($grace == 1){ $graceValue = "15 minutes"; }
            else{ $graceValue = "All day"; }
            
            echo '<td>' . $date . '</td>
                    <td>' . $weekDay . '</td>
                    <td>' . $st_12Hr[0] . ' ' . $st_12Hr[1] . '</td>
                    <td>' . $et_12Hr[0] . ' ' . $et_12Hr[1] . '</td>
                    <td>' . $graceValue . '</td>
                    <td id="schedhours">' . (int)$class['CreditHrs'] . '</td></tr>';
        }
        echo '</table>';
        echo '<br><form name="verify" action="delete_class_script.php" method="post">
                <input type="radio" name="delete" value="1">Yes<br>
                <input type="radio" name="delete" value="0" checked>No<br><br>
                <input type="submit" id="addsearchbutton" value="SUBMIT">
                </form>';
?>

</div>

</body>
</html>