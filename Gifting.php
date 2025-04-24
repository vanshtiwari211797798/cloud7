<?php
session_start();
ob_start();
include("includes/db.php");
include('includes/header.php');
$emailData = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>



<style>
    .con {
        padding: 20px;
        background: #f4f4f4;
    }

    .slider-wrapper {
        position: relative;
        overflow: hidden;
    }

    .manual-slider {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
    }

    .product-card {
        flex: 0 0 auto;
        width: 300px;
        margin-right: 15px;
        background: white;
        height: 450px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .product-image-container {
        height: 240px;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        transition: 0.4s;
    }

    .product-image.hover {
        opacity: 0;
    }

    .product-card:hover .product-image.default {
        opacity: 0;
    }

    .product-card:hover .product-image.hover {
        opacity: 1;
    }

    .slider-buttons {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        z-index: 10;
    }

    .slider-buttons button {
        background-color: rgb(0 0 0 / 19%);
        color: white;
        border: none;
        /* font-size: 20px; */
        padding: 10px;
        cursor: pointer;
        border-radius: 9%;
    }

    .discount-badge {
        font-size: 12px;
        background: red;
        color: white;
        padding: 2px 6px;
        display: inline-block;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .wishlist-icon {
        float: right;
    }

    .product-title {
        font-weight: bold;
        margin-top: 10px;
    }

    .product-price {
        margin-top: 5px;
    }

    .original-price {
        text-decoration: line-through;
        margin-left: 5px;
        color: gray;
    }
</style>

<div class="con">
    <h2 style="text-align:center;">Best Seller Perfumes</h2>

    <div class="slider-wrapper">
        <!-- Slider Buttons -->
        <div class="slider-buttons">
            <button onclick="slideLeft()">&#10094;</button>
            <button onclick="slideRight()">&#10095;</button>
        </div>

        <!-- Slider Content -->
        <div class="manual-slider" id="productSlider">
            <?php
            $sql = "SELECT * FROM product_items LIMIT 4";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($record = mysqli_fetch_assoc($data)) {
                    $color = "black";
                    $dataWiss = "SELECT * FROM wisslist WHERE shop_id='{$record['id']}' AND user_email='{$emailData}'";
                    $checkData = mysqli_query($conn, $dataWiss);
                    if (mysqli_num_rows($checkData) > 0) {
                        $color = "blue";
                    }
            ?>
                    <div class="product-card" onclick="navigateBuyPage(<?= $record['id'] ?>)">
                        <div class="discount-badge"><?= $record['discount_percentage'] ?>% OFF</div>
                        <a href="add_wishlist.php?id=<?= $record['id'] ?>">
                            <i style="color: <?= $color ?>;" class="wishlist-icon fas fa-heart"></i>
                        </a>
                        <div class="product-image-container">
                            <img class="product-image default" src="admin/products_uploads/<?= $record['primary_image_url'] ?>">
                            <img class="product-image hover" src="admin/products_uploads/<?= $record['secondary_image_url'] ?>">
                        </div>
                        <div class="product-title"><?= $record['product_name'] ?></div>
                        <div class="product-rating">
                            <?php
                            $rating = intval($record['rating']);
                            echo str_repeat("★", $rating) ?: "No Rating";
                            ?>
                        </div>
                        <div class="product-price">
                            ₹<?= $record['sale_price'] ?>
                            <span class="original-price">₹<?= $record['product_price'] ?></span>
                        </div>
                        <div class="action-buttons">
                            <a href="single-product.php?id=<?= $record['id'] ?>"><button>View</button></a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No Any Product";
            }
            ?>
        </div>
    </div>
</div>
<script>
    const slider = document.getElementById('productSlider');
    const cardWidth = 265; // Adjust according to card + margin

    function slideRight() {
        slider.scrollBy({
            left: cardWidth,
            behavior: 'smooth'
        });
    }

    function slideLeft() {
        slider.scrollBy({
            left: -cardWidth,
            behavior: 'smooth'
        });
    }
</script>





<?php include('includes/footer.php'); ?>