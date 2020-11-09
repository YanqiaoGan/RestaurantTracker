<?php 

	require "config.php";
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');
		$sql = "SELECT restaurants.name, reviews.review,reviews.id
FROM reviews
LEFT JOIN users
	ON users.id = reviews.user_id
LEFT JOIN restaurants
	ON restaurants.id = reviews.restaurant_id
WHERE users.username = '" . $_SESSION["username"] . "';";
		

		$results = $mysqli->query($sql);
		if(!$results){
			echo $mysqli->error;
			exit();
		}

		$mysqli->close();

	}else{
		header("Location: login.php");
	}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Collection</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="list.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="main-title"><h1>My Collection</h1></div>
	<div class="container">	
		<div class="row">
			<div class="row mb-4">
				<div class="col-12 mt-4">
					<a href="map.php" role="button" class="btn btn-5 btn-light form-btn">View in Map</a>
				</div>
			</div>
		</div>
		<div class="row row-bd title">
			<div class="col-1">	
				<b>No.</b>
			</div>
			<div class="col-2">
				<b>Name</b>
			</div>
			<div class="col-6">
				<b>Review</b>
			</div>
		</div> 
		<!-- <div class="row row-bd"> -->
			<!-- <div class="col-1">
				1.
			</div>
			<div class="col-2">
				<a href="detail.php?review_id=1">Republique</a>
			</div>
			<div class="col-6">
                <p>I'm shocked I haven't left a review for Republique yet, but here I am!</p>	
            </div>
			<div class="col-3">
				<a href="edit.php" class="btn btn-5 btn-light">Delete</a>
				<a href="edit.php" class="btn btn-5 btn-light">Edit</a>
			</div> -->
<?php $index = 1 ?>
<?php while ($row = $results->fetch_assoc()) : ?>
<div class = "row row-bd row-res">
	<div class="col-1"><?php echo $index ?> </div>
	<div class="col-2">
		<!-- <a href="detail.php?review_id=1"> -->
		<a href="<?php echo "detail.php?review_id=" . $row['id'];?>">
			<?php echo $row['name']; ?>
		</a>
	</div>
	<div class="col-6">
		<p><?php echo $row['review']; ?></p>
	</div>
	<div class="col-3">
		<a href="edit.php" class="btn btn-5 btn-light">Delete</a>
		<a href= "<?php echo "edit.php?review_id=" . $row['id'] ?>" class="btn btn-5 btn-light">Edit</a>
	</div>
</div>
	<?php $index = $index+1 ?>

<?php endwhile; ?>


		<!-- </div> -->
	</div>	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>










