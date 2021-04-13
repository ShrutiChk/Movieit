<?php 
include 'Connection.php';
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main_browsermovies.css" />
	   <!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>MovieIt</title>
</head>
<body  style="background-color: #202020;">
<!-- =====================header section=============================== -->
	
	<div class="container-fluid " >
		<div class="row" style="background-color:black;">
			<div class="container">
				<div class="row">
						<h1 class="titleHead"style="padding-right:30px;color: #CC0066;font-style: italic; font-family: serif;font-weight: bold;margin-right: 80px;">MovieIt</h1>
						<form method="post">
						<input class="search-input1" type="text" name="headerSearch" placeholder="Search..">	
					</form>
						<div class="topnav" id="myTopnav">
							
							<a href="index.php" >Home</a>
							<a href="BrowseMovies.php" class="active">Browse Movies</a>
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
							<a href="ContactUs.php" >Contact Us</a>
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
	
<!-- =====================main search section=============================== -->	


<div id="main-search" class="content-dark hidden-sm hidden-xs">
	<div class="container">
		<form method="post" action="" >
			<div class="main-search-fields">
				<p class="search-label term">Search Term: </p>
				<div class="row">
					<input class="search-input" name="keyword" autocomplete="off" type="search" >
					<input class="submit-btn" name="submit_button" type="submit" value="SEARCH">
				</div>
				<div class="row">
				<div class="selects-container">
					<p> Genre: </p>
					<select class="selects" name="genre" >
						<option Value="all">All</option>
						<option Value="action">Action</option>
						<option Value="adventure">Adventure</option>
						<option Value="animation">Animation</option>
						<option Value="biography">Biography</option>
						<option Value="comedy">Comedy</option>
						<option Value="crime">Crime</option>
						<option Value="documentary">Documentary</option>
						<option Value="drama">Drama</option>
						<option Value="family">Family</option>
						<option Value="fantasy">Fantasy</option>
						<option Value="film-noir">Film-Noir</option>
						<option Value="history">History</option>
						<option Value="horror">Horror</option>
						<option Value="musical">Musical</option>
						<option Value="mystery">Mystery</option>
						<option Value="romance">Romance</option>
						<option Value="sci-fic">Sci-Fic</option>
						<option Value="thriller">Thriller</option>
						<option Value="war">War</option>
						<option Value="western">Western</option>
						
			
					</select>
				</div>
				
				<div class="selects-container">
					<p> Ratings: </p>
					<select class="selects" name="rating" >
						<option Value="0">All</option>
						<option Value="4">4+</option>
						<option Value="3">3+</option>
						<option Value="2">2+</option>
						<option Value="1">1+</option>
						
					</select>
				</div>
				
				<div class="selects-container">
					<p> Order By: </p>
					<select class="selects" name="order_by" >
						<option value="None">None</option>
						<option Value="year">Year</option>
						<option Value="rating">Rating</option>
					</select>
				</div>

				<div class="selects-container">
					<p> Language: </p>
					<select class="selects" name="language" >
						<option value="all">All</option>
						<option Value="English">English</option>
						<option Value="Bengali">Bangla</option>
						<option Value="Hindi">Hindi</option>
						<option Value="Spanish">Spanish</option>
						<option Value="French">French</option>
						<option Value="Polish">Polish</option>
						<option Value="Marathi">Marathi</option>
						<option Value="Malayam">Malayam</option>
						<option Value="Italiano">Italiano</option>
					</select>
				</div>
				
				</div>
			</div>
		</form>
	</div>
</div>

<!-- =====================Movie List section=============================== -->
<div class="container">
	<div class="row">
	<?php  
	$movie_query = "SELECT * FROM movieinfo LIMIT 12 ";
	
	if(isset($_GET['page']) == 'two')
	{
		$movie_query = "SELECT * FROM movieinfo LIMIT 12 OFFSET 13 ";
	}
	else if(isset($_GET['page']) == 'three')
	{
		$movie_query = "SELECT * FROM movieinfo LIMIT 6 OFFSET 25 ";
	}
	if(isset($_POST['submit_button'])){
		$searchWord = $_POST['keyword'];
		$genreSearch = $_POST['genre'];
		$rateSearch = $_POST['rating'];
		$orderSearch = $_POST['order_by'];
		$langSearch = $_POST['language'];
		/*echo $searchWord;
		echo $genreSearch;
		echo $rateSearch;
		echo $orderSearch;*/
		if($searchWord != ''){
			$movie_query = "SELECT * FROM movieinfo WHERE movieName LIKE '%".$searchWord."%'";
		}
		else if($genreSearch != 'all'){
			$movie_query = "SELECT * FROM movieinfo WHERE genre = '$genreSearch'";
		}
		else if($rateSearch != '0'){
			$movie_query = "SELECT * FROM movieinfo WHERE rating >= '$rateSearch'";
		}
		else if($orderSearch != 'None'){
			$movie_query = "SELECT * FROM movieinfo ORDER BY $orderSearch DESC";
		}
		else if($langSearch != 'all'){
			$movie_query = "SELECT * FROM movieinfo WHERE language = '$langSearch'";
		}
		
	}
	if(isset($_POST['headerSearch'])){
			$headSearch = $_POST['headerSearch'];
			$movie_query = "SELECT * FROM movieinfo WHERE movieName LIKE '%".$headSearch."%'";
	
	}
	$result = mysqli_query($link,$movie_query);
	while($row = mysqli_fetch_array($result)) 
		{   
		?>
		<div class='browse-movies col-md-3 mt-5 p-4'>
			<!--<form  action ="ViewDetails.php" method="post">-->
				<?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"width = "200" height = "305"/>'; ?>
				<content>
					<span class="iconStar"></span>
					<input type="hidden" name="hidden_id" value="<?php echo $row['movieId'];?>">
					<h4 class="rating"><?php echo $row['rating'];  ?></h4>
					<h4 class = "genre"><?php echo $row['genre'];  ?></h4>
					
					<input type="submit" name="ViewDetails" class="gridButton" onclick="window.location.href = 'ViewDetails.php?movieId=<?php echo $row['movieId']; ?>';" value="Learn More">
				</content>
					<div>
						<h6 class="movieName"><?php echo $row['movieName'];?></h6>
						<h7 class="movieYear"><?php echo $row['year'];  ?></h7>
					</div>
			</form>
		</div>
		<?php	
		}
	
	?>
	</div>
</div>
<!--=====================Pages======================================== -->
<div class="row">
	<div class="center">
		<div class="pagination">
			<a href="#">&laquo;</a> 
			
			<?php  
			if(isset($_GET['page']) == 'two')
			{
				echo '<a href="BrowseMovies.php">1</a>';
				echo '<a class = "active" href="BrowseMovies.php?page=two ">2</a>';
				echo '<a href="BrowseMovies.php?page=three ">3</a>';
			}
			else if(isset($_GET['page']) == 'three'){
				echo '<a href="BrowseMovies.php">1</a>';
				echo '<a href="BrowseMovies.php?page=two">2</a>';
				echo '<a class = "active" href="BrowseMovies.php?page=three ">3</a>';

			}
			else
			{
				echo '<a class="active" href="BrowseMovies.php">1</a>';
				echo '<a href="BrowseMovies.php?page=two ">2</a>';
				echo '<a href="BrowseMovies.php?page=three ">3</a>';
			}
			?>
		    <a href="#">4</a>
		    <a href="#">5</a>
		    <a href="#">6</a>
		    <a href="#">&raquo;</a>
		</div>
	</div>
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