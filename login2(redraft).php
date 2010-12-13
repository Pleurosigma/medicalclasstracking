<?php
	/*
	Authors: Logan Wilkerson (PHP), Hanna Palmerton (HTML, CSS)
	This is the second page the user will see after logging in
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
        <link rel="stylesheet" type="text/css" href="default.css">
        </head>
	<body>
	<?php	
		//Connect to database
		$con = mysql_connect("localhost", "root");
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test", $con);
		
		//Gets the student, quits if no student found
		$query = "SELECT * FROM studentInfo WHERE pID = '" . $pid . "'";
		$result = mysql_query($query);
		if(!($student = mysql_fetch_array($result))){
			die('No student with that PID');
		}
		
                //Page layout
                echo '<table id="header">
                    <tr valign="top"><td><img src="somLogo.gif" height="50px"></td></tr>
                </table>

                <ul id="tabmenu">
                    <li><a class="active" href="mainindex.html">Student</a></li>
                    <li><a href="testheader2-more.html">Administrator</a></li>
                </ul>';
                
                //Add class form
                echo '<div id="content">
                <div id="addclass"><form action="login3.php" method="post" align="right"><input type="text" name="classCode" id="addclasstext">&nbsp;<input type="submit" value="ADD CLASS" id="addclassbutton"></form></div>

                <br>';
                
                //Checks for class code and adds if verified
		$insert = $_POST['yesno'];
		if($insert == "True"){
			$classCode = $_COOKIE['classCode'];
			$query = "INSERT INTO studentSched (pID, classCode) VALUES ('" . $pid . "','" . $classCode . "')";
			//echo $query . "</br>";
			$redundantCheck = "SELECT * FROM studentSched WHERE pID = '" . $pid . "' AND classCode = '" . $classCode . "'";
			$result = mysql_query($redundantCheck);
			if(!($test = mysql_fetch_array($result))){
				mysql_query($query);
			}
		}
		
		$counter = 0;
		$result = mysql_query("SELECT * FROM studentSched WHERE pID = '" . $pid . "'");
		while($studentClass = mysql_fetch_array($result)){
			$classes[$counter] = $studentClass['classCode'];
			$counter ++;
		}
		$counter = 0;
		foreach ($classes as $code){
			$result = mysql_query("SELECT * FROM studentClasses WHERE classCode = '" . $code . "'");
			$classes[$counter] = mysql_fetch_array($result);
			$counter ++;
		}
                
                //Student schedule
		$studentName = $student['fullName'];
		
		echo '<table id="studentsched" class="schedule">
                    <tr><td id="student">' . $studentName . '</td></tr>
                    <th>Session(s) attended</th><th>Faculty</th><th>Date and time</th><th>Credit hours</th>';
                    
                //Fills the schedule with known classes, totals number of hours
		$hours = 0;
		foreach ($classes as $class){
			echo '<tr>';
			echo '<td>' . $class['className'] . '</td>';
                        echo '<td>' . $class['facultyLeader'] . '</td>';
                        echo '<td>' . $class['date'] . ', ' . $class['day'] . ' ' . $class['time'] . '</td>';
			$classHours = $class['creditHours'];
			echo '<td id="shedhours">' . $classHours . "</td>";
			echo '</tr>';
			$hours += $classHours;
		}
		
                //Total hours
                echo '<tr>
                    <td id="studschedinvis"></td>
                    <td id="studschedinvis"></td>
                    <td id="studschedvis">Total hours:</td>
                    <td id="studschedvis" style="text-align: right;">' . $hours . '</td>
                </tr>
                </table>

                </div>';

		mysql_close($con);
			
	?>
	</body>
</html>