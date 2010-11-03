<?php
	class StudentClassGateway {
		public static function selectStudentClassesByOnyen($onyen){
			$select = "SELECT * FROM StudentClasses WHERE Onyen = '$onyen'";
			echo $select .'</br>';
			$result = mysql_query($select);
			while($val = mysql_fetch_array($result)){
				$a[] = $val;
			}
			return $a;			
		}
		
		public static function insertStudentClass($onyen, $classCode){
			$insert = "INSERT INTO StudentClasses (Onyen, ClassCode) VALUES ('$onyen', '$classCode')";
			return mysql_query($insert);
		}
	}
?>