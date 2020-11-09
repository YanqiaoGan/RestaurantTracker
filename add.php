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
	<title>Add</title>
</head>
<?php 
	$API_KEY = "oyk004fTWUWHpdpYS-z0pDDRWPO5toZF2RUesyjTqq0qX7gfVrv6DfByv4_rrAiTp1flf69of5x2npgZwfu19jLJ7FFWZEx9l9qGqPHkyuaeZO3Lq5SSflWtcPucX3Yx";
	$id = $_GET["id"];

	$response = request();

	function request() {
	    try {
	        $curl = curl_init();
	        if (FALSE === $curl)
	            throw new Exception('Failed to initialize');
	        $url = "https://api.yelp.com/v3/businesses/" . $GLOBALS['id'];
	        // $url="https://api.yelp.com/v3/businesses/h2u-coGd8WWClyU3b7jf8w";
	        curl_setopt_array($curl, array(
	            CURLOPT_URL => $url,
	            CURLOPT_RETURNTRANSFER => true, 
	            CURLOPT_CUSTOMREQUEST => "GET",
	            CURLOPT_HTTPHEADER => array(
	                "authorization: Bearer " . $GLOBALS['API_KEY'],
	                "cache-control: no-cache",
	            ),
	        ));

	        $response = curl_exec($curl);

	        if (FALSE === $response)
	            throw new Exception(curl_error($curl), curl_errno($curl));
	        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	        if (200 != $http_status)
	            throw new Exception($response, $http_status);

	        curl_close($curl);
	    } catch(Exception $e) {
	        trigger_error(sprintf(
	            'Curl failed with error #%d: %s',
	            $e->getCode(), $e->getMessage()),
	            E_USER_ERROR);
	    }
	    return $response;
	}
?>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="detail col col-12 col-md-6">
				<h1></h1>
				<hr>
				<hr>
				<div class="stars">
					<span class="fa f1 fa-star"></span>
					<span class="fa f2 fa-star"></span>
					<span class="fa f3 fa-star"></span>
					<span class="fa f4 fa-star"></span>
					<span class="fa f5 fa-star"></span>
				</div>
				<div class="category"></div>
				<div class="location"></div>

				<form action="add_confirmation.php" method="POST">
					
					<h4>Date:</h4>
					<input style="width:60%; display: inline-block;" type="date" class="form-control date" name="date">
					
					<h4>My Review: </h4>
					<textarea placeholder="Enter your review here" name="review" class="review" rows="6" cols="40"></textarea>

					<input type="hidden" name="restaurant" id="restaurant">
					<input type="hidden" name="category" id="category">
					<input type="hidden" name="location" id="location">
					<input type="hidden" name="rating" id="rating">
					<input type="hidden" name="photo1" id="photo1">
					<input type="hidden" name="photo2" id="photo2">
					<input type="hidden" name="photo3" id="photo3">
					<input type="hidden" name="latitude" id="latitude">
					<input type="hidden" name="longitude" id="longitude">
					
					<hr>
					<hr>
					<div>
						<a href="javascript:history.back()" class="btn btn-5">Back</a>
						<button type="submit" class="btn btn-5">Confirm</button>
					</div>
				</form>
			</div>
			<div class=" col col-12 col-md-6 photo">
				<div class="carousel slide carousel-fade" data-ride="carousel">
		            <div class="carousel-inner">
		              <div class="carousel-item active">
		                <img class="d-block w-100 p1">
		              </div>
		              <div class="carousel-item">
		                <img class="d-block w-100 p2">
		              </div>
		              <div class="carousel-item">
		                <img class="d-block w-100 p3">
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
		</div>
	</div>
	<script type="text/javascript">
		displayResults();

		function displayResults(){
			var response = <?php echo $response ?>;
			console.log(response);
			document.querySelector("h1").innerHTML = response.name;
			let category = document.createElement("h4");
			category.innerHTML = "Category: "+response.categories[0].title;
			document.querySelector(".category").appendChild(category);
			let location = document.createElement("h4");
			location.innerHTML = "Location: "+response.location.address1;
			document.querySelector(".location").appendChild(location);
			var stars = response.rating;
			if(stars >= 0.5) document.querySelector(".f1").classList.add("checked");
			if(stars >= 1.5) document.querySelector(".f2").classList.add("checked");
			if(stars >= 2.5) document.querySelector(".f3").classList.add("checked");
			if(stars >= 3.5) document.querySelector(".f4").classList.add("checked");
			if(stars >= 4.5) document.querySelector(".f5").classList.add("checked");
			document.querySelector(".p1").src = response.photos[0];
			document.querySelector(".p2").src = response.photos[1];
			document.querySelector(".p3").src = response.photos[2];

			document.getElementById("restaurant").value = response.name;
			document.getElementById("category").value = response.categories[0].title;
			document.getElementById("location").value = response.location.address1;
			document.getElementById("rating").value = response.rating;
			document.getElementById("photo1").value = response.photos[0];
			document.getElementById("photo2").value = response.photos[1];
			document.getElementById("photo3").value = response.photos[2];
			document.getElementById("latitude").value = response.coordinates.latitude;
			document.getElementById("longitude").value = response.coordinates.longitude;

		}



	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>