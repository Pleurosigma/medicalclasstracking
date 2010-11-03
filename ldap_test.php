<html>
<body>
<h3> Here is my LDAP Test </h3>
<?php
//	$username = "cblashka";
//	$password = "eighten=18";
//	$ldap_host = "ldap.unc.edu";
//	$dn= "ou=people,dc=unc,dc=edu";
//	$filter = "uid=".$username;
//	$ds = ldap_connect($ldap_host);
//	if($ds){
//		echo 'got a connection </br>';
//		$r = ldap_bind($ds);
//		$sr=ldap_search($ds, $dn, $filter);
//		$info = ldap_get_entries($ds, $sr);
//		if($info["count"] != 1){
//			echo "$filder -- no unique match: " . $info['count'] . " hits\n";
//		}
//		$authenticated=ldap_bind($ds, $info[0]["dn"], $password);
//		ldap_close($ds);
//		if($authenticated){
//			echo "Onyen and Password are a go</br>";
//		}
//		else{
//			echo "No go</br>";
//		}
//	}
//	else{
//		die("No connection");
//	}
	include("ldap_functions.php");
	if(authenticate('hgrogers', '0000')){
		echo 'Authenticate is go</br>';
	}		
	echo 'Name is ' . getName('martinec') . '</br>';
?>
</body>
</html>