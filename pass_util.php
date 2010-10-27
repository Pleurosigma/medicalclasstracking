<?php
	/**
	Author: Logan Wilkerson
	Name: pass_util.php
	Contains functions for passwords
	*/
	
	$salt = 'lkj234lkjslkjs123lkj4l392lkjf1';
	
	/**
	Function Name: get_encypted_pass
	Encrypts a password by adding a 30 character salt to the beginning
	of the cleartext password and then encrypting using md5
	@param: the cleartext password
	@returns: the encrypted password
	*/
	function get_encypted_pass($pass){
		return md5($salt . $pass);
	}
?>