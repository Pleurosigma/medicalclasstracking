<html>
<body>
	<h2> Starting Test </h2>
	<?php
		$date = new DateTime('2010-01-01 12:00:00');
		echo $date->format('D') . '</br>';
		$now = new DateTime();
		if($date <= $now){
			echo "test";
		}
		else{
			echo "other test";
		}
	?>
</body>
</html>