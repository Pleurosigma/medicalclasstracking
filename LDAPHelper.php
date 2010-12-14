<?php
	/**
	Author: Logan Wilkerson
	LDAPHelper
	This class allows easy interaction with the campus LDAP
	*/
	class LDAPHelper{
	
		/**
		authenticate(String onyen, String password)
		This function takes the onyen and password and determines if they are 
		a valid onyen and password combination in the LDAP
		returns true if the info is valid.
		*/
		public static function authenticate($onyen, $password){
			$ldap_host = "ldap.unc.edu";
			$dn ="ou=people,dc=unc,dc=edu";
			$filter = "uid=".$onyen;
			$ds = ldap_connect($ldap_host);
			if($ds){
				$r = ldap_bind($ds);
				$sr = ldap_search($ds, $dn, $filter);
				$info = ldap_get_entries($ds, $sr);
				if($info['count'] != 1){
					return false;
				}
				$authenticated = @ldap_bind($ds, $info[0]['dn'], $password);
				ldap_close($ds);
				if($authenticated){
					return true;
				}
				else{
					return false;
				}
			}
			else{
//				die("Could not connect to LDAP server to verify onyen.");
			}
		}
		
		/**
		getName(String)
		This function takes the given string and uses it as an onyen. It searches
		for a name in the LDAP connected to the onyen.
		returns the LDAPS display name for that onyen, or false if one is not found.
		*/
		public static function getName($onyen){
			$ldap_host = "ldap.unc.edu";
			$dn = "ou=people,dc=unc,dc=edu";
			$filter="uid=".$onyen;
			$ds=ldap_connect($ldap_host);
			if($ds){
				$r = ldap_bind($ds);
				$sr = ldap_search($ds, $dn, $filter);
				$info = ldap_get_entries($ds, $sr);
				if($info['count'] != 1){
					return false;
				}
				return $info[0]['displayname'][0];
			}
			else{
				return false;
			}
		}
		
	}
?>