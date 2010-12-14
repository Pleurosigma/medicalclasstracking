<html>
<body>
	<h2> StudentClassGateway Test</h2>
	<?php
		include('StudentClassGateway.php');
		include('db_connect.php');
		echo 'running </br>';
		selectDB(getConnection());
		//insert test
//		StudentClassGateway::insertStudentClass('lcwilker', 'classcode1');

		$scarray = StudentClassGateway::selectStudentClassesByOnyen('lcwilker');
		print_r($scarray);
		echo '</br>';
		echo 'done';
	?>
</body>
</html>