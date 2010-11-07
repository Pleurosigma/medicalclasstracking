<?php
	class StudentClassGateway {
		public static function selectStudentClassesByOnyen($onyen){
			$select = "SELECT * FROM StudentClasses WHERE Onyen = '$onyen'";
			$result = mysql_query($select);
			while($val = mysql_fetch_array($result)){
				$a[] = $val;
			}
			return $a;			
		}
		
		public static function studentHasClass($onyen, $classCode){
			$select = "SELECT * FROM StudentClasses WHERE Onyen = '$onyen' AND ClassCode = '$classCode'";
			$result = mysql_query($select);
			if($v = mysql_fetch_array($result))
				return true;
			else
				return false;
		}
		
		public static function insertStudentClass($onyen, $classCode){
			$insert = "INSERT INTO StudentClasses (Onyen, ClassCode) VALUES ('$onyen', '$classCode')";
			return mysql_query($insert);
		}
	}
?>