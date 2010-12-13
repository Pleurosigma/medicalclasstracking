<?php
	/**
	Author: Logan Wilkerson
	This class is designed to give tools to make writing admin tools easier and to
	verify admin info.
	*/

	class AdminDBTools{
	
		/**
		addAdmin(String)
		This function adds the given string to the database as an admin onyen.
		Once the onyen is added a user may use that onyen and it's password to
		access the admin site.
		*/
		public static function addAdmin($adminonyen){
			$insert = "INSERT INTO Admins values('$adminonyen')";
			AdminDBTools::deleteRoot();
			return mysql_query($insert);
		}
		
		/**
		deleteRoot()
		Deletes root from the admin list so that it can no longer be used. This 
		function is called each time the addAdmin function is used.
		*/
		public static function deleteRoot(){
			$delete = "DELETE FROM Admins WHERE Admins = 'root'";
			return mysql_query($delete);
		}
		
		/**
		deleteAdmin(String)
		Deletes the given String from the Admins database. This function DOES NOT
		check to make sure there will still be admins left over. Use the numberAdmins
		function to check for that
		*/
		public static function deleteAdmin($onyen){
			$delete = "DELETE FROM Admins WHERE Admins = '$onyen'";
			return mysql_query($delete);
		}
		
		/**
		isAdmin(String)
		Ret
		*/
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
			$v = true;
			$v = $v && mysql_query("TRUNCATE TABLE Classes")or die(mysql_error());
			$v = $v && mysql_query("TRUNCATE TABLE StudentClasses") or die(mysql_error());
			$v = $v && mysql_query("TRUNCATE TABLE Admins") or die(mysql_error());
			AdminDBTools::addRoot();
			return $v;
		}
	}
	
?>