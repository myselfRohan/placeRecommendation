<?php
require_once "connection.php";
require_once "functions.php";
session_start();
error_reporting(0);
if($_SESSION['user_id']){
$user_id = $_SESSION['user_id'];
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user 


$rs_results = mysqli_query($con,"Select * from place where place_id =".$_POST['place_id']);
$place_single =  mysqli_fetch_assoc($rs_results);
// // var_dump($place_single);

		            $outputString = '';


							$userRating = userRating($user_id, $place_single['place_id'], $con);
							// var_dump($userRating);
							
							$totalRating = totalRating($place_single['place_id'], $con);
							$outputString .= '
									<div class="row-item">
					 <div class="row-title">Rate this place:</div> <div class="response" id="response-' . $place_single['place_id'] . '"></div>
					 <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $place_single['place_id'] . ',' . $userRating . ');"> ';
							
							for ($count = 1; $count <= 5; $count ++) {
									$starRatingId = $place_single['place_id'] . '_' . $count;
									
									if ($count <= $userRating) {
											
											$outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
									} else {
											$outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $place_single['place_id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $place_single['place_id'] . ',' . $count . ');">&#9733;</li>';
									}
							} // endFor
							
					    $outputString .= '
					 		</ul>
							<p class="review-note">Total Reviews: ' . $totalRating . '</p>
							</div>';
					
						echo $outputString;
}
						?>
					