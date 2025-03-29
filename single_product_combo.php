<?php
session_start();
ob_start();
include("includes/db.php");
include 'includes/header.php';
$coupon_code='';
if (!isset($_SESSION['email'])) {
    header('Location:includes/authentication/login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_code = $_POST['coupon_code'];
    $fetch_cpn = "SELECT * FROM coupon WHERE coupon_code='$coupon_code'";
    $cpn_data = mysqli_query($conn, $fetch_cpn);
    if (mysqli_num_rows($cpn_data) == 1) {
        $recordCpn = mysqli_fetch_assoc($cpn_data);
        $coupon_off = $recordCpn['coupon_off'];
    }
}

if (!isset($_GET['id'])) {
    header('Location:index.php');
} else {
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $userName = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $userAdd = isset($_SESSION['address']) ? $_SESSION['address'] : '';
    $pro_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM combo_offer WHERE id='$pro_id'";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) > 0) {
        $res = mysqli_fetch_assoc($data);
    } else {
        echo "
            <script>
                alert('This Product is removed');
                history.back()
            </script>
        ";
    }
}

?>

<?php
$sql = "SELECT * FROM top_offer";
$data = mysqli_query($conn, $sql);
if (mysqli_num_rows($data) > 0) {
    $top_offer_record = mysqli_fetch_assoc($data);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gifting Perfumes Allure</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .product-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Product Images */
        .product-images {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .main-image {
            background-color: #f3f4f6;
            border-radius: 0.375rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .thumbnails {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
        }

        .thumbnail-btn {
            border: 2px solid #e5e7eb;
            border-radius: 0.375rem;
            overflow: hidden;
            width: 4rem;
            height: 4rem;
            padding: 0;
            cursor: pointer;
            background: none;
        }

        .thumbnail-btn.active {
            border-color: #3b82f6;
        }

        .thumbnail-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
        }

        .product-size {
            font-size: 0.875rem;
            color: #4b5563;
            margin-top: 0.25rem;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .current-price {
            font-size: 1.25rem;
            font-weight: 500;
            color: #ef4444;
        }

        .original-price {
            color: #9ca3af;
            text-decoration: line-through;
        }

        .discount {
            color: #4b5563;
        }

        .product-description {
            color: #4b5563;
        }

        /* Quantity Selector */
        .quantity-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .quantity-label {
            font-weight: 500;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            height: 2.5rem;
            width: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 1px solid #d1d5db;
            color: #4b5563;
            cursor: pointer;
        }

        .quantity-btn:first-child {
            border-radius: 0.375rem 0 0 0.375rem;
        }

        .quantity-btn:last-child {
            border-radius: 0 0.375rem 0.375rem 0;
        }

        .quantity-input {
            height: 2.5rem;
            width: 4rem;
            border-top: 1px solid #d1d5db;
            border-bottom: 1px solid #d1d5db;
            border-left: 0;
            border-right: 0;
            text-align: center;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .buy-now-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .buy-now-btn:hover {
            background-color: #1d4ed8;
        }

        .add-to-cart-btn {
            background-color: #16a34a;
            color: white;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .add-to-cart-btn:hover {
            background-color: #15803d;
        }

        /* Service Features */
        .service-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            padding-top: 1rem;
        }

        @media (min-width: 768px) {
            .service-features {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .service-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .service-icon {
            background-color: #f3f4f6;
            padding: 0.5rem;
            border-radius: 9999px;
            margin-bottom: 0.5rem;
            color: #4b5563;
        }

        .service-text {
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="product-grid">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <img id="main-product-image" src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt="Gifting Perfumes Allure">

                    </div>
                    <div class="thumbnails">
                        <button class="thumbnail-btn active" data-index="0">
                            <img src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt="Thumbnail 1">
                        </button>
                        <button class="thumbnail-btn" data-index="1">
                            <img src="admin/products_uploads/<?= $res['secondary_image_url'] ?>" alt="Thumbnail 2">
                        </button>
                        <button class="thumbnail-btn active" data-index="2">
                            <img src="admin/products_uploads/<?= $res['third_image_url'] ?>" alt="Thumbnail 1">
                        </button>
                        <button class="thumbnail-btn" data-index="3">
                            <img src="admin/products_uploads/<?= $res['fourth_image_url'] ?>" alt="Thumbnail 2">
                        </button>
                        <!-- <button class="thumbnail-btn" data-index="2">
                            <img src="https://via.placeholder.com/64" alt="Thumbnail 3">
                        </button>
                        <button class="thumbnail-btn" data-index="3">
                            <img src="https://via.placeholder.com/64" alt="Thumbnail 4">
                        </button> -->
                    </div>
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <div class="product-header">
                        <h1 class="product-title"><?= $res['product_name'] ?></h1>
                        <p class="product-size"><?= $res['quantity'] ?></p>
                    </div>

                    <div class="product-price">
                        <span class="current-price">₹ <?= $res['sale_price'] ?></span>
                        <span class="original-price">₹ <?= $res['product_price'] ?></span>
                        <span class="discount"><?= $res['discount_percentage'] ?>%</span>
                    </div>

                    <p class="product-description"><?= $res['product_discription'] ?>.</p>

                    <!-- Quantity Selector -->
                    <div class="quantity-container">
                        <p class="quantity-label">Product quantity</p>


                        <div class="quantity-selector">
                            <button id="decrease-btn" class="quantity-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                            <input type="text" id="quantity-input" value="1" class="quantity-input">
                            <button id="increase-btn" class="quantity-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- coupon code -->
                    <form action="" method="post">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputFile" style="color: #15803d;">Before select quantity, apply coupon code and get off</label><br>
                                <input type="text" style="padding: 10px 30px 10px 3px;" class="form-control" value="<?=$coupon_code?>" placeholder="Enter coupon code"
                                    id="exampleInputFile" name="coupon_code">
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 15px; padding:10px 45px; cursor:pointer; ">Apply</button>

                        </div>
                    </form>

                    <!-- User Details Modal -->
                    <style>
                        #userDetailsModal {
                            display: none;
                            width: 100%;
                            max-width: 400px;
                            padding: 20px;
                            background: #fff;
                            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                            border-radius: 8px;
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            z-index: 1000;
                            text-align: center;
                        }

                        #userDetailsModal label {
                            display: block;
                            font-weight: 600;
                            margin-bottom: 5px;
                            color: #333;
                            text-align: left;
                        }

                        #userDetailsModal input,
                        #userDetailsModal textarea {
                            width: 100%;
                            padding: 10px;
                            margin-bottom: 15px;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            font-size: 16px;
                            outline: none;
                        }

                        #userDetailsModal textarea {
                            height: 80px;
                            resize: none;
                        }

                        #proceed-payment {
                            width: 100%;
                            background: #28a745;
                            color: white;
                            border: none;
                            padding: 12px;
                            font-size: 18px;
                            font-weight: bold;
                            border-radius: 5px;
                            cursor: pointer;
                            transition: background 0.3s ease;
                        }

                        #proceed-payment:hover {
                            background: #218838;
                        }

                        .modal-overlay {
                            display: none;
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        }
                    </style>

                    <!-- Overlay for background blur -->
                    <div class="modal-overlay" id="modalOverlay"></div>

                    <!-- User Details Form -->
                    <div id="userDetailsModal">
                        <label>Name:</label>
                        <input type="text" value="<?= $userName ?>" id="user-name" readonly>

                        <label>Email:</label>
                        <input type="email" id="user-email" value="<?= $userEmail ?>" readonly>

                        <label>Contact:</label>
                        <input type="tel" id="user-contact" required>

                        <label>Address:</label>
                        <textarea id="user-address" readonly><?= $userAdd ?></textarea>

                        <button id="proceed-payment">Proceed to Payment</button>
                    </div>


                    <!-- Buy Now Button -->
                    <!-- <button class="buy-now-btn">Buy Now</button>
                    <button class="" id="add_cart">Add Cart</button> -->
                    <div class="action-buttons">
                        <button class="buy-now-btn">Buy Now</button>
                        <button class="add-to-cart-btn" id="add_cart">Add to Cart</button>
                    </div>


                    <!-- Service Features -->
                    <div class="service-features">
                        <div class="service-item">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                            <span class="service-text">Delivery Guaranteed</span>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </div>
                            <span class="service-text">Secure Transactions</span>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38"></path>
                                </svg>
                            </div>
                            <span class="service-text">7 Days Easy Return & Refund</span>
                        </div>
                        <div class="service-item">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <span class="service-text">Easy Order Tracking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image gallery functionality
    const mainImage = document.getElementById('main-product-image');
    const thumbnailButtons = document.querySelectorAll('.thumbnail-btn');

    thumbnailButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get image source from clicked thumbnail
            const newImageSrc = this.querySelector('img').getAttribute('src');

            // Update main image
            mainImage.setAttribute('src', newImageSrc);

            // Remove 'active' class from all buttons and add it to the clicked one
            thumbnailButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Quantity selector functionality
    const decreaseBtn = document.getElementById("decrease-btn");
    const increaseBtn = document.getElementById("increase-btn");
    const quantityInput = document.getElementById("quantity-input");

    const currentPriceEl = document.querySelector(".current-price");
    const originalPriceEl = document.querySelector(".original-price");

    // Fetch initial prices and offer data
    const baseSalePrice = parseFloat("<?= $res['sale_price'] ?>");
    const baseOriginalPrice = parseFloat("<?= $res['product_price'] ?>");

    // Fetch the offer data from PHP
    const offerQuantity = <?= isset($top_offer_record['peice']) ? $top_offer_record['peice'] : 'null' ?>;
    const offerDiscountPercentage = <?= isset($top_offer_record['off']) ? $top_offer_record['off'] : 'null' ?>;

    // Fetch the coupon discount data from PHP
    const couponDiscount = <?= isset($coupon_off) ? $coupon_off : 'null' ?>; // This is the coupon discount value in percentage

    // Update price function
    function updatePrice(quantity) {
        let newSalePrice = (baseSalePrice * quantity).toFixed(2);
        let newOriginalPrice = (baseOriginalPrice * quantity).toFixed(2);

        // Apply offer discount if offerQuantity is defined and quantity matches
        if (offerQuantity !== null && quantity === offerQuantity) {
            const discountAmount = (newSalePrice * offerDiscountPercentage / 100).toFixed(2);
            newSalePrice = (newSalePrice - discountAmount).toFixed(2);
        }

        // Apply coupon discount if couponDiscount is defined
        if (couponDiscount !== null) {
            const couponDiscountAmount = (newSalePrice * couponDiscount / 100).toFixed(2);
            newSalePrice = (newSalePrice - couponDiscountAmount).toFixed(2);
        }

        // Display updated prices
        currentPriceEl.textContent = `₹ ${newSalePrice}`;
        originalPriceEl.textContent = `₹ ${newOriginalPrice}`;
    }

    // Increase quantity
    increaseBtn.addEventListener("click", function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity < 10) {
            quantity++;
            quantityInput.value = quantity;
            updatePrice(quantity);
        }
    });

    // Decrease quantity
    decreaseBtn.addEventListener("click", function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) { // Prevent going below 1
            quantity--;
            quantityInput.value = quantity;
            updatePrice(quantity);
        }
    });

    // Initial price setup
    updatePrice(parseInt(quantityInput.value));
});





    document.addEventListener("DOMContentLoaded", function() {
        // Add to Cart button functionality
        const addToCartBtn = document.getElementById("add_cart");

        addToCartBtn.addEventListener("click", function() {
            let productId = "<?= $res['id'] ?>"; // Product ID
            let quantity = document.getElementById("quantity-input").value; // Quantity
            let salePrice = document.querySelector(".current-price").textContent.replace("₹", "").trim(); // Sale price
            let originalPrice = document.querySelector(".original-price").textContent.replace("₹", "").trim(); // Original price

            // Data to send as query parameters
            let cartData = new URLSearchParams({
                product_id: productId,
                quantity: quantity,
                sale_price: salePrice,
                original_price: originalPrice
            }).toString();

            // Send data through URL
            let url = `add_cart.php?${cartData}`;
            window.location.href = url; // Redirect to the cart page




            // Send AJAX request
            // fetch("cart.php", {
            //     method: "POST",
            //     headers: {
            //         "Content-Type": "application/json"
            //     },
            //     body: JSON.stringify(cartData)
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         alert("Product added to cart successfully!");
            //     } else {
            //         alert("Failed to add product to cart.");
            //     }
            // })
            // .catch(error => console.error("Error:", error));
        });
    });
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buyNowBtn = document.querySelector(".buy-now-btn");
        const userDetailsModal = document.getElementById("userDetailsModal");
        const proceedPaymentBtn = document.getElementById("proceed-payment");

        buyNowBtn.addEventListener("click", function() {
            userDetailsModal.style.display = "block"; // Show the user details form
        });

        proceedPaymentBtn.addEventListener("click", function() {
            let productId = "<?= $res['id'] ?>";
            let quantity = document.getElementById("quantity-input").value;
            let salePrice = document.querySelector(".current-price").textContent.replace("₹", "").trim();
            let totalAmount = parseFloat(salePrice) * 100; // Convert to paisa

            let userName = document.getElementById("user-name").value.trim();
            let userEmail = document.getElementById("user-email").value.trim();
            let userContact = document.getElementById("user-contact").value.trim();
            let userAddress = document.getElementById("user-address").value.trim();

            if (!userName || !userEmail || !userContact || !userAddress) {
                alert("Please fill all details to proceed!");
                return;
            }

            let options = {
                "key": "rzp_live_t6gVKS9RuNQJUO", // Replace with your Razorpay API Key
                "amount": totalAmount,
                "currency": "INR",
                "name": "Cloud7",
                "description": "Payment for Order",
                "image": "https://cloud7perfume.com/uploads/logo.png",
                "handler": function(response) {
                    alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);

                    // Redirect to process_payment.php with all required data
                    let orderData = new URLSearchParams({
                        product_id: productId,
                        quantity: quantity,
                        sale_price: salePrice,
                        payment_id: response.razorpay_payment_id,
                        user_name: userName,
                        user_email: userEmail,
                        user_contact: userContact,
                        user_address: userAddress,
                        payment_status: "Success"
                    }).toString();


                    window.location.href = `process_payment.php?${orderData}`;
                },
                "prefill": {
                    "name": userName,
                    "email": userEmail,
                    "contact": userContact
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            let rzp1 = new Razorpay(options);
            rzp1.open();
        });
    });
</script>





</html>

<?php
include 'includes/footer.php';
?>