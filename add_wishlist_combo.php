<?php
session_start();
include("includes/db.php");
if (!isset($_GET['id'])) {
    header('Location:index.php');
} else {
    if (isset($_SESSION['email'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM combo_offer WHERE id=$id";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $res = mysqli_fetch_assoc($data);
            // print_r($res);
            // die();
            $product_name = $res['product_name'];
            $discount_percentage = $res['discount_percentage'];
            $sale_price = $res['sale_price'];
            $product_image = $res['primary_image_url'];
            // print_r($sale_price);
            // die();
            $wishList_sql = "SELECT * FROM wisslist WHERE shop_id='$id' AND user_email='$email'";
            $wishList_data = mysqli_query($conn, $wishList_sql);
            if (mysqli_num_rows($wishList_data) == 0) {
                $sql2 = "INSERT INTO wisslist (shop_id, user_email, product_name, discount_percentage, sale_price, product_image) VALUES ('$id','$email','$product_name','$discount_percentage','$sale_price','$product_image')";
                if (mysqli_query($conn, $sql2)) {
                    echo "
                            <script>
                                alert('Added successfully');
                                window.location.href='Wishlist.php';
                            </script>
                        ";
                }
            } else {
                $comboWissDelete = "DELETE FROM wisslist WHERE shop_id='$id' AND user_email='$email'";
                $wishList_data = mysqli_query($conn, $comboWissDelete);
                echo "
                <script>
                    alert('Wisslist Deleted Successfully');
                    window.location.href='index.php';
                </script>
            ";
            }
        } else {
            echo "No product found";
        }
    } else {
        echo "
        <script>
            alert('Please Login');
            window.location.href='includes/authentication/login.php';
        </script>
    ";
    }
}
