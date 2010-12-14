<html>
<body>
	<h2> Class Gateway Test </h2>
	<?php
		include('db_connect.php');
		selectDB(getConnection());
		
		include('ClassGateway.php');
		ClassGateway::deleteClassByClassCode('CODIOVFOL');
		echo 'Done';
		
	?>
</body>
</html>