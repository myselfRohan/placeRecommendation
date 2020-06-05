<?php 
		require('connection.php');
    $rs_results = mysqli_query($con,"Select * from place where place_id =".$_GET['id']);
		$place_single =  mysqli_fetch_assoc($rs_results);
		$pic = "admin/images/".$place_single['imageurl'];

		$title = 'DESTINATION DETAIL';
		
		include 'template/indexheader.php';
?>

	<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<?php include 'template/nav.php';?>
		<?php include 'template/headers/headerdetailed.php';?>

		<!-- CONTENT -->
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-md-offset-2">
				<p style="margin-top: 19px;"><?php echo $place_single['information'];?></p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-md-offset-3 text-center" style="font-size: 25px; text-transform:uppercase;">
				<p>You can rate this place after logging in</p>
			</div>
		</div>
	

	<!--==============================footer=================================-->
	<?php include 'template/footer.php'; ?>
	
		
	</body>
</html>