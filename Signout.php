<?php
	include 'Connection.php';
	session_start();
	session_destroy();
	header('Location: /MovieIt/SignIn.php');

?>