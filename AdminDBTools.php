<?php

	class AdminDBTools{
		public static function addAdmin($adminonyen){
			$insert = "INSERT INTO Admins values('$adminonyen')";
			AdminDBTools::deleteRoot();
			return mysql_query($insert);
		}
		
		public static function deleteRoot(){
			$delete = "DELETE FROM Admins WHERE Admins = 'root'";
			return mysql_query($delete);
		}
		
		public static function deleteAdmin($onyen){
			$delete = "DELETE FROM Admins WHERE Admins = '$onyen'";
			return mysql_query($delete);
		}
		
		public static function isAdmin($onyen){
			$select = "SELECT * FROM Admins WHERE Admins = '$onyen'";
			$result = mysql_query($select);
			if($v = mysql_fetch_array($result))
				return true;
			else
				return false;
		}
		
		public static function numberAdmins(){
			$select = "SELECT * FROM Admins";
			$result = mysql_query($select);
			$count = 0;
			while($v = mysql_fetch_array($result)){
				$count = $count + 1;
			}
			return $count;
		}
		
		public static function addRoot(){
			$insert = "INSERT INTO Admins values('root')";
			return mysql_query($insert);
		}
		
		public static function clearAll(){
			$drops = "
				TRUNCATE TABLE Admins;
				TRUNCATE TABLE Classes;
				TRUNCATE TABLE StudentClasses;
				";
			$v = mysql_query($drops);
			addRoot();
			return $v;
		}
	}
	
?>