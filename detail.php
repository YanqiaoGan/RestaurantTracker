<?php
	require "config.php";
	if(!isset($_GET["review_id"]) || empty($_GET["review_id"])){
		$error = "Invalid Review ID";
	}else{
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');
		$sql = "SELECT restaurants.name, restaurants.category, restaurants.location, restaurants.rating, restaurants.photo1, restaurants.photo2, restaurants.photo3, reviews.date, reviews.review
		FROM reviews
		LEFT JOIN restaurants
			ON restaurants.id = reviews.restaurant_id
		WHERE reviews.id = " . $_GET["review_id"] . ";";

		$results = $mysqli->query($sql);
		if(!$results){
			echo $mysqli->error;
			exit();
		}

		$row = $results->fetch_assoc();
		$mysqli->close();
		
	}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
    <!-- For Stars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="detail.css">
	<title>Detail</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="row">

<?php if(isset($error) && !empty($error)): ?>
<div class="text-danger">
	<?php echo $error; ?>
</div>
<?php else: ?>

			<div class="detail col col-12 col-md-6">
				<h1><?php echo $row['name'] ?></h1>
				<div class="stars">
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star"></span>
					<span class="fa fa-star"></span>
				</div>
				<h4>Cuisine: <?php echo $row['category']?></h4>
				<h4>Location: <?php echo $row['location']?> </h4>
				<h4>Date: <?php echo $row['date']?> </h4>
				<h4>My Review: </h4>
				<p><?php echo $row['review']?></p>
				<a href="list.php" class="btn btn-5">My List</a>
				<a href="map.php" class="btn btn-5">My Map</a>
				<a href="<?php echo "edit.php?review_id=" . $_GET['review_id'];?>" class="btn btn-5">Edit</a>
			</div>
			<div class=" col col-12 col-md-6 photo">
				<div class="carousel slide carousel-fade" data-ride="carousel">
		            <div class="carousel-inner">
		              <div class="carousel-item active">
		                <img src="<?php echo $row['photo1']?>" class="d-block w-100" alt="photo1">
		              </div>
		              <div class="carousel-item">
		                <img src="<?php echo $row['photo2']?>" class="d-block w-100" alt="photo2">
		              </div>
		              <div class="carousel-item">
		                <img src="<?php echo $row['photo3']?>" class="d-block w-100" alt="photo3">
		              </div>
		            </div>
		            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
		              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		              <span class="sr-only">Previous</span>
		            </a>
		            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
		              <span class="carousel-control-next-icon" aria-hidden="true"></span>
		              <span class="sr-only">Next</span>
		            </a>
		          </div>
		        </div>
			</div>
<?php endif; ?>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>