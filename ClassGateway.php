<?php
	class ClassGateway{
		/**
		deleteClassByClassCode
		deletes a class from the database using its class code. This will also remove any
		StudentClasses using this classcode
		*/
		public static function deleteClassByClassCode($classCode){
			$delete = "DELETE FROM Classes WHERE ClassCode = '$classCode'";
			$b = mysql_query($delete) or die(mysql_error());
			$deleteSC = "DELETE FROM StudentClasses WHERE ClassCode = '$classCode'";
			return $b && mysql_query($deleteSC) or die(mysql_error());
		}
		
		/**
		editClass
		Edits a class in the database
		*/
		public static function editClass($classCode, $className, $startTime, $endTime, $creditHrs, $faculty, $grace){
			$update = "UPDATE Classes SET ClassName='$className', StartTime='$startTime', EndTime='$endTime', CreditHrs=$creditHrs, Faculty='$faculty', StandardGrace=$grace WHERE ClassCode='$classCode'";
			return mysql_query($update);
		}
		
		public static function insertClass($classCode, $className, $startTime, $endTime, $creditHrs, $faculty, $grace){
			$insert = "INSERT INTO Classes VALUES ('$classCode', '$className', '$startTime', '$endTime', $creditHrs, '$faculty', $grace)";
			return mysql_query($insert);
		}
		
//		public static function insertClass($insert){
//			return mysql_query($insert);
//		}
		
		public static function selectClass($select){
			return mysql_query($select);
		}
		
		public static function selectClassByClassCode($ClassCode){
			$select = "SELECT * FROM Classes WHERE ClassCode = '$ClassCode'";
			$r = mysql_query($select);
			if(!$val = mysql_fetch_array($r)){
				return false;
			}
			return $val;
		}

		public static function getClassInsertQuery($ClassCode, $ClassName, $StartTime, $EndTime, $CreditHrs, $Faculty){
			$insert = "INSERT INTO Classes VALUES ('" . $ClassCode . "','" . $ClassName . "','" . $StartTime . "','" . $EndTime . "'," . $CreditHrs . ",'" . $Faculty . "')";
			return $insert;
		}
		
		public static function getClassSelectQuery($ClassCode){
			$select = "SELECT * FROM Classes WHERE ClassCode = '" . $ClassCode . "'";
			return $select;
		}
		
		public static function getClassCode($ClassName){
			$chars = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$ClassNameNoSpace = str_replace(" ", "", $ClassName);
			$ClassNameNoSpace = strtoupper($ClassNameNoSpace);
			$length = strlen($ClassNameNoSpace);
			$length = min(4, $length);
			$code = substr($ClassNameNoSpace, 0, $length);
			while(strlen($code) < 9){
				$code = $code . $chars[array_rand($chars)];
			}
			return $code;		
		}
		
		public static function isClassCodeRedundant($ClassCode){
			return false;
		}

			
	}
?>