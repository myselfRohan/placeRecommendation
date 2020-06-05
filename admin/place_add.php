<?php
include('../connection.php');
$type=mysqli_real_escape_string($con,$_REQUEST['typ']);
if($type=='add')
{
	$sname=mysqli_real_escape_string($con,$_POST['sname']);
	$sub_sname=mysqli_real_escape_string($con,$_POST['sub_sname']);
	$information=mysqli_real_escape_string($con,$_POST['price']);	
	$file_name = $_FILES['sub_services_pic']['name'];	
	if($file_name=="")
	{
		echo "select-img";
			header("Location:place.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:place.php?msg="."imgerr");
		}
		else if($_FILES['sub_services_pic']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:place.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "images/" .$file_name;
				move_uploaded_file($_FILES['sub_services_pic']["tmp_name"],$path);
			}
			else 
				$file_name="";		
	
			if(mysqli_query($con,"insert into place(category_name,place_name,information,imageurl)values('$sname','$sub_sname','$information','$file_name')"))
				echo "Inserted";
					header("Location:place.php?msg=".$msg);
		}
	}
}

else if($type=='delete')
{
	$hid=mysqli_real_escape_string($con,$_REQUEST["hid"]);		
	if(mysqli_query($con,"delete from place where place_id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}  
?>