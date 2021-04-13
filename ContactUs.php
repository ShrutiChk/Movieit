<?php
	include 'Connection.php';
	session_start();
	if(isset($_POST['submit_button'])) 
	{
		if(!empty($_POST))
		{
			$name=$_POST['input_name'];
			$email=$_POST['input_mail'];
			$phoneNo=$_POST['input_phone'];
			$message=$_POST['input_msg'];
		
			/*$file_open=fopen('ContactUsfile.csv','a');
			
			$list = array (
				$name,$email,$phoneNo,$message
			);


			fputcsv($file_open, $list);*/
			$insertion = 'INSERT INTO contact(Name,Email,PhoneNo,Message) VALUES("'.$name.'","'.$email.'","'.$phoneNo.'","'.$message.'")';
			$run = mysqli_query($link,$insertion);
				if($run)
				{
					echo "<script type='text/javascript'>alert('Submitted successfully!!')
							window.location.href = 'index.php'</script>";

				}
				else {
					echo "<script type='text/javascript'>alert('Connection Failed!')</script>";
				}
			
			
			//fclose($file_open);
		}
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main_contactus.css" />
	   <!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>MovieIt</title>
</head>
<body  style="background-color: #202020;background: url(images/moviestill4.jpg);">
<!-- =====================header section=============================== -->
	
	<div class="container-fluid " >
		<div class="row" style="background-color:black;">
			<div class="container">
				<div class="row">
						<h1 class="titleHead"style="padding-right:30px;color: #CC0066;font-style: italic; font-family: serif;font-weight: bold;margin-right: 80px;">MovieIt</h1>
				<input class="search-input" type="text" placeholder="Search..">	
				<div class="topnav" id="myTopnav">
							
							<a href="index.php"style="margin-left: 15px;" >Home</a>
							<a href="BrowseMovies.php" style="margin-left: 15px;" >Browse Movies</a>
							<?php
									
									if (($_SESSION['isUser']) == TRUE)
									{
										echo '<a href="UserProfile.php" style="margin-left: 15px;" ><i class="fa fa-user" aria-hidden="true"></i>UserProfile</a>';
									    echo '<a href="Signout.php" style="margin-left: 5px;" ><i class="fas fa-sign-out-alt" style="color:white;"></i></a>';
									}
									else
									{
										echo '<a href="SignIn.php" style="margin-left: 15px;" >Sign In</a>';
									
									}
							?>
							<a href="ContactUs.php"class="active" style="margin-left: 20px;" >Contact Us</a>
							<a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
					    </div>
				</div>
			
			</div>
		</div>
	</div>
	
		<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
	
<!-- =====================Contact section=============================== -->
<section class="contact">
	<div class="contact-form">
		<h1>Contact Us</h1>
		<form class="form" method="POST" action="">
			<div class="formText">
				<label>Name : </label>
				<input class="name" type="text" name="input_name" placeholder="Enter your Name">
			</div>
			<div class="formText">
				<label>Email : </label>
				<input class="email" type="email" name="input_mail" placeholder="Enter your Email">
			</div>
			<div class="formText">
				<label>Phone no : </label>
				<input class="phone" type="text" name="input_phone" placeholder="Enter your Phone No:">
			</div>
			<div class="formText">
				<label>Message : </label>
				<textarea class="message" name="input_msg" cols="30" rows="10" placeholder="Enter your Message"></textarea>
			</div>
			<input class="submit-btn" name="submit_button" type="submit" value="SUBMIT">
		</form>
	</div>
				
</section>


<!-- =====================footer section=============================== -->
<footer class="foot">
	<div class="row">
		<h6 class=" mb-0 col-12 text-center p-4 "> &copy <a href="index.html">MovieIt.com</a> All Rights Reserved</h6>							
	</div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
