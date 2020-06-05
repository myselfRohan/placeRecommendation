<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['logged_in']);
session_destroy();
// echo $_SESSION['user_id'];
header("Location: index.php"); // Redirecting To Home Page
?>