<?php
	/**
	Author: Logan Wilkerson
	ver_addadmin.php
	Actually adds the admin to the database and informs the use it was added
	*/
	session_start();
	include('db_connect.php');
	include('AdminDBTools.php');
	if(!isset($_SESSION['adminonyen']) || !isset($_POST['adminonyen'])){
		//return to admin login
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<title> Add Admin</title>
	</head>
	<body>
		<?php
			selectDB(getConnection());
			$adminonyen = $_POST['adminonyen'];
			$action = $_POST['action'];
			if($action == 'Add'){
				if(AdminDBTools::addAdmin(strtolower($adminonyen))){
					echo "$adminonyen added as an admin.";
				}else{
					echo 'Admin could not be added. They may already be an admin.';
				}
			}
			elseif($action == 'Delete'){
				if(AdminDBTools::numberAdmins() == 1){
					echo 'You may not delete the last admin.';
				}
				elseif(strtolower($_SESSION['adminonyen']) == strtolower($adminonyen)){
					echo 'You may not delete yourself.';
				}
				elseif(AdminDBTools::deleteAdmin($adminonyen)){
					echo "$adminonyen is no longer an admin.";
				}
			}
		?>		
		<form action="addadmin.php" method="link">
			<input type="submit" value="Back">
		</form>
	</body>
</html>