<?php

		require "config.php";
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}
		if(isset($_POST['date']) && !empty($_POST['date'])){
			$date = $_POST['date'];
		}else{
			$date = 'null';
		}

		if(isset($_POST['review']) && !empty($_POST['review'])){
			$review = $_POST['review'];
		}else{
			$review = '';
		}

		$sql_check = "SELECT id 
		FROM restaurants
		WHERE name = '" . $_POST['restaurant'] . "' AND location='" . $_POST['location'] . "';";
		$results0 = $mysqli->query($sql_check);
		//var_dump($results0);
		if($results0->num_rows == 0){
			$sql_restaurant = "INSERT INTO restaurants(name, category, location, rating, photo1, photo2, photo3, latitude, longitude)
					VALUES('"
					. $_POST['restaurant']
					. "', '"
					. $_POST['category']
					. "', '"
					. $_POST['location']
					. "', "
					. $_POST['rating']
					. ", '"
					. $_POST['photo1']
					. "', '"
					. $_POST['photo2']
					. "', '"
					. $_POST['photo3']
					. "', "
					. $_POST['latitude']
					. ","
					. $_POST['longitude']
					. ");";

			//var_dump($sql_restaurant);

			$results1 = $mysqli->query($sql_restaurant);
			if ( !$results1 ) {
				echo $mysqli->error;
				exit();
			}
		}

		$sql_userId = "SELECT id
		FROM users
		WHERE username = '" . $_SESSION['username'] . "';";

		$user_result = $mysqli->query($sql_userId);
		if ( !$user_result) {
			echo $mysqli->error;
			exit();
		}

		$sql_restaurantId = "SELECT id
		FROM restaurants
		WHERE name = '" . $_POST['restaurant'] . "' AND location = '" . $_POST['location'] . "';";
		$restaurant_result = $mysqli->query($sql_restaurantId);
		if(!$restaurant_result){
			echo $mysqli->error;
			exit();
		}

		$user_id = $user_result->fetch_assoc()['id'];
		$restaurant_id = $restaurant_result->fetch_assoc()['id'];

		$sql_review = "INSERT INTO reviews(user_id, restaurant_id, date, review)
			VALUES("
			. $user_id
			. ", "
			. $restaurant_id
			. ", '"
			. $date
			. "', '"
			. $review
			. "');";

		$results2 = $mysqli->query($sql_review);
		if ( !$results2 ) {
			echo $mysqli->error;
			exit();
		}

		$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
	<title>Add Confirmation</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

	<?php if ( isset($error) && !empty($error) ) : ?>

		<div class="text-danger">
			<?php echo $error; ?>
		</div>

	<?php else : ?>

		<div class="text-success">
			Your review was successfully added.
		</div>

	<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
	</div>
</body>
</html>