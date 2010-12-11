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
				$classlist[$val['Onyen']][] = $val['ClassCode'];
				if(!isset($sortedList[$val['Onyen']])){
					$name = LDAPHelper::getName($val['Onyen']);
					$lastname = end(explode(' ', $name));
					$sortedList[$val['Onyen']] = $lastname;
				}
			}
			asort($sortedList);
			$a[] = $classlist;
			$a[] = $sortedList;
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