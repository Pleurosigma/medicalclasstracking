<?php
	/**
	Author: Logan Wilkerson
	Name: db_connect.php
	Contains the function to connect to the database and returnes the connection
	*/

	
	/**
	Function Name: getConnection()
	Returns a connection to the database for use by the program 
	using mysql_connect() dies if no connection obtained and prints
	out the error.
	@returns: the connection to the database
	*/
	function getConnection(){
		$db_location = "localhost";
		$db_userName = "root";
		$db_userPass = "";
		$con = mysql_connect($db_location, $db_userName, $db_userPass);
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		else{
			return $con;
		}
	}
	
	function selectDB($con){
		mysql_select_db("CapstoneDB", $con);
	}
?>