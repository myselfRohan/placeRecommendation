<?php 
    require('connection.php');
    // error_reporting(0);
    // session_start();
    // print_r($_POST['place_name']);
    // die;
    $rs_results = mysqli_query($con,"Select * from place ORDER BY place_id DESC LIMIT 6");
    $rs_toprating = mysqli_query($con, "SELECT p.*, COUNT(c.place_id) rates FROM place p INNER JOIN place_user c ON p.place_id = c.place_id  GROUP BY place_id  
    ORDER BY `rates`  DESC LIMIT 9");
    
    // $place_single =  mysqli_fetch_assoc($rs_results);
    // print_r($place_single);
   
?>


<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Most Popular Destination</h2>
					<p>These are the most popular destination based on rating counts.</p>
				</div>
            </div>
            

			<div class="row">

                        <?php
                        $i = 0;
                            // var_dump(mysqli_fetch_assoc($rs_resultforrec));
                            while ($rs_ratingres = mysqli_fetch_assoc($rs_toprating)){
                            $i++;
                        ?>

				<div class="col-lg-4 col-md-4 col-sm-6">
			
					<a href="detailed.php?id=<?php echo $rs_ratingres["place_id"];?>" class="fh5co-card-item">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="admin/images/<?php echo $rs_ratingres["imageurl"]; ?>" alt="Image" class="img-responsive">
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
            

            <div class="row" style="margin-top:50px">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Recently Added Destination</h2>
					<p>These are the list of destinations that were recently added.</p>
				</div>
            </div>
            

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

