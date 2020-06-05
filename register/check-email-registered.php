<?php session_start();
	
	require('../connection.php');

	$email = mysqli_real_escape_string($con,$_POST['email']);
	if(!empty($email)){
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			
			echo "invalid";
			
		} 
	else{
	
		$sql = "select email from users where email = '$email'";
		$qry = mysqli_query($con,$sql);

		$numrows  = mysqli_num_rows($qry);

		if($numrows > 0){
			echo "bad";
		}
	}
}
?>