<?php
	session_start();
	unset($_SESSION['onyen']);
	unset($_SESSION['name']);
	header('Location: index.html');
?>