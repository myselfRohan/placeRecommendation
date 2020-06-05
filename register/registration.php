
<?php
	require_once('../connection.php');
    // If form submitted, insert values into the database.
   
		$username = stripslashes($_POST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_POST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
		
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
					echo "<span style='color:green; font-weight:bold;'>
					Registered Sucessfully. You can now login.
					</span>";
				}
				else{
					echo "<span style='color:red; font-weight:bold;'>
					Registration failed
					</span>";
					}
        
   
?>