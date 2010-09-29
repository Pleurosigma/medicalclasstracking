<?php
	//sets the PID in a cookie so it can be remembered
	$pid = $_POST["pid"];
	if($pid != null){
		setcookie("pid", $pid, time() + 3600);
	} 
	else{
		$pid = $_COOKIE["pid"];
	}
?>
<html>
	<body>
	<?php	
		//Connect to database
		$con = mysql_connect("localhost", "root", "!mrfrosty0");
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
		
		//Checks for class code and adds if varafied
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
		
		$studentName = $student['name'];
		echo "Student Name: " . $studentName . "</br></br>";
		echo "<form action = \"login3.php\" method = \"post\">";
		echo "Class Code: <input type = \"text\" name = \"classCode\" />";
		echo "<input type = \"submit\" value = \"Enter\" />";
		echo "</form>";
		
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
		
		echo "<table border = '1'>
		<tr>
			<th>Class Name</th>
			<th>Credit Hours</th>
		</tr>";
		$hours = 0;
		foreach ($classes as $class){
			echo "<tr>";
			echo "<td>" . $class['className'] . "</td>";
			$classHours = $class['classHours'];
			echo "<td>" . $classHours . "</td>";
			echo "</tr>";
			$hours += $classHours;
		}
		
		echo "<tr>
			<td>Total Hours:</td>";
		echo "<td>" . $hours . "</td>";
		echo "</tr>";
		echo "</table>";

		mysql_close($con);
			
	?>
	</body>
</html>