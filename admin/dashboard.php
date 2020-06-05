<!DOCTYPE html>
 
<?php include("../connection.php");
@session_start();
if(!isset($_SESSION['user_nam']))
	header("Location:index.php");
else
{		
	$user_name=mysqli_real_escape_string($con,$_SESSION['user_nam']);			
	$res=mysqli_fetch_array(mysqli_query($con,"select * from sv_admin_login where user_name='$user_name'"));
	$uname=mysqli_real_escape_string($con,$res['user_name']);
}	
$page = 'dashboard';
$pageTitle = "Dashboard"
?>


<html xmlns="http://www.w3.org/1999/xhtml">

<body>
    <div id="wrapper">
        <?php include("top_menu.php") ?>
       
	    <!-- /. NAV SIDE  -->
		<?php include("side_menu.php") ?>
	   
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Dashboard 
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Dashboard</a></li>
					 
					</ol> 
									
		</div>
            <div id="page-inner">

                <!-- /. ROW  -->
				<?php 
				$curr_date=date("Y-m-d");
				
				$query2=mysqli_query($con,"select * from users");
				$num2=mysqli_num_rows($query2);
				
				?>
                <div class="row">
                    
                    
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-left pull-left blue">
                                <i class="fa fa-users fa-5x"></i>
                               
                            </div>
                             <div class="panel-right">
								<h3><?php echo $num2; ?></h3>
                               <strong> Total no of Users</strong>

                            </div>
                        </div>
                    </div>
                    
                </div>
			
			
			<!DOCTYPE HTML>
<html>


		
	

			
                <!-- /. ROW  -->
				
		<div class="col-lg-12" style="margin-top:50px;">		
		<?php include("footer.php") ?></div>
        	</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    
</body>

</html>