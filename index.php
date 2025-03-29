<?php
session_start();
include 'includes/header.php';
include("includes/db.php");

?>


<div class="slider-container">
    <!-- <div class="slide">
        <img src="assets/images//1.jpeg" alt="">
        <div class="caption">hello caption</div>
    </div> -->


    <?php
    $sqlSlider = "SELECT * FROM slider";
    $sliderData = mysqli_query($conn, $sqlSlider);
    if (mysqli_num_rows($sliderData) > 0) {
        while ($res = mysqli_fetch_assoc($sliderData)) {


    ?>
            <div class="slide">
                <img src="uploads/<?= $res['slider_image'] ?>"
                    alt="slider image" />

            </div>
    <?php
        }
    }
    ?>



    <span class="arrow prev" onclick="controller(-1)">&#10094;</span>
    <span class="arrow next" onclick="controller(1)">&#10095;</span>
</div>



<div class="con">
    <h2 style="text-align:center;">Best Seller Perfumes</h2>
    <div class="product-container">
        <?php
        $sql = "SELECT * FROM product_items LIMIT 4";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            while ($record = mysqli_fetch_assoc($data)) {


        ?>
                <div class="product-card">
                    <div class="discount-badge"><?= $record['discount_percentage'] ?>%</div>
                    <!-- Wishlist Icon -->

                    <a href="add_wishlist.php?id=<?= $record['id'] ?>"><i style="color: blue;" class="wishlist-icon fas fa-heart"></i></a>

                    <div class="product-image-container">
                        <img class="product-image default" src="admin/products_uploads/<?= $record['primary_image_url'] ?>">
                        <img class="product-image hover" src="admin/products_uploads/<?= $record['secondary_image_url'] ?>">
                    </div>
                    <div class="product-title"><?= $record['product_name'] ?></div>

                    <div class="product-rating"><?php

                                                if ($record['rating'] >= 1 && $record['rating'] < 2) {
                                                    echo "★";
                                                } elseif ($record['rating'] >= 2 && $record['rating'] < 3) {
                                                    echo "★★";
                                                } elseif ($record['rating'] >= 3 && $record['rating'] < 4) {
                                                    echo "★★★";
                                                } elseif ($record['rating'] >= 4 && $record['rating'] < 5) {
                                                    echo "★★★★";
                                                } elseif ($record['rating'] >= 5 && $record['rating'] < 6) {
                                                    echo "★★★★★";
                                                } else {
                                                    echo "No Rating";
                                                }

                                                ?>

                    </div>
                    <div class="product-price">₹<?= $record['sale_price'] ?> <span class="original-price">₹<?= $record['product_price'] ?></span> <span class="discount"><?= $record['discount_percentage'] ?>%</span> </div>
                    <div class="action-buttons">
                        <a href="single-product.php?id=<?= $record['id'] ?>"><button>Buy Now</button></a>
                        <a href="add_cart.php?product_id=<?= $record['id'] ?>"><button>Add Cart</button></a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "No Any  Product";
        }
        ?>



    </div>
</div>



<div class="videos-row">
    <div class="video-container">
        <?php
        $fetchVideo = "SELECT * FROM videos";
        $videoData = mysqli_query($conn, $fetchVideo);
        if (mysqli_num_rows($videoData) > 0) {
            while ($response = mysqli_fetch_assoc($videoData)) {


        ?>
                <video class="productVideo" autoplay muted loop>
                    <source src="admin/products_uploads/<?= $response['video'] ?>" type="video/mp4">
                </video>
        <?php
            }
        }
        ?>
    </div>


</div>

<section class="shop-by-category">
    <h2>Shop By Category</h2>
    <p>Explore our premium range of products</p>
    <div class="category-grid">
        <!-- products Category -->
        <?php
        $category_sql = "SELECT * FROM category";
        $category_data = mysqli_query($conn, $category_sql);
        if (mysqli_num_rows($category_data) > 0) {
            while ($responseData = mysqli_fetch_assoc($category_data)) {


        ?>
                <div class="category-item">
                    <a href="product_by_category.php?category=<?= $responseData['name'] ?>">
                        <img src="admin/category/<?= $responseData['image'] ?>" alt="Unisex">
                        <h3><?= $responseData['name'] ?></h3>
                    </a>
                </div>
        <?php
            }
        }
        ?>
    </div>
</section>

<div class="gifting-wrapper">
    <div class="gifting-image-wrapper">
        <img src="https://cloud7perfume.com/uploads/IMG-20231203-WA0027.jpg" alt="Gifting Wooden Box Perfume" class="gifting-image" loading="lazy">
    </div>
    <div class="gifting-content-wrapper">
        <div class="gifting-content-list">
            <div class="gifting-content text-container text--center">
                <h3 class="gifting-heading">Our Gifting Wooden Box Perfumes</h3>
                <div class="gifting-text-wrapper">
                    <p>Test</p>
                    <div class="gifting-button-wrapper">
                        <a href="Gifting.php" class="gifting-button">Indulge Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <h2 style="text-align:center;">Combo Offer</h2>
    <div class="product-container">
        <?php
        $sql = "SELECT * FROM combo_offer LIMIT 8";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            while ($record = mysqli_fetch_assoc($data)) {


        ?>
                <div class="product-card">
                    <div class="discount-badge"><?= $record['discount_percentage'] ?>%</div>
                    <!-- Wishlist Icon -->

                    <a href="add_wishlist_combo.php?id=<?= $record['id'] ?>"><i id="wissIcon" style="color: blue;" class="wishlist-icon fas fa-heart"></i></a>


                    <div class="product-image-container">
                        <img class="product-image default" src="admin/products_uploads/<?= $record['primary_image_url'] ?>">
                        <img class="product-image hover" src="admin/products_uploads/<?= $record['secondary_image_url'] ?>">
                    </div>
                    <div class="product-title"><?= $record['product_name'] ?></div>

                    <div class="product-rating"><?php
                                                // if product rating is 1 the one start, if two then two start ...

                                                if ($record['rating'] >= 1 && $record['rating'] < 2) {
                                                    echo "★";
                                                } elseif ($record['rating'] >= 2 && $record['rating'] < 3) {
                                                    echo "★★";
                                                } elseif ($record['rating'] >= 3 && $record['rating'] < 4) {
                                                    echo "★★★";
                                                } elseif ($record['rating'] >= 4 && $record['rating'] < 5) {
                                                    echo "★★★★";
                                                } elseif ($record['rating'] >= 5 && $record['rating'] < 6) {
                                                    echo "★★★★★";
                                                } else {
                                                    echo "No Rating";
                                                }

                                                ?>

                    </div>
                    <div class="product-price">₹<?= $record['sale_price'] ?> <span class="original-price">₹<?= $record['product_price'] ?></span> <span class="discount"><?= $record['discount_percentage'] ?>%</span> </div>
                    <div class="action-buttons">
                        <a href="single_product_combo.php?id=<?= $record['id'] ?>"><button>Buy Now</button></a>
                        <a href="add_cart_combo.php?product_id=<?= $record['id'] ?>"><button>Add Cart</button></a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No product found";
        }
        ?>


    </div>
</div>





<?php include 'includes/footer.php'; ?>