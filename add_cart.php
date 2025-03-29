<?php
session_start();
include("includes/db.php");
include("includes/header.php");
if (isset($_SESSION['email'])) {
    $sale_price_main = '';
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $pro_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
    $fetPro = "SELECT * FROM product_items WHERE id=$pro_id";
    $data_pro_res = mysqli_query($conn, $fetPro);
    if (mysqli_num_rows($data_pro_res) > 0) {
        $res_data = mysqli_fetch_assoc($data_pro_res);
        $sale_price_main = $res_data['sale_price'];
    }
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
    $sale_price = isset($_GET['sale_price']) ? $_GET['sale_price'] : $sale_price_main;
    // $original_price = isset($_GET['original_price']) ? $_GET['original_price'] : '';
    $product_id = mysqli_real_escape_string($conn, $pro_id);
    $user_login_mail = mysqli_real_escape_string($conn, $userEmail);

    $sql = "SELECT * FROM mycarts WHERE user_email='$user_login_mail' AND product_id='$product_id'";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) == 0) {
        $sql2 = "SELECT * FROM product_items WHERE id='$product_id'";
        $data2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($data2) > 0) {
            $product_record = mysqli_fetch_assoc($data2);
            $product_name = $product_record['product_name'];
            $primary_image_url = $product_record['primary_image_url'];
            $product_price = $sale_price;

            $sql3 = "INSERT INTO mycarts (product_id, user_email, product_name, product_quantity, primary_image_url, product_price) VALUES ('$product_id','$user_login_mail','$product_name','$quantity','$primary_image_url','$product_price')";
            if (mysqli_query($conn, $sql3)) {
                echo "
            <script>
                alert('Product added in the cart');
                window.location.href='cart.php';
            </script>
        ";
            }
        }
    } else {
        echo "
        <script>
            alert('Product allready in the cart');
           history.back()
        </script>
    ";
    }
} else {
    echo "
    <script>
        alert('Please login');
        window.location.href='includes/authentication/login.php';
    </script>
";
}
