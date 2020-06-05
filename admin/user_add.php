<?php
include('../connection.php');
$type=mysqli_real_escape_string($con,$_REQUEST['action']);
if($type=='update')
{
	$username=mysqli_real_escape_string($con,$_REQUEST['username']);
	$email=mysqli_real_escape_string($con,$_REQUEST['email_id']);
	$phone_no=mysqli_real_escape_string($con,$_REQUEST['phone_no']);
	$city=mysqli_real_escape_string($con,$_REQUEST['city']);
	$address=mysqli_real_escape_string($con,$_REQUEST['address']);
	$pin_code=mysqli_real_escape_string($con,$_REQUEST['pin_code']);
	$gender=mysqli_real_escape_string($con,$_REQUEST['gender']);

	$hid=mysqli_real_escape_string($con,$_REQUEST['hid']);
	if(mysqli_query($con,"update sv_user_profile set name='$name',email_id='$email_id',phone_no='$phone_no',city='$city',address='$address',pin_code='$pin_code',gender='$gender' where signup_id='$hid'")) 
		echo "Updated";
	else 
		echo "Error";
  
}
else if($type=='delete')
{
	$hid=mysqli_real_escape_string($con,$_REQUEST["hid"]);		
	if(mysqli_query($con,"delete from users where id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}  

?>