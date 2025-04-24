<?php
session_start();
include('includes/header.php');
include("includes/db.php");
if (!isset($_SESSION['email'])) {
    echo "
   <script>
       alert('Please login');
    window.location.href='includes/authentication/login.php';
   </script>
   ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .wishlist-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .wishlist-header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .wishlist-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .wishlist-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: calc(21%);
            /* 4 items per row */
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .wishlist-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .wishlist-item img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .wishlist-item h3 {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .wishlist-item p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .wishlist-item .price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .wishlist-item .discount {
            color: #28a745;
            font-size: 14px;
        }

        .wishlist-item .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .wishlist-item .actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .wishlist-item .actions .move-to-cart {
            background: #28a745;
            color: white;
        }

        .wishlist-item .actions .move-to-cart:hover {
            background: #218838;
        }

        .wishlist-item .actions .remove {
            background: #dc3545;
            color: white;
        }

        .wishlist-item .actions .remove:hover {
            background: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .wishlist-item {
                width: calc(33.33% - 20px);
                /* 3 items per row */
            }
        }

        @media (max-width: 768px) {
            .wishlist-item {
                width: calc(50% - 20px);
                /* 2 items per row */
            }
        }

        @media (max-width: 480px) {
            .wishlist-item {
                width: 100%;
                /* 1 item per row */
            }
        }
    </style>
</head>

<body>
    <div class="wishlist-container">
        <div class="wishlist-header">
            <i class="fas fa-heart" style="color: blue;"></i> My Wishlist
        </div>
        <div class="wishlist-items">
            <!-- Wishlist Item  -->
            <?php
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $sql = "SELECT * FROM wisslist WHERE user_email='$email'";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($res = mysqli_fetch_assoc($data)) {


            ?>
                    <div class="wishlist-item" style="cursor: pointer;">
                        <img src="admin/products_uploads/<?= $res['product_image'] ?>" alt="Product 1">
                        <h3><?= $res['product_name'] ?></h3>
                        <p class="price">₹<?= $res['sale_price'] ?> <span class="discount">(<?= $res['discount_percentage'] ?>%off)</span></p>

                        <div class="actions">
                            <button class="move-to-cart"><a href="single-product.php?id=<?= $res['shop_id'] ?>" style="text-decoration: none; color:#fff">Order</a></button>
                            <button class="remove"><a href="remove_wisslist.php?id=<?=$res['id']?>" style="text-decoration: none; color:#fff">Remove</a></button>
                        </div>
                    </div>
            <?php
                }
            }else{
                echo "No product";
            }
            ?>

        </div>
    </div>


</body>

</html>
<?php include('includes/footer.php'); ?>