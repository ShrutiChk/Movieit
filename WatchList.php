<?php 


	 session_start();
	 
	 
	  if(!in_array($_GET['id'], $_SESSION['moviewatchid'])){
	    $_SESSION['moviewatchid'][] = $_GET['id'];
	  }
	  
	  
	  
     header('Location: userprofile.php');
	

?>