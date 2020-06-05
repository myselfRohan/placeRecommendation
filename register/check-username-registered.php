<?php session_start();
	
	require('../connection.php');

	$username 	= mysqli_real_escape_string($con,$_POST['username']);
	if(!empty($username)){

		if(strlen($username) < 5){
		echo "length";
		} else {
			
		$sql = "select email from users where username = '$username'";
		$qry = mysqli_query($con,$sql);

		$numrows  = mysqli_num_rows($qry);

		if($numrows > 0){
			echo "bad";
		}
	}
}
?>