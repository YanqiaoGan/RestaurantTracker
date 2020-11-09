<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
    <link rel="stylesheet" type= "text/css" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>My Map</title>
	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfS78-OjEJEDC-bxybTXcX2gN0o6xrCmE&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
    	html, body {
            /*color:white;*/
	        height: 100%;
	        margin: 0;
	        padding: 0;
            /*background-color:rgba(220, 118, 51);*/
	        font-family: "Chivo", sans-serif;
	     }

	     h3{
	     	margin-left: 20px;
	     }
    	#map{
    		height:600px;
    		width:100%;	
    	}
    </style>
    <script>
    	function initMap(){
    		const la = {lat: 34.0224 , lng: -118.2851};
    		const map = new google.maps.Map(document.getElementById("map"), {
    			zoom:12,
    			center: la,
    		});
    		const marker = new google.maps.Marker({
    			position:la,
    			map:map,
    		});

    		const contentString='<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h1 id="firstHeading" class="firstHeading">USC</h1>' +
    '<div id="bodyContent">' +
    "<p> View More Information </p>" +
    '<p><a href="detail.php">' +
    "Change to Button</a></p>" +
    "</div>" +
    "</div>";
    		const infowindow = new google.maps.InfoWindow({
    			content: contentString,
    		});

    		google.maps.event.addListener(
    			marker,
    			"click",
    			function(e){
    				// alert("click");
    				map.setZoom(15);
    				map.getCenter(marker.getPosition());
    				infowindow.open(map, marker);
    			}
    		);

            ajaxGet("map_backend.php", function(results){
                // convert results JSON string into JS objects
                results = JSON.parse(results);
                console.log(results);
                for (let i = 0; i < results.length; i++) {
                    let latLng = new google.maps.LatLng(results[i].latitude, results[i].longitude);
                    let new_marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });

                    let temp_contentString='<div id="content">' +
            '<div id="siteNotice">' +
            "</div>" +
            '<h3 id="firstHeading" class="firstHeading">'+results[i].name+'</h3>' +
            '<div id="bodyContent">' +
            '<p> Location: '+ results[i].location+'</p>' +
            '<p><a href="detail.php?review_id='+ results[i].id+'">More Details</a></p>' +
            "</div>" +
            "</div>";
                    let temp_infowindow = new google.maps.InfoWindow({
                        content: temp_contentString,
                    });

                    google.maps.event.addListener(
                        new_marker,
                        "click",
                        function(e){
                            map.setZoom(15);
                            map.getCenter(new_marker.getPosition());
                            temp_infowindow.open(map, new_marker);
                        }
                    );

                }
            });
        }


        function ajaxGet(endpointUrl, returnFunction){
                var xhr = new XMLHttpRequest();
                xhr.open('GET', endpointUrl, true);
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            returnFunction( xhr.responseText );
                        } else {
                            alert('AJAX Error.');
                            console.log(xhr.status);
                        }
                    }
                }
                xhr.send();
            };



    </script>

</head>
<body>
    <?php include 'navbar.php'; ?>
	<h3>My Map</h3>
	<div id="map"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>