<?php
include 'Connection.php';
   session_start();
   $_SESSION['isUser']=FALSE;
   $_SESSION['isUserId']=0;
   $_SESSION['isName']="";
   $_SESSION['isEmail']="";
	if(isset($_POST['createAcc'])) 
	{
		if(!empty($_POST))
		{
			$name=$_POST['UsernameInput'];
			$email=$_POST['EmailInput'];
			$password=$_POST['passwordInput'];
			$ReEnterPasssword=$_POST['Re-enterPassswordInput'];
			//$line = array($name,$email,$password);			

			//$file_open=fopen('NewAccount.csv','a');
			
		    if($password == $ReEnterPasssword )
		    {
				//fputcsv($file_open, $line);
				$query = "select * from user where userMail ='$email' ";
				$queryCheck = mysqli_query($link,$query);

				if($queryCheck)
				{
					if (mysqli_num_rows($queryCheck)>0) {
						echo "<script type='text/javascript'>alert('Email already in use!');
						window.location.href = 'Signin.php';</script>";
						
					}
					else{
						$insertion = 'INSERT INTO user(Username,UserMail,Password) VALUES("'.$name.'","'.$email.'",md5("'.$password.'"))';
						$run = mysqli_query($link,$insertion);
						if($run)
						{
							echo "<script type='text/javascript'>alert('Account created successfully!')
							window.location.href = 'Signin.php'</script>";

						}
						else {
							echo "<script type='text/javascript'>alert('Connection Failed!')</script>";
						}


					}

				}
				else {
					//querycheck
					echo "<script type='text/javascript'>alert('Database Error!')</script>";
				}

				//echo "<script type='text/javascript'>alert('Account created successfully!')</script>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Password and Re-enter password not matched!')</script>";
			}
			//fclose($file_open);
		
		}
    }
    

    if(isset($_POST['submit_btn']))
    {
    	if (!empty($_POST)) {
    	
			$username = $_POST['input_name'];
			$password = $_POST['input_password'];

			if (!strlen($username) || !strlen($password)) {
			     echo "<script type='text/javascript'>alert('Enter Empty fields!')</script>";
			}

			$success = false;
			//
			
				//
			/*$handle = fopen("NewAccount.csv", "r");

			if($handle !== FALSE)
			{

				while (($data = fgetcsv($handle,1000,",")) !== FALSE) {
				    if ($data[0] == $username && $data[2] == $password) {
						$_SESSION['isName']=$data[0];
						
						$_SESSION['isEmail']=$data[1];
				        $success = true;				 
				        break;
				    }
				}
			}

			fclose($handle);*/
			$login_query = "SELECT * FROM user WHERE Username ='$username'AND Password = md5('$password')";
			$check = mysqli_query($link,$login_query);
			if($check)
			{
				if (mysqli_num_rows($check)>0) {

					$success = true;
					$sql = "SELECT username,UserMail,UserId FROM user WHERE Username ='$username' AND Password = md5('$password')";
					$retval = mysqli_query($link,$sql);  
					while($row = mysqli_fetch_array($retval)) 
					{   $_SESSION['isName']=$row['username'];
						$_SESSION['isEmail']=$row['UserMail'];
						$_SESSION['isUserId']=$row['UserId'];
								 
						break;
					}
						echo "<script type='text/javascript'>alert('Successfully logged in!')
						window.location.href = 'index.php';

						</script>";

				}
				else
				{
					//email,pass check
					echo "<script type='text/javascript'>alert('Enter correct Password!')
					 window.location.href = 'Signin.php';

					 </script>";
				}

			}
			else
			{
				//check else
				echo "<script type='text/javascript'>alert('Database ERROR!')</script>";

			}

			if ($success) {
			    // they logged in ok
				
				$_SESSION['isUser']=TRUE;
			    //echo "<script type='text/javascript'>alert('successfully logged in!')</script>";

			} else {
			    // login failed
				
				$_SESSION['isUser']=FALSE;
			    //echo "<script type='text/javascript'>alert('Enter correct password!')</script>";
			}
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
    <link rel="stylesheet" href="css/main_signin.css" />
	   <!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>MovieIt</title>
</head>
<body style="background-image: url(images/Movies1.jpg); width:100% height:100%" class="img-responsive">
<!-- =====================header section=============================== -->
	
<div class="container-fluid " >
		<div class="row" style="background-color:black;">
			<div class="container">
				<div class="row">
						<h1 class="titleHead"style="padding-right:30px;color: #CC0066;font-style: italic; font-family: serif;font-weight: bold;margin-right: 80px;">MovieIt</h1>
						<input class="search-input" type="text" placeholder="Search..">
						<div class="topnav" id="myTopnav">
							
							<a href="index.php" >Home</a>
							<a href="BrowseMovies.php" >Browse Movies</a>
							<?php
									
									if (($_SESSION['isUser']) == TRUE)
									{
										echo '<a href="UserProfile.php" style="margin-left: 15px;" ><i class="fa fa-user" aria-hidden="true"></i>UserProfile</a>';
									    echo '<a href="Signout.php" style="margin-left: 5px;" ><i class="fas fa-sign-out-alt" style="color:white;"></i></a>';
									}
									else
									{
										echo '<a href="SignIn.php" class = "active" style="margin-left: 15px;" >Sign In</a>';
									
									}
							?>
							<a href="ContactUs.php" >Contact Us</a>
							<a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
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

<!-- =====================Signin section=============================== -->	

	<div class="form-area" >
		<h1 >SignIn</h1>
		<form  action="" method="POST">
		
			<p><i class="fas fa-user"></i>  Username : </p>
			<input class="name" type="text" name="input_name" autocomplete="off" placeholder="Enter your Name">
			<p><i class="fas fa-lock"></i>  Password: </p>
			<input class="phone" type="password" name="input_password" autocomplete="off" placeholder="Enter your password">
			<a href="a">Forgot Passsword?</a>
			<button  class="submit-btn" name="submit_btn" type="submit"> Sign In</button>
			
			<div class="line"></div>
			<div class="text">OR</div>
			<div class="line"></div>
			
				<!--<div class="hr"></div>
				<h4 class="sidelines"><span>or</span></h4>
			<label for="check"><span class="icon"></span> Keep me Signed in</label>-->	
		</form>
	
			<button  class="CreateAccount_button" type="submit" data-toggle="modal" data-target="#mymodal">Create New Account</button>
			
	</div>	
	<!-- =====================pop up section=============================== -->	
<div class="modal fade" id= "mymodal"  role="dialog" >
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">New Account</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			
			</div>
			<div class="modal-body">
				<form class="form"  method="POST" action="SignIn.php">
				<div class="formText">
					<label> <i class="fas fa-user"></i> Username:</label>
					<input type= "text" name="UsernameInput" class="name"  placeholder="Enter Your username">
				</div>
				<div class="formText">
					<label><i class="fas fa-envelope"></i> Email:</label>
					<input type= "text" name="EmailInput" class="Email"  placeholder="Enter Your email">
				</div>
				<div class="formText">
					<label><i class="fas fa-lock"></i> Password:</label>
					<input type= "password" name="passwordInput" class="password"  placeholder="Enter Your Password">
				</div>
				<div class="formText">
					<label><i class="fas fa-lock"></i> Re-enter password:</label>
					<input type= "password" name="Re-enterPassswordInput" class="Passsword"  placeholder="Re-enter Password">
				</div>
				
			<div class= "modal-footer justify-content-center">
				<button type="submit" class="create" name="createAcc"> Create your MovieIt Account</button>
				
			</div>	
		</form>
			</div>				
		</div>
	</div>
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
