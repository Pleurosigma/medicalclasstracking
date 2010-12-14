<?php
	session_start();
	unset($_SESSION['adminonyen']);
	header('Location: adminlogin.html');
?>