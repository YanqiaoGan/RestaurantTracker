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

		$sql = "UPDATE reviews
		SET date = '" . $_POST['date'] . "', review = '" . $_POST['review'] . "' WHERE id = " . $_POST['review_id'];
		$results = $mysqli->query($sql);
		if(!$results){
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
			Your review was successfully edited.
		</div>

	<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
	</div>
</body>
</html>