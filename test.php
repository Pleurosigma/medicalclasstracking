<?php
	include('db_connect.php');
	include('ClassGateway.php');
	selectDB(getConnection());
	ClassGateway::deleteClassByClassCode('ABC');
	echo 'done';
?>