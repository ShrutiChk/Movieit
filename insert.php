 

<?php

include 'Connection.php';
session_start();

 $movieIdVar=$_SESSION['MovieId'];
 $UserIdVar=$_SESSION['isUserId'];
 $rateId=$_POST['Rrate'];
 $movieName=$_SESSION['MovieName'];
 
  echo   $rateId;
$sql="INSERT INTO rating (userId,movieId,movieName,rating) VALUES ('$UserIdVar','$movieIdVar','$rateId')";
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (mysqli_query($link,$sql))
  {
	echo "Records added successfully.";
}
  else{
	   die('Error: ' . mysqli_error());
}

mysqli_close($link);

?>