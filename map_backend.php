<?php
require "config.php";
    //if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $mysqli->set_charset('utf8');
        $sql = "SELECT restaurants.name, restaurants.location, restaurants.latitude, restaurants.longitude, reviews.id
FROM reviews
LEFT JOIN users
    ON users.id = reviews.user_id
LEFT JOIN restaurants
    ON restaurants.id = reviews.restaurant_id
WHERE users.username = '" . $_SESSION['username'] . "';";

        $results = $mysqli->query($sql);
        if(!$results){
            echo $mysqli->error;
            exit();
        }

        $results_array=[];
        while($row = $results->fetch_assoc()){
            array_push($results_array, $row);
        }

        echo json_encode($results_array);

        $mysqli->close();

    //}else{
    //    header("Location: login.php");
    //}
?>