<?php
	$classCode = $_POST['classCode'];
	setcookie("classCode", $classCode, time() + 3600);
?>
<html>
	<body>
		<?php
			echo "TESTING </br>";
			$pid = $_COOKIE['pid'];
			if($pid == null || $classCode == null){
				die("PID or ClassCode null");
			}
			
			$con = mysql_connect("localhost", "root", "!mrfrosty0");
			if(!$con){
				die('Lost database connection: ' . mysql_error());
			}
			mysql_select_db("test", $con);
			
			$query = "SELECT * FROM classes WHERE classCode = '" . $classCode . "'";
			$result = mysql_query($query);
			if(!($class = mysql_fetch_array($result))){
				die('No class with this class id');
			}
			echo "Are you sure you want to enter this class? </br>";
			echo $class['className'];
			echo "<form action = \"login2.php\" method = \"post\">";
			echo "<input type = \"radio\" name = \"yesno\" value = True /> Yes </br>";
			echo "<input type = \"radio\" name = \"yesno\" value = False checked/> No</br>";
			echo "<input type = \"submit\"value = \"Enter\" />";
			echo "</form>";
		?>
	</body>
</html>