<?php
	class TimeVerification{
		public static function checkTime($starttime, $endtime,  $standardGrace){
			$end_date = new DateTime($endtime);
			$start_date = new DateTime($starttime);
			$now = new DateTime();
			if(!$standardGrace){
				$end_date->setTime(20, 0);
			}
			else{
				//The 59 seconds gives a little extra wiggle room. The idea
				//is that seconds don't really matter and it's okay to submit
				//on the 15th minute.
				$interval = new DateInterval('PT15M59S');
				$end_date->add($interval);
			}
			if($now <= $end_date && $now >= $start_date){
				return true;
			}
			else{
				return false;
			}	
		}
		
		public static function timesOverlap($starttimeone, $endtimeone, $starttimetwo, $endtimetwo){
			$startone = new DateTime($starttimeone);
			$endone = new DateTime($endtimeone);
			$starttwo = new DateTime($starttimetwo);
			$endtwo = new DateTime($endtimetwo);
			if(($startone < $endtwo && $endone > $starttwo) || ($startone == $endtwo && $endone == $starttwo)){
				return true;
			}
			return false;
		}
	}
?>