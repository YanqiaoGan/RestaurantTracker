<?php 
	require 'config.php';

	// server side input validation
	if ( !isset($_POST['email']) || empty($_POST['email'])
		|| !isset($_POST['new_user']) || empty($_POST['new_user'])
		|| !isset($_POST['pass']) || empty($_POST['pass']) 
		|| !isset($_POST['pass1']) || empty($_POST['pass1'])) {
		$error = "Please fill out all required fields.";
		var_dump($error);
	}else if($_POST['pass'] != $_POST['pass1']){
		$error = "Your password and confirmation password do not match.";
		var_dump($error);
	}else{
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno){
			echo $mysqli->connect_error;
			exit();
		}

		// check if username or email address is already taken (aka exists in the users table)
		$sql_registered = "SELECT * FROM users WHERE username = '" . $_POST["new_user"] . "' OR email = '" . $_POST["email"] . "';";
		$results_registered = $mysqli->query($sql_registered);
		if(!$results_registered){
			echo $mysqli->error;
			exit();
		}

		// num_rows is the # of matches
		if($results_registered->num_rows > 0){
			$error= "Username or email has been already taken. Please choose another one.";
			var_dump($error);
		}else{
			// Hash the password
			$password = hash("sha256", $_POST["pass"]);

			// To add a new user, INSERT INTO the newly created users table
			$sql = "INSERT INTO users(username, email, password) VALUES('" . $_POST["new_user"] . "','" . $_POST["email"] . "','" . $password . "')";
			var_dump($sql);

			$results = $mysqli->query($sql);
			if(!$results){
				echo $mysqli->error;
				exit();
			}

			// if registered successfully, log in and redirect to search page
			$_SESSION["username"] = $_POST["new_user"];
			$_SESSION["logged_in"] = true;
			header("Location: search_box.php");
		}

		$mysqli->close();

	}

?>