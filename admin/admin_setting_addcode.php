<?php
include('../connection.php');
@session_start();
$user=$_SESSION['user_nam'];
$dat=mysqli_real_escape_string($con,date('Y-m-d H:i:s'));

$email_id=mysqli_real_escape_string($con,$_POST['email_id']);
$admin_name=mysqli_real_escape_string($con,$_POST['admin_name']);
$site_name=mysqli_real_escape_string($con,$_POST['site_name']);
//$logo=$_POST['logo'];
//$favicon=$_POST['favicon'];
$site_desc=mysqli_real_escape_string($con,$_POST['site_desc']);
$keyword=mysqli_real_escape_string($con,$_POST['keyword']);
$site_url=mysqli_real_escape_string($con,$_POST['site_url']);

$paypal_id=mysqli_real_escape_string($con,$_POST['paypal_id']);
$cmode=mysqli_real_escape_string($con,$_POST['cmode']);
$smode=mysqli_real_escape_string($con,$_POST['smode']);

$res=mysqli_query($con,"select * from sv_admin_login");
$row=mysqli_num_rows($res);

if($row==0)
{
	$file_name = $_FILES['logo']['name'];
	$random_digit=rand(0000,9999);
	if($file_name!="")
	{		
		$file_name= $random_digit.$file_name;
 		$path= "admin-logo/" .$file_name;
		move_uploaded_file($_FILES['logo']["tmp_name"],$path);
	}
	else 
		$file_name="";
	
	$file_name1 = $_FILES['favicon']['name'];
	$random_digit1=rand(0000,9999);
	if($file_name1!="")
	{		
		$file_name1= $random_digit1.$file_name1;
 		$path= "admin-logo/" .$file_name1;
		move_uploaded_file($_FILES['favicon']["tmp_name"],$path);
	}
	else 
		$file_name1="";
	
	if(mysqli_query($con,"insert into sv_admin_login(email_id,user_name,site_name,logo,site_desc,keyword,favicon,site_url,paypal_id,currency_mode,paypal_site_mode)values('$email_id','$admin_name','$site_name','$file_name','$site_desc','$keyword','$file_name1','$site_url','$paypal_id','$cmode','$smode')"))
		echo "Inserted";
	else
		echo "Server Error";
}
else
{
	$fet=mysqli_fetch_array($res);
	$id=mysqli_real_escape_string($con,$fet['admin_id']);
	//$old_file=$fet['logo'];
	$old_file="admin-logo/".$fet['logo'];
	$file_name = $_FILES['logo']['name'];
	$random_digit=rand(0000,9999);
		if($file_name!="")
		{		
			$file_name= $random_digit.$file_name;
 			$path= "admin-logo/" .$file_name;
			move_uploaded_file($_FILES['logo']["tmp_name"],$path);
			if (file_exists($old_file))
			{
   		 		unlink($old_file);
			}
		}
	 	else 
		{
			//$file_name=$old_file;	
			$old_file=mysqli_real_escape_string($con,$fet['logo']);
			$file_name=mysqli_real_escape_string($con,$old_file);
		}
	
	//$old_file1=$fet['favicon'];
	$old_file1="admin-logo/".$fet['favicon'];
	$file_name1 = $_FILES['favicon']['name'];
	$random_digit1=rand(0000,9999);
		if($file_name1!="")
		{		
			$file_name1= $random_digit1.$file_name1;
 			$path= "admin-logo/" .$file_name1;
			move_uploaded_file($_FILES['favicon']["tmp_name"],$path);
			if (file_exists($old_file1))
			{
   		 		unlink($old_file1);
			}
		}
	 	else 
		{
			//$file_name1=$old_file1;	
			$old_file1=mysqli_real_escape_string($con,$fet['favicon']);
			$file_name1=mysqli_real_escape_string($con,$old_file1);
		}
	
		if(mysqli_query($con,"update sv_admin_login set email_id='$email_id',user_name='$admin_name',site_name='$site_name',logo='$file_name',site_desc='$site_desc',keyword='$keyword',favicon='$file_name1',site_url='$site_url',paypal_id='$paypal_id',currency_mode='$cmode',paypal_site_mode='$smode' where admin_id='$id'")) 
		?>
		<script type="text/javascript">
		var msg="Updated";
		window.location="setting.php?msg="+msg;				
		</script>
		<?php
		//header('Location:setting.php');
}
?>