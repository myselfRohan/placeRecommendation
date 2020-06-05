<?php include("../connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php 
if(isset($_REQUEST['uid']))
	{		
		$uid=mysqli_real_escape_string($con,$_REQUEST['uid']);
		$res=mysqli_query($con,"select * from users where id='$uid'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $username="";  
		  $email="";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);	
			$username=mysqli_real_escape_string($con,$fet['username']);	
			$email=mysqli_real_escape_string($con,$fet['email_id']);	
			
		}		
	}
	else
	{
		$id="";
		$username="";
		$email="";
	}
	$page = 'users';
	$pageTitle = 'Users';

?>


  <body class="splash-index">
   
<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >
		
		  <div class="header"> 
                        <h1 class="page-header">
                            User Details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">User</a></li>
					  
					</ol>		
		</div>
              <input type="hidden" id="hid" name="hid" value="<?php echo $uid;?>">
            <div id="">
			    <div class="panel-body">
				<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Updated Successfully.</div>';
		}
		else if($msg=="Deleted")
			{
		      echo '<div class="succ-msg">Deleted Successfully</div>';		
			}
}
else
	$msg="";
?>
				<!--	<div class="err-msg" id="err_id"><?php echo $msg;?></div>	</div>-->

							<?php if(isset($_REQUEST['uid'])) { ?>
							<form class="form-large" action="javascript:user_funct('update')" accept-charset="UTF-8" method="post">

				<div class="col-lg-3 col-md-3 col-sm-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 table-bg">
                <input type="hidden" id="hid" name="hid" value="<?php echo $uid;?>">

				<div class="col-lg-4 col-md-4 col-sm-4" >
					<div class="form-group">
						<label>User Name</label>	
					<input type="text" id="name" required="required" class="form-control" name="name" value="<?php echo $username;?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
					<label>Email Id</label>									
					<input type="text" id="email_id" required="required" class="form-control" name="email_id" value="<?php echo $email;?>">
					</div>	
				</div>
				
				
					
				
					<div class="col-lg-4 col-md-4 col-sm-4 up-button">
					<button type="submit" class="btn btn-primary" onclick="">Update</button>
					</div>
				</div>
					</form>
					<?php } ?>
				<div class="col-lg-3 col-md-3 col-sm-3"></div>
				</div>

			<div id="page-inner"> 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Users
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
											<th>User Name</th>
											<th>Email Id</th>
											
											<!---<th>City</th>
											<th>Address</th>
											<th>Pin code</th>
											<th>Gender</th>-->
											
											<th>Delete</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php		
									$sno=0;
									$res=mysqli_query($con,"select * from users ORDER BY id DESC");
									while($row=mysqli_fetch_array($res))
									{
										$sno++;
										$id=mysqli_real_escape_string($con,$row['id']);
										$username=mysqli_real_escape_string($con,$row['username']);																				
									?>
									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $username; ?></td>
											<td><?php echo $row['email']; ?></td>
											
											<td><a href="javascript:user_del('<?php echo $id;?>');"><img src="images/delete.png" alt="" title="delete"></a></td>
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
         <!-- /. PAGE WRAPPER  -->	   
   

   </html>
