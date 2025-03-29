<?php

session_start();
unset($_SESSION['email']); 
// when session delete the redirect to login page
header('Location:login.php');

?>