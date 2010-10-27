<html>
<!--
Author: Logan Wilkerson
A page to add a class into the database
-->
<head>
	<script type = "text/javascript"src="validate.js"></script>
</head>
<body>
	<h2>Add Class Page</h2>
	<form name="classForm" action="class_ver.php" onsubmit = 'return validate_form( this )' method="post">
	Class Name: <input type="text" name="classname" title="Class Name" /> </br>
	Date (yyyy-mm-dd): <input type="text" name="date" title="Class Date" /> </br>
	Start Time (hh:mm): <input type="text" name="starttime" title="Start time" /> </br>
	End Time (hh:mm): <input type="text" name="endtime" title="End Time" /> </br>
	Credits: <input type="text" name="credits" title="Credits" /> </br>
	Faculty: <input type="text" name="faculty" title="Faculty" /> </br>	
	<input type="submit" value="Enter" />
	</form>
</body>
</html>
