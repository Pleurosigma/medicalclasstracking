<html>
<head>
	<title> TM Test </title>
</head>
<body>
	<h2> TM Test 12=>24</h2>
	<?php
		echo 'Starting php</br>';
		include('TM.php');
		$time = '12:00:00';
		$am_pm = 'am';
		echo 'Vars Set</br>';
		print_r(TM::changeTo24Hr($time, $am_pm));
		echo '</br>';
		echo 'Done</br>'
	?>
	<h2> TM Test 24=>12</h2>
	<?php
		$time = '13:00:00';
		echo 'Vars Set</br>';
		print_r(TM::changeTo12Hr($time));
		echo '</br>';
		echo 'Done</br>';
	?>
	<h2> TM Test getDayOfWeek </h2>
	<?php
		$time = '2010-01-01 10:00:00';
		echo 'Vars Set</br>';
		echo TM::getDayOfWeek($time) . '</br>';
		echo 'Done';
	?>
</body>
</html>