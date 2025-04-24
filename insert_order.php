<?php
session_start();
include('includes/db.php');


$data = json_decode(file_get_contents("php://input"), true);

$userEmail = $_SESSION['email'] ?? '';
$name = $data['name'];
$email = $data['email'];
$contact = $data['contact'];
$address = $data['address'];
$paymentId = $data['razorpay_payment_id'];

if ($userEmail) {
    $cartItems = mysqli_query($conn, "SELECT * FROM mycarts WHERE user_email='$userEmail'");
    while ($item = mysqli_fetch_assoc($cartItems)) {
        $productId = $item['product_id'];
        // $productName = $item['product_name'];
        $price = $item['product_price'];
        $quantity = $item['product_quantity'];
        // $image = $item['primary_image_url'];

        $orderSql = "INSERT INTO orders (user_name, user_email, user_contact, user_address, product_id,  sale_price, quantity, payment_id)
                    VALUES ('$name', '$email', '$contact', '$address', '$productId', '$price', '$quantity', '$paymentId')";
        mysqli_query($conn, $orderSql);
    }

    // Optional: Empty the cart
    mysqli_query($conn, "DELETE FROM mycarts WHERE user_email='$userEmail'");

    echo "Order saved";
} else {
    echo "No user logged in";
}
?>
