<?php
	include_once('LDAPHelper.php');
	/**
	Author: Logan Wilkerson
	StudentClassGateway.php
	A class for interacting with the StudentClass table
	*/
	class StudentClassGateway {
		public static function selectStudentClassesByOnyen($onyen){
			$select = "SELECT * FROM StudentClasses WHERE Onyen = '$onyen'";
			$result = mysql_query($select);
			while($val = mysql_fetch_array($result)){
				$a[] = $val;
			}
			return $a;			
		}
		
		public static function selectAllStudentClasses(){
			$select = 'SELECT * FROM StudentClasses';
			$result=mysql_query($select);
			while($val = mysql_fetch_array($result)){
				$classlist[$val['ONYEN']][] = $val['ClassCode'];
				if(!isset($sortedList[$val['ONYEN']])){
					$name = LDAPHelper::getName($val['ONYEN']);
					$lastname = end(explode(' ', $name));
					$sortedList[$val['ONYEN']] = $lastname;
				}
			}
			asort($sortedList);
			$a[] = $classlist;
			$a[] = $sortedList;
			return $a;
		}
		
<<<<<<< local
=======
		public static function deleteStudentClass($onyen, $classCode){
			$delete = "DELETE FROM StudentClasses WHERE Onyen = '$onyen' and ClassCode = '$classCode'";
			return mysql_query($delete);
		}
		
>>>>>>> other
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