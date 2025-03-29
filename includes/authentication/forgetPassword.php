<?php
// session_start();
include("../db.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);

    // Check if email exists
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Generate reset token
        $token = bin2hex(random_bytes(50));
        $update_query = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        $conn->query($update_query);

        // Simulate sending email (replace with PHPMailer)
        $reset_link = "https://cloud7perfume.com/includes/authentication/reset_password.php?token=$token";
        if (mail($email, "Password Reset Link", $reset_link, "From:vanshtiwari586@gmail.com")) {
            echo "<script>
            alert('Password reset link send to your email address');
            </script>";
        } else {
            echo "<script>alert('unable to send Password reset link);</script>";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .form {
            font-family: poppins, sans-serif;
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 350px;
            background-color: #fff;
            padding: 25px;
            border-radius: 20px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 24px;
            color: royalblue;
            font-weight: 600;
            text-align: center;
        }

        .message {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
            text-align: center;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(105, 105, 105, 0.5);
            font-size: 16px;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        .links {
            text-align: center;
            font-size: 14px;
        }

        .links a {
            color: royalblue;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form class="form" method="post">
        <p class="title">Forgot Password</p>
        <p class="message">Enter your email to receive a reset link</p>

        <label>
            <i class="input-icon fas fa-envelope"></i>
            <input required type="email" name="email" placeholder="Enter your email" class="input">
        </label>

        <button class="submit">Send Reset Link</button>

        <p class="links"><a href="login.html">Back to Login</a></p>
    </form>
</body>

</html>