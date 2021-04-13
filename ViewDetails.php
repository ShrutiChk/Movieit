<?php 
include 'Connection.php';
session_start();
ob_start();
global $movieId,$movieN;

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
    <link rel="stylesheet" href="css/main_viewdetails.css" />
	   <!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>MovieIt</title>
</head>
<body  style="background-color: #202020;">
<!-- =====================Header section=============================== -->
	
<div class="container-fluid " >
		<div class="row" style="background-color:black;">
			<div class="container">
				<div class="row">
						<h1 class="titleHead"style="padding-right:30px;color: #CC0066;font-style: italic; font-family: serif;font-weight: bold;margin-right: 80px;">MovieIt</h1>
				<input class="search-input1" type="text" placeholder="Search..">	
				<div class="topnav" id="myTopnav">
							
							<a href="index.php"style="margin-left: 15px;" >Home</a>
							<a href="BrowseMovies.php" class="active" style="margin-left: 15px;" >Browse Movies</a>
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

<!-- =====================Details section=============================== -->
<div class="container">
	<div class="row">
		<?php
			if(isset($_POST['ViewDetails']))
			{
				if(!empty($_POST))
				{
					  $movieId=$_POST['hidden_id'];
					
				}
			}			 
			$movie_query = "SELECT * FROM movieinfo WHERE movieId='{$movieid}'";
			$result = mysqli_query($link,$movie_query);
			while($row = mysqli_fetch_array($result)) 
			{   
			?>
		<h1 class="Moviename_header"><?php echo $row['movieName']; ?>
			<small>Movie information</small>
		</h1>
	</div>
	<div class="row">
		<div class="detailBox">
			<div class="MovieBox">

				<div class="column1">
					<?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'" width = "200" height = "305"/>'; ?>
					<div class="center">
						<div class="ratingBox">
							<span class="yourRating">Your rating</span><br>													
								<?php 

								if (($_SESSION['isUser']) == TRUE){

														
						            $UID=$_SESSION['isUserId'];						
									if($rrr = mysqli_fetch_assoc(mysqli_query($link,"select * from rating where userId = {$UID} and movieId = {$movieid} limit 1"))){ ?>	

										<form >
											 <div class="rate">
												
												<?php for($i=0;$i<$rrr['rating'];$i++){ ?>
													<label for="star5" title="5 stars">5 stars</label>
												<?php	} ?>
												
											 </div>
										</form>			
									<?php }else{ ?>
										<form action="ViewDetails.php?movieId=<?php echo $movieid; ?>"  method="POST">
											 <div class="rate">
												<input type="hidden" name="hiddenR_id" value="<?php echo $movieId;?>" >
												<input type="hidden" name="hiddenR_Name" value="<?php echo $row['movieName']; ?>" >								
												<input type="submit" id="star5" name="rate" value="5"  >
												<label for="star5" title="5 stars">5 stars</label>
												<input type="submit" id="star4" name="rate" value="4" >
												<label for="star4" title="4 stars">4 stars</label>
												<input type="submit" id="star3" name="rate" value="3" >
												<label for="star3" title="3 stars">3 stars</label>
												<input type="submit" id="star2" name="rate" value="2" >
												<label for="star2" title="2 stars">2 stars</label>
												<input type="submit" id="star1" name="rate" value="1" >
												<label for="star1" title="1 stars">1 star</label>								
											 </div>
										
									<?php
										}
									}
									?>
						</div>
					</div>
					<?php
						if (($_SESSION['isUser']) == TRUE){

					?>
						<button type="submit" name ="watchButton" class="WatchListButton"><a style="text-decoration:none;color:#030303" href="UserProfile.php?movieId=<?php echo $movieid;?>">+Add Watchlist</a></button>
						<?php
					}
					?>
					</form>
				</div>
				
		
	
				<div class="infos">
					<p>
						<span class="labelinfo">Rating :</span>
						<span class="Valueinfo"><?php echo $row['rating']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Year :</span>
						<span class="Valueinfo"><?php echo $row['year']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Genre :</span>
						<span class="Valueinfo"><?php echo $row['genre']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Director :</span>
						<span class="Valueinfo"><?php echo $row['director']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Cast :</span>
						<span class="Valueinfo"><?php echo $row['cast']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Language :</span>
						<span class="Valueinfo"><?php echo $row['language']; ?></span>
					</p>
					<p>
						<span class="labelinfo">Release Date :</span>
						<span class="Valueinfo"><?php echo $row['releaseDate']; ?></span>
					</p>
				
				</div>
			</div>
			
		</div>

	</div>
	<div class="row">
		<div class="summary">
			<h3>Summary:</h3>
			<p class="summaryText"><?php echo $row['summary']; ?></p>
		</div>
		
	</div>
	<div class="row">
		<div class="trailer">
			<h3 class="trailerHeader" style="color: #CC0066">Watch The Trailer :</h3>
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['trailer'] ).'" width="60%" height="400px" style="margin-left: 250px;margin-top: 10px;margin-bottom: 20px;"/>'; ?>
		</div>
		<?php
			}
			?>
	</div>

	<div class="row">
		<div class="comments">

			<h3 class="commentsHeader"><i class="fa fa-comment"></i> Comments:</h3>
			<hr style="border-top: 1px solid #ccc; background: transparent;">
			<div class="commentShow">
				<h6 class="comName">Name</h6>
				<p class="comPara">Your comment is here</p>
				
			</div>

			<div class="commentShow">
				<h6 class="comName">Name</h6>
				<p class="comPara">Your comment is here.Tested in Firefox, Opera, Internet Explorer, Chrome and Safari.</p>
				
			</div>

			<div class="commentShow">
				<h6 class="comName">Name</h6>
				<p class="comPara">Your comment is here.After reading all the answers here, and seeing the complexity described, I set upon a small diversion for experimenting with HR.</p>
				
			</div>
			
		</div>
		
	</div>
</div>

	

<!-- =====================footer section=============================== -->
<footer class="foot">
	
	<div class="row">
		<h6 class=" mb-0 col-12 text-center p-4 "> &copy <a href="index.html">MovieIt.com</a> All Rights Reserved</h6>							
	</div>
</footer>
<?php

            $UserIdVar=$_SESSION['isUserId'];
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
			if (isset($_POST['rate']))
			{
				//$movieId=$_POST['hiddenR_id'];
				$movieName=$_POST['hiddenR_Name'];
				$rateId=$_POST['rate'];
				$sql="INSERT INTO rating (userId,movieId,movieName,rating) VALUES ('$UserIdVar','{$movieid}','$movieName','$rateId')";
				
				if (mysqli_query($link,$sql))
				{
						echo "<script type='text/javascript'>alert('Thanks for rating!')
							window.location.href = 'ViewDetails.php?movieId={$movieid}'</script>";
						//header("Location: ViewDetails.php?movieId={$movieid}");
				}
				else
				{
					die('Error: ' . mysqli_error());
				}
			} 


?>	
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>