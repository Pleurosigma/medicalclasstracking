<html>
<head>
	<title> TM Test </title>
</head>
<body>
	<h2> TM Test 12=>24</h2>
	<?php
		echo 'Starting php</br>';
		include('TM.php');
		$time = '1:2:0';
		$am_pm = 'am';
		echo 'Vars Set</br>';
		print_r(TM::changeTo24Hr($time, $am_pm));
		echo '</br>';
		echo 'Done</br>'
	?>
	<h2> TM Test 24=>12</h2>
	<?php
		$time = '13:0:0';
		echo 'Vars Set</br>';
		print_r(TM::changeTo12Hr($time));
		echo '</br>';
		echo 'Done</br>';
	?>
</body>
</html>