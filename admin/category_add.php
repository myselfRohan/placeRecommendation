<?php
include('../connection.php');
$type=$_REQUEST['action'];
if($type=='add')
{
	$sname=mysqli_real_escape_string($con,$_REQUEST['sname']);
  if(mysqli_query($con,"insert into category(category_name)values('$sname')"))
	echo "Inserted";
 else
	echo "Server Error";
}
else if($type=='update')
{
	$sname=mysqli_real_escape_string($con,$_REQUEST['sname']);
	$hid=mysqli_real_escape_string($con,$_REQUEST['hid']);
	if(mysqli_query($con,"update category set category_name='$sname' where category_id='$hid'")) 
		echo "Updated";
	else 
		echo "Error";				

}
else if($type=='delete')
{
	$hid=mysqli_real_escape_string($con,$_REQUEST["hid"]);		
	if(mysqli_query($con,"delete from category where category_id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}  

?>