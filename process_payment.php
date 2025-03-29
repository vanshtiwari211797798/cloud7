<?php
include("includes/db.php"); // Database connection

if (isset($_GET['payment_id'])) {
    // Fetch and sanitize input
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
    $quantity = mysqli_real_escape_string($conn, $_GET['quantity']);
    $sale_price = mysqli_real_escape_string($conn, $_GET['sale_price']);
    $payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);
    $user_name = mysqli_real_escape_string($conn, $_GET['user_name']);
    $user_email = mysqli_real_escape_string($conn, $_GET['user_email']);
    $user_contact = mysqli_real_escape_string($conn, $_GET['user_contact']);
    $user_address = mysqli_real_escape_string($conn, $_GET['user_address']);
    $payment_status = mysqli_real_escape_string($conn, $_GET['payment_status']); // "Success" or "Failed"

    // Insert into orders table
    $query = "INSERT INTO orders (product_id, quantity, sale_price, payment_id, user_name, user_email, user_contact, user_address, payment_status) 
              VALUES ('$product_id', '$quantity', '$sale_price', '$payment_id', '$user_name', '$user_email', '$user_contact', '$user_address', '$payment_status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Order Placed Successfully! Payment ID: $payment_id'); window.location.href='myorders.php';</script>";
    } else {
        echo "<script>alert('Order Failed! Please try again.'); </script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='index.php';</script>";
}
?>
