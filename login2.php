<?php
	/**
	Author: Logan Wilkerson
	This is the second page the user will see after loging in
	*/
	
        //Sets the PID in a cookie so it can be remembered
	$pid = $_POST["pid"];
	if($pid != null){
		setcookie("pid", $pid, time() + 3600);
	} 
	else{
		$pid = $_COOKIE["pid"];
	}
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
    <li><a class="active" href="login2.html">Student</a></li>
    <li><a href="adminlogin.html">Administrator</a></li>
</ul>

<div id="content">
	
        <?php	
                include error_reporting(0);
        
		//Connect to database
		$con = mysql_connect("localhost", "root", "");
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test", $con);
		
		//Gets the student, quits if no student found
		$query = "SELECT * FROM students WHERE pid = '" . $pid . "'";
		$result = mysql_query($query);
		if(!($student = mysql_fetch_array($result))){
			die('No student with that PID');
		}
		
		//Checks for class code and adds if verified
		$insert = $_POST['yesno'];
		if($insert == "True"){
			$classCode = $_COOKIE['classCode'];
			$query = "INSERT INTO studentClasses (pid, classCode) VALUES ('" . $pid . "','" . $classCode . "')";
			//echo $query . "</br>";
			$redundantCheck = "SELECT * FROM studentClasses WHERE pid = '" . $pid . "' AND classCode = '" . $classCode . "'";
			$result = mysql_query($redundantCheck);
			if(!($test = mysql_fetch_array($result))){
				mysql_query($query);
			}
		}
		
                //Input box for adding class by class code
                echo '<div id="addsearch"><form action="login3.php" method="post" align="right">
                        <input type="text" id="addsearchtext" name="classCode">&nbsp;<input type="submit" id="addsearchbutton" value="ADD CLASS">
                        </form></div>';
		
		$counter = 0;
		$result = mysql_query("SELECT * FROM studentClasses WHERE pid = '" . $pid . "'");
		while($studentClass= mysql_fetch_array($result)){
			$classCodes[$counter] = $studentClass['classCode'];
			$counter ++;
		}
		$counter = 0;
		foreach ($classCodes as $code){
			$result = mysql_query("SELECT * FROM classes WHERE classCode = '" . $code . "'");
			$classes[$counter] = mysql_fetch_array($result);
			$counter ++;
		}
		
                //Input student information into report table
                $studentName = $student['name'];
		echo '<br><table id="studentsched" class="schedule"><tr><td id="student">' . $studentName . '</td></tr>
                        <th>Session(s) attended</th><th>Faculty</th><th>Date and time</th><th>Credit hours</th>';
		$hours = 0;
		foreach ($classes as $class){
                echo '<tr><td>' . $class['className'] . '</td>
                        <td>' . $class['faculty'] . '</td>
                        <td id="allcaps">' . $class['date'] . ',' . $class['startTime'] . '-' .$class['endTime'] . '</td>';
                $classHours = $class['classHours'];
                echo '<td id="schedhours">' . $classHours . '</td></tr>';
                $hours += $classHours;
		}
                echo '<tr><td id="studschedinvis"></td>
                        <td id="studschedinvis"></td>
                        <td id="studschedvis">Total hours:</td>
                        <td id="studschedvis" style="text-align: right;">' . $hours . '</td></tr>
                        </table>';

		mysql_close($con);
	?>
</div>

</body>
</html>