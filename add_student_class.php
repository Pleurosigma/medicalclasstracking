<html>
<head>
	<title> Add Class </title>	
	<script type = "text/javascript" src="validate.js"></script>
	<?php 
		session_start();
		include("LDAPHelper.php");
	?>
	
</head>
<body>
	<h2> Add Student Class Page </h2>
	<?php
		$onyen = $_POST['onyen'];
		$password = $_POST['password'];
		$authenticate = LDAPHelper::authenticate($onyen, $password);
		if($authenticate){
			$name = LDAPHelper::getName($onyen);
			$_SESSION['name'] = $name;
			echo 'Welcome ' . $name . '</br></br>';
			echo '
			<form name="studentClassCodeForm" onsubmit="return validate_form( this )" method="post">
				Class Code: <input type="text" name="classcode" title="Class Code" />
				<input type="submit" value="Enter">
			</form></br>
			';
		}
		else{
			echo 'You where not logged in. :( </br>';
		}
	?>
</body>
</html>