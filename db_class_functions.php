<?php
	function insertClass($insert){
		return mysql_query($insert);
	}
	
	function selectClass($select){
		return mysql_query($select);
	}

	function getClassInsertQuery($ClassCode, $ClassName, $StartTime, $EndTime, $CreditHrs, $Faculty){
		$insert = "INSERT INTO Classes VALUES ('" . $ClassCode . "','" . $ClassName . "','" . $StartTime . "','" . $EndTime . "','" . $CreditHrs . "','" . $Faculty . "')";
		return $insert;
	}
	
	function getClassSelectQuery($ClassCode){
		$select = "SELECT * FROM Classes WHERE ClassCode = '" . $ClassCode . "'";
		return $select;
	}
	
	function getClassCode($ClassName){
		$chars = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$ClassNameNoSpace = str_replace(" ", "", $ClassName);
		$ClassNameNoSpace = strtoupper($ClassNameNoSpace);
		$length = strlen($ClassNameNoSpace);
		$length = min(4, $length);
		$code = substr($ClassNameNoSpace, 0, $length);
		while(strlen($code) < 10){
			$code = $code . $chars[array_rand($chars)];
		}
		return $code;		
	}
	
	function isClassCodeRedundant($ClassCode){
		return false;
	}
?>