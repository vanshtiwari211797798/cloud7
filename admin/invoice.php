<?php include('../includes/db.php'); ?>
<?php
// Start session and include database connection
session_start();

if (isset($_GET['order_id'])) {
    $orderId = intval($_GET['order_id']);

    // Fetch order details from the database
    $sql = "
    SELECT o.*, p.product_name 
    FROM orders o 
    LEFT JOIN product_items p ON o.product_id = p.id 
    WHERE o.order_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $orderId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    $productName = $order['product_name'];
} else {
    die("Order not found.");
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Invoice</h3>
            </div>
            <div class="card-body">
                <h5>Order Details</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($order['user_email']); ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo htmlspecialchars($order['user_contact']); ?></td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($order['user_address']); ?></td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>₹<?php echo htmlspecialchars($order['quantity']); ?></td>
                    </tr>
                    <tr>
                        <th>Sale Price</th>
                        <td><?php echo htmlspecialchars($order['sale_price']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td><?php echo htmlspecialchars($order['payment_status']); ?></td>
                    </tr>
                    <tr>
                        <th>Delivery Status</th>
                        <td><?php echo htmlspecialchars($order['delivery_status']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment ID</th>
                        <td><?php echo htmlspecialchars($order['payment_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer text-center no-print">
                <button onclick="window.print();" class="btn btn-primary">Print Invoice</button>
            </div>
        </div>
    </div>
</body>
</html>

