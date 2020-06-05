<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../connection.php"); ?>
<?php 
if(isset($_REQUEST['category_id']))
	{		
		$category_id=mysqli_real_escape_string($con,$_REQUEST['category_id']);
		$res=mysqli_query($con,"select * from category where category_id='$category_id'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $category_id="";
		  $category_name="";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);	
			$category_name=mysqli_real_escape_string($con,$fet['category_name']);	
		}		
	}
	else
	{
		$category_id="";
		$category_name="";
	}
	$page = 'Categories';
?>

<body>
    <div id="wrapper">
				<?php
					
				 include("top_menu.php"); 
				 ?>
        <!--/. NAV TOP  -->
        <?php include("side_menu.php") ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		  <div class="header"> 
                        <h1 class="page-header">
                            Categories
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Categories</a></li>
					</ol>		
		</div>
		<input type="hidden" id="hid" name="hid" value="<?php echo $category_id;?>">
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
}

else
	$msg="";
?>
<!--<div class="err-msg" id="err_id"><?php echo $msg;?></div>-->	</div>
				<div class="col-lg-3 col-md-3 col-sm-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 table-bg">
                <div class="form-group">
                    <label>Category Name</label>				
					<input type="text" id="sname" class="form-control" name="sname" value="<?php echo $category_name;?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<?php if(isset($_REQUEST['category_id'])) { ?>
					<button type="button" class="btn btn-primary" onclick="javascript:services_funct('update')">Update</button>
					<?php } else { ?>
					<button type="button" class="btn btn-primary" onclick="javascript:services_funct('add')">Add</button>
					<?php } ?>
				</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3"></div>
					</div>
			

		
            <div id="page-inner"> 
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Categories
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Category</th>
											<th>Update</th>
											<th>Delete</th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con,"select * from category ORDER BY category_id DESC");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$category_id=mysqli_real_escape_string($con,$row['category_id']);				
											$category_name=mysqli_real_escape_string($con,$row['category_name']);				
									?> 
									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $category_name; ?></td>
											<td><a href="category.php?category_id=<?php echo $category_id;?>"><img src="images/file_edit.png"  alt="update" title="update" ></a></td>
											<td><a href="javascript:services_del('<?php echo $category_id;?>');"><img src="images/delete.png" alt="" title="delete"></a></td>
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
