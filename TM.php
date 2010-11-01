<?php
	class TM{
		private static function getSEP($time){
			$time_array = str_split($time);
			$SEP = false;
			foreach($time_array as $char){
				if(!(is_numeric($char))){
					$SEP = $char;
				}				
			}
			return $SEP;
		}
		
		private static function checkAllNumeric($time_split){			
			//Checks to make sure the pieces of time are numeric
			foreach($time_split as $piece){
				if(!(is_numeric($piece))){
					return false;
				}
			}
			return true;
		}
		
		/**
		changeTo24Hr
		Converts a 12Hour time to 24 hour format.
		@param $time: the time string. The time string will be split using whatever the last
					non numeric character in the string is. Basically you can use any
					seperator. But ALWAYS use the same one
		@param $am_pm: a string with the form 'am' for am times and 'pm' for pm times
		@return A string formated in 24 hour time using the same seperator
		*/
		public static function changeTo24Hr($time, $am_pm){
			//Finds a possible seperator and splits the time
			if(!($SEP = TM::getSEP($time))){
				return false;
			}
			$time_split = explode($SEP, $time);
			
			if(!TM::checkAllNumeric($time_split)){
				return false;
			}
			
			//Alter the Hour
			if(count($time_split) == 0){
				return false;
			}
			$hour = (int)$time_split[0];
			if($hour < 0 || $hour > 12){
				return false;
			}	
			$am_pm = strtoupper($am_pm);
			if($am_pm == 'AM'){
				if($hour == 12){
					$hour = 0;
				}
			}
			else{
				if($hour != 12){
					$hour = $hour + 12;
				}
			}
			$time_split[0] = $hour;
			
			//Reform the String
			$new_time = '';
			foreach($time_split as $piece){
				$new_time = $new_time . $piece . $SEP;
			}
			$new_time = substr($new_time, 0, -1);
			return $new_time;
		}
		
		/**
		changeTo12Hr
		Converts a 12 hour time to a 24 hour time and a string for am or pm
		@param $time: the 24 hour time string. The seperator can be any
		non numeric character, but they all have to be the same
		@returns an array. The first value in the array is the 12 hour time string
				and the second is either the string 'AM' or 'PM' to mark the time.
		*/
		public static function changeTo12Hr($time){
			if(!($SEP = TM::getSEP($time))){
				return false;
			}
			$time_split = explode($SEP, $time);
			
			if(!TM::checkAllNumeric($time_split)){
				return false;
			}
			
			//Alter hour
			if(count($time_split) == 0){
				return false;
			}
			$hour = $time_split[0];
			if($hour < 0 || $hour > 24){
				return false;
			}
			$am_pm = '';
			if($hour == 0 || $hour == 24){
				$hour = 12;
				$am_pm = 'AM';
			}
			elseif ($hour < 12){
				$am_pm = 'AM';
			}
			elseif($hour == 12){
				$am_pm = 'PM';
			}
			else{
				$am_pm = 'PM';
				$hour = $hour - 12;
			}
			$time_split[0] = $hour;
			
			$new_time = '';
			foreach($time_split as $piece){
				$new_time = $new_time . $piece . $SEP;
			}
			$new_time = substr($new_time, 0, -1);
			$result_array = array($new_time, $am_pm);
			return $result_array;
		}
	}

?>