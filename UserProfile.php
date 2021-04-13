<?php 
include 'Connection.php';
	session_start();

if (($_SESSION['isUser']) == FALSE){
	exit('No Access!!!');
}

					
$UserId =  $_SESSION['isUserId'];
$movieid=1;
if(isset($_GET['movieId'])){
	 $movieid = $_GET['movieId'];
	 
	
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
    <link rel="stylesheet" href="css/main_userprofile2.css" />
	   <!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>MovieIt</title>
</head>
<body  style="background-color: #202020;>
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
										echo '<a href="UserProfile.php" class="active" style="margin-left: 15px;" ><i class="fa fa-user" aria-hidden="true"></i>UserProfile</a>';
									    echo '<a href="Signout.php" style="margin-left: 5px;" ><i class="fas fa-sign-out-alt" style="color:white;"></i></a>';
									}
									else
									{
										echo '<a href="SignIn.php" style="margin-left: 15px;" >Sign In</a>';
									
									}
							?>
							<a href="ContactUs.php" style="margin-left: 20px;" >Contact Us</a>
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
	
<!-- =====================body section=============================== -->
	<div class= "userProfile">
		<a class="userProfile-bg userProfile-block img-responsive" style="background-image: url(images/UserprofileB.jpg);" ></a>
		<div class="container">

			<img alt="" src="images/admin.png" class="userProfile-avatarImg rounded-circle img-responsive" > 
			<div class="userProfile-divUser">
			    <h2 >USER INFORMATION</h1>
				<div class="userProfile-divName">
					<p style="color:white; padding:5px;"> Name:  <?php $isName=$_SESSION['isName']; echo  $isName ;?></p>
		
				</div>
				<div class="userProfile-divName">
					<p style="color:white; padding:5px;"> Email:  <?php $isEmail=$_SESSION['isEmail']; echo  $isEmail ;?></p>
				
				</div>
			</div>
		</div>
	</div>
<!-- ===================== user information =============================== -->	
	<div class="container">
	
	
		<h4 class="title">MOVIES-YOU-WANT-TO-SEE :</h4>
		
		
		<div class="row" style="margin-left: 70px;">
		
		
		
		<?php 
			
			/*if(  isset($_SESSION['moviewatchid'])  ){

				foreach( $_SESSION['moviewatchid'] as $wlmid){
					$sql  = "SELECT * FROM movieinfo where movieId = {$wlmid} limit 1" ;
					$rslt = mysqli_fetch_assoc(mysqli_query($link,$sql)); ?>*/

							$UserIdVar=$_SESSION['isUserId'];
					$userProfileQuery=mysqli_query($link,"SELECT * FROM watchlist WHERE movieId='$movieid' AND userId = $UserIdVar");
						if (mysqli_num_rows($userProfileQuery)>0) {
							echo $UserIdVar;
							$movie_query ="select * from movieinfo inner join watchlist on watchlist.movieId = movieinfo.movieId where watchlist.userid = '{$UserIdVar}'";
							$result=mysqli_query($link,$movie_query);
							
						}
						else{
							echo 2;
							$UserIdVar=$_SESSION['isUserId'];
							$sql1="INSERT INTO watchlist (userId,movieId) VALUES ('$UserIdVar','$movieid')";
							mysqli_query($link,$sql1);
							echo "<script type='text/javascript'>alert('Added to Watchlist!');
							</script>";

							$movie_query ="select * from movieinfo inner join watchlist on watchlist.movieId = movieinfo.movieId where watchlist.userid = '{$UserIdVar}'";
							$result=mysqli_query($link,$movie_query);
					
						}	
									
					
					//	$movie_query ="select * from movieinfo inner join watchlist on watchlist.movieId = movieinfo.movieId where watchlist.userid = '{$UserIdVar}'";
				       // $result=mysqli_query($link,$movie_query);
					
					while($row = mysqli_fetch_array($result)) 
					{ ?>
					
				
					<div class="browse-movies col-md-4 mt-5 p-4">
			        <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"width = "200" height = "305"/>'; ?>
					<content>
						<span class="iconStar"></span>
						<h4 class="rating"><?php echo $row['rating']; ?></h4>
						<h4 class = "genre"><?php echo $row['genre']; ?></h4>
						<input type="submit" name="ViewDetails" class="gridButton" onclick="window.location.href = 'ViewDetails.php?movieId=<?php echo $row['movieId']; ?>';" value="Learn More">

					</content>
					<div>
						<h6 class="movieName"><?php echo $row['movieName']; ?></h6>
						<h7 class="movieYear"><?php echo $row['year']; ?></h7>
					</div>
			
					</div>
			
						<?php	} ?>	

			</div>
	</div>
<!-- ===================== rating=============================== 
	<h4 class="rating_title">YOUR-RATINGS-FOR-MOVIES :</h4>
	<table>
	<thead>
			<tr>
				<th>Movies</th>
				<th>Ratings</th>
				
	        </tr>
		</thead>
		<tbody>
		<tr>
				<td>Avatar</td>
				<td>3 star</td>
				
	        </tr>
		</tbody>
	</table>

	</div>
-->		

<!-- =====================rating=============================== -->
	<div class="container">
	<h4  class="title"style="">RATING :</h4>
	<?php 
	
		//$sql = "SELECT * FROM RATING where userId = {$UserId}";
		$sql = "select * from movieinfo inner join RATING on RATING.movieId = movieinfo.movieId where RATING.userid = '{$UserId}'";
		$rsl =(( mysqli_query($link,$sql)));
					$j = 1;

		if(mysqli_num_rows($rsl)>0 ){
		while($row = mysqli_fetch_assoc($rsl)){ ?>
			

	
		<div class="row Rmov" id="">
			<div class="col-md-6 col-sm-6 col-xs-6" >
			    <h4 class="Rmovies"><?php echo $j++; ?></h4>
				<?php echo ' <img class="Rimg" src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"width = "200" height = "305"/>'; ?>
            </div>
			 <div class="col-md-6 col-sm-6 col-xs-6"  id="mov" >
				<h4 class="Rmovies1"><?php echo $row['movieName']; ?></h4>
				
				<?php 
					for($i=0;$i<$row['rating'];$i++){ ?>
						<span class="fa fa-star checked" ></span>
					<?php	} ?>
			  
			
				<h4 class="Rmovies1">Summary :</h4>	
				<p class="summaryText Rpara"><?php echo $row['summary']; ?></p>
				
            </div >
			<div class="col-md-12 col-sm-12 col-xs-12">
					<hr>
			</div>
		</div>

		<?php	}} ?>	
	</div>

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
