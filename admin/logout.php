<?php
session_start();
unset($_SESSION['admin_email']);
header('Location:../includes/authentication/login.php');
?>
