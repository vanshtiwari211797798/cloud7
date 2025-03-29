<?php include('includes/header.php'); ?>

<style>
  /* Debugging: Add a border to the container to check if it's rendered */
  #wolden-container {
    margin-top: 30px;
  }

  #wolden-product-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 20px;
    flex-wrap: wrap;
  }

  #wolden-product-card {
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

  #wolden-product-image-container {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 8px;
  }

  .wolden-product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease-in-out;
  }

  .wolden-product-image.hover {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
  }

  #wolden-product-image-container:hover .wolden-product-image.default {
    opacity: 0;
  }

  #wolden-product-image-container:hover .wolden-product-image.hover {
    opacity: 1;
  }

  #wolden-discount-badge {
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

  #wolden-product-title {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
  }

  #wolden-product-rating {
    color: gold;
  }

  #wolden-product-price {
    font-size: 16px;
    margin: 5px 0;
  }

  #wolden-original-price {
    text-decoration: line-through;
    color: gray;
  }

  #wolden-action-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-top: 10px;
  }

  #wolden-action-buttons button {
    background: black;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100px;
  }

  @media (max-width: 768px) {
    #wolden-product-container {
      padding: 10px;
      gap: 10px;
    }

    #wolden-product-card {
      width: calc(50% - 20px);
    }
  }

  @media (max-width: 480px) {
    #wolden-product-card {
      width: 100%;
    }
  }
</style>

<div id="wolden-container">
  <h2 style="text-align:center;">Our Best Wolden Set Perfumes</h2>
  <div id="wolden-product-container">
    <div id="wolden-product-card">
        <!-- php code here -->
        <?php
        $sql = "SELECT * FROM product_items LIMIT 4";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            while ($res = mysqli_fetch_assoc($data)) {


        ?>
                <div class="product-card">
                    <div class="discount-badge"><?= $res['discount_percentage'] ?>%</div>
                    <!-- Wishlist Icon -->

                    <a href="add_wishlist.php?id=<?= $res['id'] ?>"><i style="color: blue;" class="wishlist-icon fas fa-heart"></i></a>

                    <div class="product-image-container">
                        <img class="product-image default" src="admin/products_uploads/<?= $res['primary_image_url'] ?>">
                        <img class="product-image hover" src="admin/products_uploads/<?= $res['secondary_image_url'] ?>">
                    </div>
                    <div class="product-title"><?= $res['product_name'] ?></div>

                    <div class="product-rating"><?php

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

                                                ?>

                    </div>
                    <div class="product-price">₹<?= $res['sale_price'] ?> <span class="original-price">₹<?= $res['product_price'] ?></span> <span class="discount"><?= $res['discount_percentage'] ?>%</span> </div>
                    <div class="action-buttons">
                        <a href="single-product.php?id=<?= $res['id'] ?>"><button>Buy Now</button></a>
                        <a href="add_cart.php?product_id=<?= $res['id'] ?>"><button>Add Cart</button></a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
  </div>
</div>
<?php include('includes/footer.php'); ?>