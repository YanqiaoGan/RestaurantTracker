<?php 
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
</head>
<body>
	<video poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" playsinline autoplay muted loop>
		<source src="http://thenewcode.com/assets/videos/polina.webm" type="video/webm">
		<source src="http://thenewcode.com/assets/videos/polina.mp4" type="video/mp4">
	</video>

	
	<div id="container">
		<h1>Restuarant Tracker</h1>
		<p>Do you wanna make a list of the restuarants that you have been?</p>
		<button onclick="location.href='login.php'" type="button" >Get Started</button>
	</div>
</body>
</html>