<?php

function userRating($userId, $placeId, $con)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM place_user WHERE user_id = '" . $userId . "' and place_id = '" . $placeId . "'";
    $total_row = 0;
    
    if ($result = mysqli_query($con, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf
    
    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}
 // endFunction
function totalRating($placeId, $con)
{
    $totalVotesQuery = "SELECT * FROM place_user WHERE place_id = '" . $placeId . "'";
    
    if ($result = mysqli_query($con, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf
    
    return $rowCount;
}//endFunction
