<?php
session_start();
include("../db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        echo "
            <script>
                alert('Email is required');
            </script>
        ";
    } elseif (empty($_POST['password'])) {
        echo "
        <script>
            alert('Password is required');
        </script>
    ";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $record = mysqli_fetch_assoc($data);
            if ($record['role'] == 0) {
                $_SESSION['email'] = $record['email'];
                $_SESSION['username']=$record['full_name'];
                $_SESSION['address']=$record['address'];
                echo "
                    <script>
                        alert('User Login Successfully');
                        window.location.href='../../index.php';
                    </script>
                ";
            } elseif ($record['role'] == 1) {
                $_SESSION['admin_email'] = $record['email'];
                echo "
                <script>
                    alert('Admin Login Successfully');
                    window.location.href='../../admin/dashboard.php';
                </script>
            ";
            } else {
            }
        } else {
            echo "
            <script>
                alert('Unable to login, try again');
            </script>
        ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        a {
            text-decoration: none;
            /* Underline hatane ke liye */
            color: #007bff;
            /* Default blue color */
            font-weight: bold;
            font-size: 16px;
        }


        .form {
            font-family: poppins, sans-serif;
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 450px;
            height: 470px;
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
            font-size: 28px;
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

        .remember {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: rgba(88, 87, 87, 0.822);
        }

        .remember input {
            margin-right: 8px;
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

        .divider {
            text-align: center;
            margin: 10px 0;
            font-size: 14px;
            color: rgba(88, 87, 87, 0.822);
        }
    </style>
</head>

<body>
    <form class="form" method="post">
        <a href="../../index.php">
            <p class="title">Cloud7</p>
        </a>
        <p class="message">Sign in to start your session</p>

        <label>
            <i class="input-icon fas fa-envelope"></i>
            <input type="email" placeholder="Enter your email" name="email" class="input">
        </label>

        <label>
            <i class="input-icon fas fa-lock"></i>
            <input type="password" placeholder="Enter your password" id="pass" name="password" class="input">
            <img src="../../assets/images/hide1.png" id="eyeicon" height="20px" width="20px" style="position: absolute; top:11px; right:10px; cursor:pointer;" onclick="showPassword()">
        </label>


        <button class="submit">Sign In</button>

        <div>
            <p class="divider">- OR -</p>
            <p class="links"><a href="forgetPassword.php">I forgot my password</a></p>
            <p class="links"><a href="register.php">Register a new membership</a></p>
        </div>
    </form>

    <!-- password hide and show functionality -->

    <script>
        const showPassword = () => {
            let icon = document.getElementById("eyeicon");
            let Inputtype = document.getElementById("pass");
            if (icon.src == 'https://cloud7perfume.com/assets/images/hide1.png') {
                icon.src = "https://cloud7perfume.com/assets/images/view.png";
                Inputtype.type = "text";
            } else {
                icon.src = "https://cloud7perfume.com/assets/images/hide1.png";
                Inputtype.type = "password";
            }

        }
    </script>
</body>

</html>