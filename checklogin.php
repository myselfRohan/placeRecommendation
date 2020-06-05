<?php
  require('connection.php');
  
  $username = stripslashes($_POST['username']); // removes backslashes
  $username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($con,$password);

  //Checking is user existing in the database or not
  $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";

  $result = mysqli_query($con,$query);
  $rows = mysqli_num_rows($result);


  if($rows==1){
      session_start();
      $result2 = mysqli_fetch_assoc($result);
      $_SESSION['user_id'] =$result2['id'];
      $_SESSION['username'] = $username;
      $_SESSION['logged_in'] = true;
      // echo "The seesion is ".$_SESSION['user_id'];
      // die();

      echo "LoggedIn";
  } else {
    echo "<span style='color:red; font-weight:bold;'>
    Username/Passsword Incorrect!
    </span>";
  }


?>