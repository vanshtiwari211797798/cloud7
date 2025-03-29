<?php include 'includes/header.php'; ?>


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
    <h2 style="text-align:center;">Our Best Women Perfumes</h2>
    <div id="discovery-product-container">
        <div id="discovery-product-card">
            <div id="discovery-discount-badge">30%</div>
            <i class="wishlist-icon fas fa-heart" onclick="toggleWishlist(this)"></i>
            <i class="wishlist-icon fas fa-heart" onclick="toggleWishlist(this)"></i>
            <div id="discovery-product-image-container">
                <img class="discovery-product-image default" src="http://localhost/cloud7/uploads/c7p3.jpg" alt="Gifting Perfumes Allure">
                <img class="discovery-product-image hover" src="http://localhost/cloud7/uploads/DSC_1394.JPG" alt="Gifting Perfumes Allure Hover">
            </div>
            <div id="discovery-product-title">Gifting Perfumes Allure</div>
            <div id="discovery-product-rating">★★★★★ (12,487)</div>
            <div id="discovery-product-price">₹629.30 <span id="discovery-original-price">₹899.00</span> <span id="discovery-discount">0%</span> </div>
            <div id="discovery-action-buttons">
                <a href="./single-product.php"><button>Buy Now</button></a>
                <button>Add to Cart</button>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>