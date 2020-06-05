<?php 
		require('../connection.php');
	
    error_reporting(0);
    session_start();
    $rs_results = mysqli_query($con,"SELECT imageurl FROM `place` ORDER BY RAND() LIMIT 16");
		$place_single =  mysqli_fetch_assoc($rs_results);

		$title = 'Gallery';
		
		include '../template/loggedheader.php';
?>

	<body>

	<div class="gtco-loader"></div>

	<div id="page">
  <?php include '../template/loggednav.php';?>
		<?php include '../template/headers/headergallery.php';?>

		<!-- CONTENT -->
    <div class="gtco-section">
		<div class="gtco-container">
		
			<div class="row">
											<?php
                        $i = 0;
                            // var_dump(mysqli_fetch_assoc($rs_resultforrec));
                            while ($rs_ratingres = mysqli_fetch_assoc($rs_results)){
                            $i++;
                        ?>


				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="../admin/images/<?php echo $rs_ratingres["imageurl"]; ?>" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="../admin/images/<?php echo $rs_ratingres["imageurl"]; ?>" alt="Image" class="img-responsive" style="height: 100%; width:100%;">
						</figure>
					</a>
				</div>

			
                        <?php  
                            }
                        ?>
															
			</div>
		</div>
	</div>

	<!--==============================footer=================================-->
	<?php include '../template/loggedfooter.php'; ?>
	
		
	</body>
</html>