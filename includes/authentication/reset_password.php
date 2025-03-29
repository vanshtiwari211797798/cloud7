<?php
session_start();
include("../db.php");

if (!isset($_GET['token'])) {
    die("Invalid request");
}

$token = $_GET['token'];
$query = "SELECT * FROM users WHERE reset_token='$token'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    die("Invalid or expired reset token.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "<script>
        alert('Passwords do not matched');
        </script>";
    } else {

        $update_query = "UPDATE users SET password='$new_password', reset_token=NULL WHERE reset_token='$token'";
        if ($conn->query($update_query)) {
            echo "<script>alert('Password reset successfully, please login'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error resetting password!');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .container {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter new password" required>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>
            <button type="submit" style="cursor: pointer;">Reset Password</button>
        </form>
    </div>
</body>

</html>