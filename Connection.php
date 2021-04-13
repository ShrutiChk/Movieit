<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'movieit';
	
	$link = mysqli_connect($host,$user,$password,$db) or die('Database Error!');
	
?>