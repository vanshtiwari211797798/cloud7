<?php
// Error reporting
error_reporting(E_ALL & ~E_NOTICE);

// Set default timezone
date_default_timezone_set('Asia/Kolkata');

// Define database credentials
$host = 'localhost';
$db_name = 'u579170174_cloud7';
$db_user = 'u579170174_cloud7';
$db_pass = 'oX3;UQ~B+gx';

// For local development, you can use this:
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $db_user = 'root';       // Localhost username
    $db_pass = '';           // Localhost password
    $db_name = 'u579170174_cloud7';     // Local database name
}

// Create a single connection
$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the domain (adjust it based on your environment)
$domain = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'http://localhost/' : 'http://www.dagtc.com/portal/';

// You can set any initial message if needed
$message = '';
?>
