<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../connection.php"); ?>
<?php 
if(isset($_REQUEST['sub_id']))
	{		
		$sub_id=mysqli_real_escape_string($con,$_REQUEST['sub_id']);
		$res=mysqli_query($con,"select * from place where place_id='$sub_id'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $category_id="";
		  $category_name="";
		  $place_name="";
		  $information="";
		  $imageurl="";
		  $typ="add";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);	
			$category_name=mysqli_real_escape_string($con,$fet['category_name']);	
			$place_id=mysqli_real_escape_string($con,$fet['place_id']);
			// $query=mysqli_fetch_array(mysqli_query($con,"select * from sv_services where services_id='$sname'"));
			// $services_name=mysqli_real_escape_string($con,$fet['services_name']);
			$place_name=mysqli_real_escape_string($con,$fet['place_name']);
			$information=mysqli_real_escape_string($con,$fet['information']);
			$imageurl=mysqli_real_escape_string($con,$fet['imageurl']);
			$typ="update";
		}		
	}
	else
	{
			$category_id="";
		  $category_name="";
		  $place_name="";
		  $information="";
		  $imageurl="";
		  $typ="add";
	}
	$pageTitle = 'Add Place';

?>

<body>
    <div id="wrapper">
        <?php include("top_menu.php") ?>
        <!--/. NAV TOP  -->
        <?php include("side_menu.php") ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		  <div class="header"> 
                        
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Add Place</a></li>
					</ol>		
		</div>
		<input type="hidden" id="hid" name="hid" value="<?php echo $sub_id;?>">
            <div id="page-inner">
			    <div class="panel-body">
				<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{
		      echo '<div class="succ-msg">Inserted Successfully.</div>';
		}
		else if($msg=="Updated")
		{
		     echo '<div class="succ-msg">Updated Successfully</div>';		
		}
		else if($msg=="Deleted")
		{
		     echo '<div class="succ-msg">Deleted Successfully</div>';		
		}
		else if($msg=="select-img")
		{
		    echo '<div class="err-msg">Please select Sub services Image</div>';		
		}		
		else if($msg=="imgerr")
		{
		    echo '<div class="err-msg">Select only jpeg, jpg, png image format</div>';		
		}
		else if($msg=="size-err")
		{
		    echo '<div class="err-msg">Ad image is greather than 1 MB</div>';		
		}
}
else
	$msg="";
?>
	</div>
	<form class="" name="service_s" id="service_s" method="post" enctype="multipart/form-data" action="place_add.php">
			<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="hid" name="hid" value="<?php echo $sub_id;?>">

					<div class="col-lg-12 col-md-12 col-sm-12"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 table-bg">
                <div class="col-lg-6 col-md-6 col-sm-6">
					<div class="form-group">
					<label>Category</label>	
				<select id="sname" name="sname" class="form-control" required>
					<option value="">select category</option>
					<?php		
						$res=mysqli_query($con,"select * from category");
						while($row=mysqli_fetch_array($res))
						{
					?>
					<option value="<?php echo $row['category_name'];?>" <?php if(isset($_REQUEST['sub_id'])) {if($category_name==$row['category_name']) echo "selected='selected'";} ?>> <?php echo $row['category_name'];?> </option>
					
					<?php
						}
					?>
				</select></div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<div class="form-group">
					<label>Place Name</label>	
					<input type="text" id="sub_sname" required class="form-control" name="sub_sname" value="<?php echo $place_name; ?>">
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="form-group">
					<label>Description</label>	
					<textarea  id="price" rows="4" cols="100" required="required" class="form-control" name="price" value="<?php echo $price; ?>"></textarea>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="form-group">
					<label>Upload Image</label>	
					<input type="file" id="sub_services_pic" class="form-control" name="sub_services_pic" value="<?php echo $price; ?>">
				</div>	
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 " >
				<input type="submit" value="Submit" class="btn btn-warning">
					
				</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3"></div>
					</div>
					</form>
		
            <div id="page-inner"> 
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Sub Services
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Category Name</th>
											<th>Place Name</th> 
											
											<th>Sub_sevices_images</th>
											
											<th>Delete</th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con,"select * from place order by place_id DESC");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$place_id=mysqli_real_escape_string($con,$row['place_id']);				
											// $category_id=mysqli_real_escape_string($con,$row['category_id']);	
											// $query=mysqli_fetch_array(mysqli_query($con,"select * from category where category_id='$category_id'"));
											$category_name=mysqli_real_escape_string($con,$row['category_name']);	
											$place_name=mysqli_real_escape_string($con,$row['place_name']);
									?> 
									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $category_name; ?></td>
											<td><?php echo $place_name; ?></td>
											
											<td><?php if($row['imageurl']=="") { ?>-<?php } else { ?><img src="images/<?php echo $row['imageurl'];?>" style="width:70px;height:70px;"><?php } ?></td>
											
											<td><a href="javascript:place_del('<?php echo $place_id;?>');"><img src="images/delete.png" alt="" title="delete"></a></td>
										</tr>
										<?php } ?>		
									</tbody>															
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                   </div>
				   				<?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
        
   
</body>

</html>
