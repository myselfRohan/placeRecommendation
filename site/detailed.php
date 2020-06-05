<?php 
		require('../connection.php');
		require_once('rating/functions.php');
    error_reporting(0);
    session_start();

	
    $user_id = $_SESSION['user_id'];
    $rs_results = mysqli_query($con,"Select * from place where place_id =".$_GET['id']);
		$place_single =  mysqli_fetch_assoc($rs_results);
		$pic = "../admin/images/".$place_single['imageurl'];

		$title = 'DESTINATION DETAIL';
		
		include '../template/loggedheader.php';
?>

	<body onload="showRestaurantData('rating/getRatingData.php',<?php echo $place_single['place_id'];?>)">

	<div class="gtco-loader"></div>

	<div id="page">
		<?php include '../template/loggednav.php';?>
		<?php include '../template/headers/headerdetailed.php';?>

		<!-- CONTENT -->
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-md-offset-2">
				<p style="margin-top: 19px;"><?php echo $place_single['information'];?></p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-md-offset-3 text-center" style="font-size: 25px;">
					<div class="rating">
					<span id="restaurant_list"></span>
					</div>
			</div>
		</div>
	

	<!--==============================footer=================================-->

	<?php include '../template/loggedfooter.php'; ?>
	
	
		
	</body>
</html>