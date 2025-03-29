<?php
include("includes/db.php");
include 'includes/header.php';
?>


<style>
    /* Debugging: Add a border to the container to check if it's rendered */
    #discovery-container {
        margin-top: 30px;
    }

    #discovery-product-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 20px;
        flex-wrap: wrap;
    }

    #discovery-product-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 340px;
        height: 500px;
        padding: 15px;
        text-align: center;
        position: relative;
        opacity: 1;
        /* Debugging: Ensure opacity is 1 for visibility */
        transform: translateY(0);
        /* Debugging: Reset transform for visibility */
    }

    #discovery-product-image-container {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        border-radius: 8px;
    }

    .discovery-product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
    }

    .discovery-product-image.hover {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    #discovery-product-image-container:hover .discovery-product-image.default {
        opacity: 0;
    }

    #discovery-product-image-container:hover .discovery-product-image.hover {
        opacity: 1;
    }

    #discovery-discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: red;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
        z-index: 2;
    }

    #discovery-product-title {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
    }

    #discovery-product-rating {
        color: gold;
    }

    #discovery-product-price {
        font-size: 16px;
        margin: 5px 0;
    }

    #discovery-original-price {
        text-decoration: line-through;
        color: gray;
    }

    #discovery-action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }

    #discovery-action-buttons button {
        background: black;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 4px;
        width: 100px;
    }

    @media (max-width: 768px) {
        #discovery-product-container {
            padding: 10px;
            gap: 10px;
        }

        #discovery-product-card {
            width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        #discovery-product-card {
            width: 100%;
        }
    }
</style>

<div id="discovery-container">
    <h2 style="text-align:center;">Our Best <?= $_GET['category'] ?> Perfumes</h2>
    <div id="discovery-product-container">
        <?php
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $sql = "SELECT * FROM product_items WHERE best_seller_catrgory='$category'";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            while ($res = mysqli_fetch_assoc($data)) {

        ?>
                <div id="discovery-product-card">
                    <div id="discovery-discount-badge"><?= $res['discount_percentage'] ?>%</div>
                    <a href="add_wishlist.php?id=<?= $res['id'] ?>"><i id="wissIcon" style="color: blue;" class="wishlist-icon fas fa-heart"></i></a>
                    <div id="discovery-product-image-container">
                        <img class="discovery-product-image default" src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt="Gifting Perfumes Allure">
                        <img class="discovery-product-image hover" src="admin/products_uploads/<?= $res['secondary_image_url'] ?>" alt="Gifting Perfumes Allure Hover">
                    </div>
                    <div id="discovery-product-title"><?= $res['product_name'] ?></div>
                    <div id="discovery-product-rating"><?php
                                                        // if product rating is 1 the one start, if two then two start ...

                                                        if ($res['rating'] >= 1 && $res['rating'] < 2) {
                                                            echo "★";
                                                        } elseif ($res['rating'] >= 2 && $res['rating'] < 3) {
                                                            echo "★★";
                                                        } elseif ($res['rating'] >= 3 && $res['rating'] < 4) {
                                                            echo "★★★";
                                                        } elseif ($res['rating'] >= 4 && $res['rating'] < 5) {
                                                            echo "★★★★";
                                                        } elseif ($res['rating'] >= 5 && $res['rating'] < 6) {
                                                            echo "★★★★★";
                                                        } else {
                                                            echo "No Rating";
                                                        }

                                                        ?></div>
                    <div id="discovery-product-price">₹<?= $res['sale_price'] ?> <span id="discovery-original-price">₹<?= $res['product_price'] ?></span> <span id="discovery-discount"><?= $res['discount_percentage'] ?>%</span> </div>
                    <div id="discovery-action-buttons">
                        <a href="single-product.php?id=<?= $res['id'] ?>"><button>Buy Now</button></a>
                        <a href="add_cart.php?product_id=<?= $res['id'] ?>"><button>Add Cart</button></a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No product";
        }
        ?>
    </div>
</div>


<?php include 'includes/footer.php'; ?>