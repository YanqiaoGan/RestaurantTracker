<?php 
	require 'config.php';
	if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]){
		if(isset($_POST["user"]) && isset($_POST["password"])){
			if ( empty($_POST['user']) || empty($_POST['password']) ) {
				$error = "Please enter username and password.";
			} else {
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				if($mysqli->connect_errno) {
					echo $mysqli->connect_error;
					exit();
				}
				$passwordInput = hash("sha256", $_POST["password"]);
				$sql = "SELECT * FROM users
							WHERE username = '" . $_POST['user'] . "' AND password = '" . $passwordInput . "';";
				echo "<hr>" . $sql . "<hr>";
				$results = $mysqli->query($sql);
				if(!$results) {
					echo $mysqli->error;
					exit();
				}
				// if we get 1 result back, means it's correct
				if($results->num_rows > 0) {
					// set session variables to remember this user
					$_SESSION["username"] = $_POST["user"];
					$_SESSION["logged_in"] = true;
					// Redirect user to the home page
					header("Location: search_box.php");
				}else {
					$error = "Invalid username or password.";
					//var_dump($error);
				}
			}
		}
	}else{
		// redirect user
		header("Location: search_box.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type= "text/css" href="main.css">
	<link rel="stylesheet" type= "text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">

	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<div>
		<nav class="navbar navbar-expand-md navbar-light ">
        	<a class="navbar-brand" href="search_box.php">Restuarant Tracker</a>
        	<a class="navbar-brand">Please log in or sign up to continue :)</a>
      	</nav>
	</div> 
	<!-- <?php include 'navbar.php'; ?> -->

	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
			<div class="login-form">
				<form action="index.php" method="POST">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="user" name="user" type="text" class="input">
						</div>
						<div class="group">
							<label for="password" class="label">Password</label>
							<input id="password" name="password" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign In">
						</div>

					</div>
				</form>
				<form action="register_confirmation.php" method="POST">
					<div class="sign-up-htm">
						<div class="group">
							<label for="new_user" class="label">Username</label>
							<input id="new_user" name="new_user" type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" name="pass" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="pass1" class="label">Repeat Password</label>
							<input id="pass1" name="pass1" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="email" class="label">Email Address</label>
							<input id="email" name="email" type="text" class="input">
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign Up">
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- <footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h6>About</h6>
					<p class="text-justify">About ...</p>
				</div>
				<div class="col-sm-12 col-md-6">
					<h6>Editor's Choice</h6>
					<ul class="footer-links">
						<li><a href="https://republiquela.com/">Republique</a></li>
						<li><a href="https://alfred.la/">Alfred Coffee</a></li>
						<li><a href="https://bluebottlecoffee.com/?gclsrc=aw.ds&&gclid=CjwKCAjw8-78BRA0EiwAFUw8LFFFU_NoiUg-puWt32ma2ivddpT8XspFxJPzgNM9r-5Bw7IpFYX71RoC5cAQAvD_BwE&gclsrc=aw.ds">Blue Bottle</a></li>
					</ul>
				</div>
			</div>
			<hr>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<p class="copyright">Copyright &copy; 2020 All rights Reserved by Monica Gan.</p>
				</div>
			</div>
		</div>
	</footer>	 -->

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>