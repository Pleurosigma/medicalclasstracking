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
	Date: <input type="text" name="year" title="Year" value="yyyy"/> 
		<input type="text" name="month" title="Month" value="mm"/> 
		<input type="text" name="day" title="Day" value="dd" /> </br>
	Start Time: <input type="text" name="starttimehr" title="Start time Hour" value="hh" />
			<input type="text" name="starttimemin" title="Start Time Minute" value="mm" />
		<input type="radio" name="amstart" value=True /> am
		<input type="radio" name="amstart" value=False /> pm</br>
	End Time: <input type="text" name="endtimehr" title="End Time Hour" value = "hh" /> 
			<input type="text" name="endtimemin" title="End Time Minute" value="mm" />
		<input type="radio" name="amend" value=True /> am
		<input type="radio" name="amend" value=False /> pm</br>
	Credits: <input type="text" name="credits" title="Credits" /> </br>
	Faculty: <input type="text" name="faculty" title="Faculty" /> </br>	
	<input type="submit" value="Enter" />
	</form>
</body>
</html>
