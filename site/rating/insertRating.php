<?php
require_once ('connection.php');
session_start();
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$userId = $_SESSION['user_id'];

if (isset($_POST["index"], $_POST["place_id"])) {
    
    $placeId = $_POST["place_id"];
    $rating = $_POST["index"];
    
    $checkIfExistQuery = "select * from place_user where user_id = '" . $userId . "' and place_id = '" . $placeId . "'";
    if ($result = mysqli_query($con, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO place_user(user_id ,place_id, rating) VALUES ('" . $userId . "','" . $placeId . "','" . $rating . "') ";
        $result = mysqli_query($con, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}
