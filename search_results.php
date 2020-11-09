<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Search Results</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
	<link rel="stylesheet" type= "text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="search_results.css">
	<script type="text/javascript" href="search.js"></script>
</head>

<?php 
$API_KEY = "oyk004fTWUWHpdpYS-z0pDDRWPO5toZF2RUesyjTqq0qX7gfVrv6DfByv4_rrAiTp1flf69of5x2npgZwfu19jLJ7FFWZEx9l9qGqPHkyuaeZO3Lq5SSflWtcPucX3Yx";

$DEFAULT_TERM = "dinner";
$DEFAULT_LOCATION = "Los Angeles";
$SEARCH_LIMIT = 20;

$url_params=array();
$url_param['term'] = $_GET["title"];
$url_param['location'] = $DEFAULT_LOCATION;

$response = request($url_params);

function request($url_params) {
    // Send Yelp API Call
    try {
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');

        $url =  "https://api.yelp.com/v3/businesses/search?" . http_build_query($GLOBALS['url_param']);
        // $url = "https://api.yelp.com/v3/businesses/search?term=republique&location=Los+Angeles";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            // CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
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
	<div class="main-title"><h1>Find Your Restaurant</h1></div>
	<div class="container">	
		<div class="row">
			<div class="row mb-4">
				<div class="col-12 mt-4">
					<a href="search_box.php" role="button" class="btn btn-5 btn-light form-btn">Search</a>
				</div>
			</div>
		</div>
		<div class="row row-bd title">
			<div class="col-3">	
				<b>Name</b>
			</div>
			<div class="col-2">
				<b>Cuisine</b>
			</div>
			<div class="col-5">
				<b>Location</b>
			</div>
			<!-- <div class="col-2">
				<b>Choose</b>
			</div> -->
		</div> 
		<!-- <div class="row row-bd row-res">
			<div class="col-3">
				Republique
			</div>
			<div class="col-2">
				Brunch
			</div>
			<div class="col-5">
				624 South La Brea Ave, Los Angeles, CA 90036
			</div>
			<div class="col-2">
				<a href="edit.php" class="btn btn-5 btn-light">Select</a>
			</div>
		</div>
		<div class="row row-bd row-res">
			<div class="col-3">
				Republique
			</div>
			<div class="col-2">
				Brunch
			</div>
			<div class="col-5">
				624 South La Brea Ave, Los Angeles, CA 90036
			</div>
			<div class="col-2">
				<a href="edit.php" class="btn btn-5 btn-light">Select</a>
			</div>
		</div> -->
	</div>	
	<script type="text/javascript">
		displayResults();

		function displayResults(){
			var response = <?php echo $response ?>;
			console.log(response);
			for(let i = 0; i < response.businesses.length; i++){
				console.log("a");
				let rowElement = document.createElement("div");
				rowElement.classList.add("row");
				rowElement.classList.add("row-bd");
				rowElement.classList.add("row-res");
				let nameElement = document.createElement("p");
				nameElement.innerHTML = response.businesses[i].name;
				let categoryElement = document.createElement("p");
				categoryElement.innerHTML = response.businesses[i].categories[0].title;
				let locationElement = document.createElement("p");
				locationElement.innerHTML = response.businesses[i].location.address1;
				let col1 = document.createElement("div");
				col1.classList.add("col-3");
				col1.appendChild(nameElement);
				let col2 = document.createElement("div");
				col2.classList.add("col-2");
				col2.appendChild(categoryElement);
				let col3 = document.createElement("div");
				col3.classList.add("col-5");
				col3.appendChild(locationElement);
				let col4 = document.createElement("div");
				col4.classList.add("col-2");
				let button =  document.createElement("a");
				button.classList.add("btn");
				button.classList.add("btn-5");
				button.classList.add("btn-light");
				button.href = "add.php?id=" + response.businesses[i].id;
				button.innerHTML = "Select";
				col4.appendChild(button);
				rowElement.appendChild(col1);
				rowElement.appendChild(col2);
				rowElement.appendChild(col3);
				rowElement.appendChild(col4);
				document.querySelector(".container").appendChild(rowElement);
			}

		}
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="search.js"></script> -->
</body>
</html>