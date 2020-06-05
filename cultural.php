<?php 
		require('connection.php');
	
    error_reporting(0);
    session_start();
    $rs_results = mysqli_query($con,"SELECT * FROM `place` WHERE category_name ='cultural'");
		$place_single =  mysqli_fetch_assoc($rs_results);
		$pic = "admin/images/cultural.jpg";
		$title = 'Cultural';
		
		include 'template/indexheader.php';
?>

	<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<?php include 'template/nav.php';?>
		<?php include 'template/headers/headercategories.php';?>

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
				<a href="detailed.php?id=<?php echo $rs_ratingres["place_id"];?>" class="fh5co-card-item">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="admin/images/<?php echo $rs_ratingres["imageurl"]; ?>" alt="Image" class="img-responsive" style="height:100%; width:100%;">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $i.".  ".$rs_ratingres["place_name"]; ?></h2>
							
							<p><span class="btn btn-primary">Read More</span></p>
						</div>
					</a>
                </div>
                        <?php  
                            }
                        ?>
															
			</div>
		</div>
	</div>

	<!--==============================footer=================================-->
	<?php include 'template/footer.php'; ?>
	
		
	</body>
</html>