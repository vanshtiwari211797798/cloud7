<?php
include("../db.php");
// insert query here


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['full_name'])) {
        echo "
            <script>
                alert('Name is required');
            </script>
        ";
    } elseif (empty($_POST['email'])) {
        echo "
    <script>
        alert('email is required');
    </script>
";
    } elseif (empty($_POST['password'])) {
        echo "
    <script>
        alert('Password is required');
    </script>
";
    } elseif (empty($_POST['c_password'])) {
        echo "
    <script>
        alert('Confirm password is required');
    </script>
";
    } elseif (empty($_POST['address'])) {
        echo "
        <script>
            alert('Address is required');
        </script>
    ";
    } else {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $address = $_POST['address'];

        if ($password == $c_password) {
            $user_fetch = "SELECT * FROM users WHERE email='$email'";
            $data = mysqli_query($conn, $user_fetch);
            if (mysqli_num_rows($data) == 0) {
                $sql = "INSERT INTO users (full_name,email,password,address) VALUES ('$full_name','$email','$password','$address')";
                if (mysqli_query($conn, $sql)) {
                    echo "
                    <script>
                        alert('Registered successfully');
                        window.location.href='login.php';
                    </script>
                ";
                }
            } else {
                echo "
                <script>
                    alert('Allready Registered, please login');
                    window.location.href='login.php';
                </script>
            ";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Pura viewport cover kare */
            background-color: #f4f4f4;
            /* Light background */
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

        /* From Uiverse.io by Yaya12085 */
        .form {
            font-family: poppins;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            margin: 0 auto;
            /* Center the form */
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
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before,
        .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message,
        .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            gap: 30px;
        }

        .flex label {
            flex: 1;
            /* Ensure both labels take equal width */
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            /* Added padding for icons */
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
            /* Ensure padding doesn't affect width */
        }

        .form label .input+span {
            position: absolute;
            left: 40px;
            /* Adjusted for icons */
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown+span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus+span,
        .form label .input:valid+span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid+span {
            color: green;
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

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        /* Font Awesome Icons */
        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(105, 105, 105, 0.397);
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- From Uiverse.io by Yaya12085 -->
    <form class="form" method="post">

        <a href="../../index.php">
            <p class="title">Cloud7</p>
            <span style="font-size: 15px; padding-left: 10px; color: black; letter-spacing: 2px;"> User Registration</span>
            </p>
        </a>
        <p class="message">Signup now and get full access to our Products.</p>
        <div class="flex">
            <label>
                <i class="input-icon fas fa-user"></i>
                <input placeholder="" type="text" name="full_name" class="input">
                <span>FullName</span>
            </label>

            <!-- <label>
                <i class="input-icon fas fa-user"></i>
                <input  placeholder="" type="text" class="input">
                <span>Lastname</span>
            </label> -->
        </div>

        <label>
            <i class="input-icon fas fa-envelope"></i>
            <input placeholder="" name="email" type="email" class="input">
            <span>Email</span>
        </label>

        <label>
            <i class="input-icon fas fa-lock"></i>
            <input placeholder="" name="password" type="password" class="input">
            <span>Password</span>
        </label>
        <label>
            <i class="input-icon fas fa-lock"></i>
            <input placeholder="" name="c_password" type="password" class="input">
            <span>Confirm password</span>
        </label>

        <label>
            <i class="input-icon fas fa-home"></i>
            <input placeholder="" type="text" class="input" name="address">
            <span>Address</span>
        </label>
        <button class="submit">Submit</button>
        <p class="signin">Already have an account? <a href="login.php">Signin</a></p>
    </form>
</body>

</html>