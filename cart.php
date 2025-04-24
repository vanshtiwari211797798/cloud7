<?php
session_start();
ob_start();
include("includes/db.php");
include("includes/header.php");
if (!isset($_SESSION['email'])) {
    echo "
   <script>
       alert('Please login');
    window.location.href='includes/authentication/login.php';
   </script>
   ";
}

$orderuserName = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$orderuseraddress = isset($_SESSION['address']) ? $_SESSION['address'] : '';
$orderuseremail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
// print_r($_SESSION);

$sqlCount = "SELECT COUNT(*) AS item_count FROM mycarts WHERE user_email='$orderuseremail'";
$resultCnt = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCnt);
$cartCount = isset($rowCount['item_count']) ? $rowCount['item_count'] : '';
// echo $cartCount;

// fetch top offer
$fetTopOffer = "SELECT * FROM top_offer ORDER BY id DESC LIMIT 1";
$dataTopOffer = mysqli_query($conn, $fetTopOffer);
$OfferDataResponse = mysqli_fetch_assoc($dataTopOffer);
// print_r($OfferDataResponse);
$peice = isset($OfferDataResponse['peice']) ? $OfferDataResponse['peice'] : '';
$off = isset($OfferDataResponse['off']) ? $OfferDataResponse['off'] : '';
?>




<div class="cartt">
    <section id="cart" class="section-p1">
        <div class="cart-container">
            <?php
            $coupons = [];
            $couponQuery = mysqli_query($conn, "SELECT * FROM coupon");
            while ($c = mysqli_fetch_assoc($couponQuery)) {
                $coupons[] = $c;
            }
            ?>

            <div class="cart-header">
                <h2>Your Shopping Cart</h2>
                <p id="cart-count"><?= mysqli_num_rows($data) ?> items</p>
            </div>

            <div class="cart-items">
                <!-- Modal Structure -->
                <!-- Modal Structure -->
                <div id="orderModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:999; justify-content:center; align-items:center;">
                    <div style="background:white; padding:30px; border-radius:10px; width:90%; max-width:500px; position:relative;">
                        <h2 style="margin-bottom:20px;">Place Your Order</h2>
                        <button id="closeModal" style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:20px; cursor:pointer;">&times;</button>

                        <!-- Hidden product data -->
                        <input type="hidden" id="modal_product_name">
                        <input type="hidden" id="modal_product_price">
                        <input type="hidden" id="modal_product_quantity">
                        <input type="hidden" id="modal_product_image">
                        <input type="hidden" id="modal_product_id">

                        <!-- User inputs -->
                        <div style="margin-bottom:10px;">
                            <label>Your Name</label>
                            <input type="text" id="user_name" value="<?= $orderuserName ?>" style="width:100%; padding:8px;" readonly>
                        </div>
                        <div style="margin-bottom:10px;">
                            <label>Your Email</label>
                            <input type="email" id="user_email" value="<?= $orderuseremail ?>" style="width:100%; padding:8px;" readonly>
                        </div>
                        <div style="margin-bottom:10px;">
                            <label>Contact Number</label>
                            <input type="number" id="user_contact" style="width:100%; padding:8px;">
                        </div>
                        <div style="margin-bottom:10px;">
                            <label>Address</label>
                            <textarea id="user_address" style="width:100%; padding:8px; resize:none"></textarea>
                        </div>

                        <button id="confirmOrderBtn" type="button" style="padding:10px 20px; cursor:pointer; background:#28a745; color:white; border:none; border-radius:5px; width: 100%;">
                            Confirm Order
                        </button>
                    </div>
                </div>


                <?php
                $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
                $sql = "SELECT * FROM mycarts WHERE user_email='$userEmail'";
                $data = mysqli_query($conn, $sql);

                if (mysqli_num_rows($data) > 0) {
                    while ($res = mysqli_fetch_assoc($data)) {
                ?>
                        <div class="cart-item" data-id="<?= $res['id'] ?>" data-price="<?= $res['product_price'] ?>">
                            <div class="item-image">
                                <img src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt="<?= $res['product_name'] ?>">
                            </div>

                            <div class="item-details">
                                <h3 class="item-name"><?= $res['product_name'] ?></h3>
                                <p class="item-quantity">Quantity: <?= $res['product_quantity'] ?></p>

                                <div class="price-section">
                                    <span style="text-decoration: none;" class="original-price">₹<?= $res['product_price'] ?></span>
                                    <span class="discount-msg text-success" style="display:none;">Coupon Applied!</span>
                                </div>

                                <div class="item-actions">
                                    <a href="delete_cart.php?id=<?= $res['id'] ?>" class="remove-item">
                                        <i class="far fa-times-circle"></i> Remove
                                    </a>
                                    <a href="single-product.php?id=<?= $res['product_id'] ?>&quantityIs=<?= $res['product_quantity'] ?>" class="view-update">
                                        <i class="fas fa-edit"></i> View/Update
                                    </a>
                                </div>
                            </div>

                            <!-- <div class="coupon-section">
                                <div class="coupon-controls">
                                    <select class="coupon-select">
                                        <option value="">--Select Coupon--</option>
                                        <?php foreach ($coupons as $cp) { ?>
                                            <option value="<?= $cp['coupon_off'] ?>">
                                                <?= $cp['coupon_code'] ?> (<?= $cp['coupon_off'] ?>% Off)
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <button class="apply-coupon">
                                        <i class="fas fa-tag"></i> Apply
                                    </button>
                                </div>

                                <button class="orderNowBtn" type="button"
                                    data-id="<?= $res['product_id'] ?>"
                                    data-image="<?= $res['primary_image_url'] ?>"
                                    data-name="<?= $res['product_name'] ?>"
                                    data-price="<?= $res['product_price'] ?>"
                                    data-quantity="<?= $res['product_quantity'] ?>">
                                    <i class="fas fa-shopping-cart"></i> Order Now
                                </button>
                            </div> -->
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Your cart is empty</p>
                    <a href="index.php" class="btn">Continue Shopping</a>
                </div>';
                }
                ?>
            </div>


        </div>
    </section>

    <style>
    /* Cart Container Styles */
    #cart {
        padding: 2rem;
        background-color: #f9f9f9;
        min-height: 70vh;
    }

    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .cart-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
    }

    .cart-header h2 {
        font-size: 1.8rem;
        color: #333;
    }

    #cart-count {
        color: #666;
        font-size: 0.9rem;
    }

    /* Cart Item Styles - Laptop/Desktop View */
    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .cart-item {
        display: flex;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        gap: 1.5rem;
        position: relative;
    }

    .item-image {
        width: 120px;
        height: 120px;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .item-quantity {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .price-section {
        margin: 0.5rem 0;
    }

    .original-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .discount-msg {
        color: #28a745;
        font-size: 0.8rem;
        margin-left: 0.5rem;
    }

    .item-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .item-actions a {
        color: #555;
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.2s;
    }

    .item-actions a:hover {
        color: #ff5722;
    }

    /* Coupon Section Styles */
    .coupon-section {
        width: 250px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .coupon-controls {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .coupon-select {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .apply-coupon {
        padding: 0.5rem;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
    }

    .orderNowBtn {
        padding: 0.7rem;
        background-color: #ff5722;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
        font-weight: 500;
    }

    /* Empty Cart Styles */
    .empty-cart {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Cart Summary Styles */
    .cart-summary {
        margin-top: 2rem;
        display: flex;
        justify-content: flex-end;
    }

    .summary-card {
        width: 300px;
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Mobile View Styles */
    @media (max-width: 767px) {
        #cart {
            padding: 1rem;
        }

        .cart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        /* Mobile Product Grid View */
        .cart-items {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .cart-item {
            flex-direction: column;
            padding: 1rem;
            gap: 0.8rem;
            align-items: center;
            text-align: center;
        }

        .item-image {
            width: 100%;
            height: auto;
            max-height: 150px;
        }

        .item-details {
            width: 100%;
        }

        .item-name {
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .original-price {
            font-size: 1.1rem;
        }

        .item-actions {
            justify-content: center;
            flex-wrap: wrap;
        }

        .coupon-section {
            width: 100%;
            margin-top: 1rem;
        }

        .cart-summary {
            justify-content: center;
        }

        .summary-card {
            width: 100%;
        }
    }

    /* Tablet View Adjustments */
    @media (min-width: 768px) and (max-width: 1024px) {
        .cart-items {
            gap: 1rem;
        }

        .cart-item {
            padding: 1rem;
            gap: 1rem;
        }

        .item-image {
            width: 100px;
            height: 100px;
        }
    }
</style>
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // JavaScript remains largely the same, just update selectors as needed
        document.addEventListener('DOMContentLoaded', function() {
            let discountedPrices = {};
            let cartSubtotal = 0;

            // Initialize cart calculations
            function calculateCart() {
                let subtotal = 0;
                let discount = 0;

                document.querySelectorAll('.cart-item').forEach(item => {
                    const price = parseFloat(item.getAttribute('data-price'));
                    const quantity = 1; // Assuming quantity is 1 per item in this design
                    const itemId = item.getAttribute('data-id');

                    if (discountedPrices[itemId]) {
                        subtotal += discountedPrices[itemId] * quantity;
                        discount += (price - discountedPrices[itemId]) * quantity;
                    } else {
                        subtotal += price * quantity;
                    }
                });

                document.getElementById('cart-subtotal').textContent = '₹' + subtotal.toFixed(2);
                document.getElementById('cart-discount').textContent = '₹' + discount.toFixed(2);
                document.getElementById('cart-total').textContent = '₹' + (subtotal).toFixed(2);
            }

            // Apply coupon functionality
            document.querySelectorAll('.apply-coupon').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('.cart-item');
                    const priceCell = item.querySelector('.original-price');
                    const msg = item.querySelector('.discount-msg');
                    const select = item.querySelector('.coupon-select');

                    const originalPrice = parseFloat(item.getAttribute('data-price'));
                    const discount = parseFloat(select.value);

                    if (!discount || this.disabled) return;

                    const discountedPrice = originalPrice - (originalPrice * discount / 100);
                    priceCell.textContent = '₹' + discountedPrice.toFixed(2);
                    msg.style.display = 'inline';
                    this.disabled = true;
                    select.disabled = true;

                    // Store discounted price
                    const itemId = item.getAttribute('data-id');
                    discountedPrices[itemId] = discountedPrice;

                    // Recalculate cart
                    calculateCart();
                });
            });

            // Order now button functionality
            document.querySelectorAll('.orderNowBtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    console.log("ids is ", productId);

                    const productName = this.getAttribute('data-name');
                    const dataImage = this.getAttribute('data-image');
                    const productPrice = discountedPrices[productId] || parseFloat(this.getAttribute('data-price'));
                    const productQuantity = this.getAttribute('data-quantity');

                    // Fill hidden modal values
                    document.getElementById('modal_product_name').value = productName;
                    document.getElementById('modal_product_price').value = productPrice;
                    document.getElementById('modal_product_quantity').value = productQuantity;
                    document.getElementById('modal_product_image').value = dataImage;
                    document.getElementById('modal_product_id').value = productId;

                    // Show modal
                    document.getElementById('orderModal').style.display = 'flex';
                });
            });

            // Close modal
            document.getElementById('closeModal').addEventListener('click', () => {
                document.getElementById('orderModal').style.display = 'none';
            });

            // Confirm Order without <form>
            document.getElementById('confirmOrderBtn').addEventListener('click', function() {
                const name = document.getElementById('user_name').value;
                const email = document.getElementById('user_email').value;
                const contact = document.getElementById('user_contact').value;
                const address = document.getElementById('user_address').value;
                const dataImage = document.getElementById('modal_product_image').value
                const productName = document.getElementById('modal_product_name').value;
                const productPrice = document.getElementById('modal_product_price').value;
                const quantity = document.getElementById('modal_product_quantity').value;
                const productId = document.getElementById('modal_product_id').value;
                console.log("prodeuct id is ", productId);


                if (!name || !email || !contact || !address) {
                    alert("Please fill all the fields.");
                    return;
                }


                let totalAmount = parseFloat(productPrice) * 100;

                let options = {
                    "key": "rzp_live_t6gVKS9RuNQJUO",
                    "amount": totalAmount,
                    "currency": "INR",
                    "name": "Cloud7",
                    "description": "Payment for Order",
                    "image": "https://cloud7perfume.com/assets/images/cloud7_logo.png",
                    "handler": function(response) {
                        alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);

                        // Redirect to process_payment.php with all required data
                        let orderData = new URLSearchParams({
                            product_id: productId,
                            quantity: quantity,
                            sale_price: productPrice,
                            payment_id: response.razorpay_payment_id,
                            user_name: name,
                            user_email: email,
                            user_contact: contact,
                            user_address: address,
                            payment_status: "Success"
                        }).toString();


                        window.location.href = `process_payment.php?${orderData}`;
                    },
                    "prefill": {
                        "name": name,
                        "email": email,
                        "contact": contact
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };

                let rzp1 = new Razorpay(options);
                rzp1.open();
                // Hide modal after order
                document.getElementById('orderModal').style.display = 'none';

                // Optionally, send data using AJAX here
            });



            // Initialize cart calculations on page load
            calculateCart();
        });
    </script>
    <!-- Payment Modal -->
    <div id="paymentModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:#ffffff; padding:30px 25px; border-radius:12px; width:90%; max-width:400px; box-shadow:0 0 15px rgba(0,0,0,0.3); font-family:sans-serif;">
            <h2 style="margin-bottom:20px; text-align:center; color:#333;">Confirm Your Details</h2>

            <input type="text" id="user_name" value="<?= $orderuserName ?>" readonly placeholder="Full Name" style="width:100%; padding:10px 12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

            <input type="email" id="user_email" value="<?= $orderuseremail ?>" readonly placeholder="Email Address" style="width:100%; padding:10px 12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

            <input type="text" id="user_contacttss" placeholder="Contact Number" style="width:100%; padding:10px 12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

            <textarea id="address" placeholder="Full Address" rows="3" style="width:100%; padding:10px 12px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px; resize:none;"></textarea>

            <div style="display:flex; justify-content:space-between; align-items:center;">
                <button onclick="startRazorpay()" style="background:#28a745; color:#fff; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:bold;">
                    Confirm Payment
                </button>
                <button onclick="document.getElementById('paymentModal').style.display='none'" style="background:#dc3545; color:#fff; border:none; padding:10px 15px; border-radius:6px; cursor:pointer;">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <?php
            $sql = "SELECT SUM(product_price) AS total_price FROM mycarts WHERE user_email='$userEmail'";
            $data = mysqli_query($conn, $sql);
            $total_price = 0;

            if ($data) {
                $res = mysqli_fetch_assoc($data);
                $total_price = $res['total_price'] ?? 0;
            }

            // Coupons
            $couponSql = "SELECT * FROM coupon";
            $couponData = mysqli_query($conn, $couponSql);
            ?>

            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₹<span id="cartSubtotal"><?php echo number_format($total_price, 2); ?></span></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td style="color:green; font-weight:bolder">Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₹<span id="cartTotal"><?php
                                                        if ($cartCount == $peice) {
                                                            // Discount percentage apply
                                                            $discountAmount = ($total_price * $off) / 100;
                                                            $discountedPrice = $total_price - $discountAmount;

                                                            echo number_format($discountedPrice, 2);
                                                        } else {
                                                            // No discount applied
                                                            echo number_format($total_price, 2);
                                                        }
                                                        ?></span></strong></td>
                </tr>
            </table>

            <style>
                .coupons{
                    display: flex;
                    gap: 10px;
                }
            </style>
            <!-- Coupon select -->
            <div class="coupons" style="margin: 20px 0;">
                <select id="couponSelect" style="padding: 10px; width: 70%; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="">-- Select Coupon --</option>
                    <?php while ($cp = mysqli_fetch_assoc($couponData)) { ?>
                        <option value="<?= $cp['coupon_off'] ?>">
                            <?= $cp['coupon_code'] ?> (<?= $cp['coupon_off'] ?>% Off)
                        </option>
                    <?php } ?>
                </select>
                <button id="applyCoupon" style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Apply Coupon
                </button>
            </div>

            <!-- Proceed button -->
            <button onclick="document.getElementById('paymentModal').style.display='flex'" style="margin-top: 15px; padding: 10px 20px; background: #28a745; color: white;cursor:pointer;border-radius:5px;border:transparent;">Proceed to Payment</button>

        </div>
    </section>
    <script>
        const cartSubtotalEl = document.getElementById('cartSubtotal');
        const cartTotalEl = document.getElementById('cartTotal');
        const originalTotal = parseFloat(cartTotalEl.innerText.replace(',', ''));

        document.getElementById('applyCoupon').addEventListener('click', function() {
            const couponValue = parseFloat(document.getElementById('couponSelect').value);

            if (!couponValue) {
                alert("Please select a coupon first.");
                return;
            }

            // Calculate discounted amount
            const discounted = originalTotal - (originalTotal * couponValue / 100);

            // Update both subtotal and total
            cartSubtotalEl.innerText = discounted.toFixed(2);
            cartTotalEl.innerText = discounted.toFixed(2);

            alert(`Coupon applied successfully! You saved ₹${(originalTotal - discounted).toFixed(2)}.`);
            let applyCoupon = document.getElementById("applyCoupon");
            applyCoupon.disabled = true;
            applyCoupon.style.backgroundColor = '#ccc';
            applyCoupon.style.color = '#666';
            applyCoupon.style.cursor = 'not-allowed';
        });
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function startRazorpay() {
            const name = document.getElementById('user_name').value;
            const email = document.getElementById('user_email').value;
            const contact = document.getElementById('user_contacttss').value;
            const address = document.getElementById('address').value;
            let amnt = document.getElementById("cartTotal").innerText;
            // console.log("amnt is",amnt);

            // console.log(name,email,contact,address);

            const amount = amnt * 100; // Amount in paisa

            var options = {
                "key": "rzp_live_t6gVKS9RuNQJUO",
                "amount": amount,
                "currency": "INR",
                "name": "Cloud 7",
                "description": "Order Payment",
                "image": "https://cloud7perfume.com/assets/images/cloud7_logo.png",
                "handler": function(response) {
                    // Send AJAX to insert order
                    fetch("insert_order.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            name: name,
                            email: email,
                            contact: contact,
                            address: address
                        })
                    }).then(res => res.text()).then(data => {
                        alert("Order placed successfully!");
                        window.location.href = "myorders.php";
                    });
                },
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact": contact
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>





</div>


<style>
    #page-header {
        background: url('./images/banner.png') no-repeat center center/cover;
        height: 300px;
        /* Adjust height as needed */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        /* Ensuring text is visible */
        position: relative;
    }

    #page-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Dark overlay for better readability */
    }

    #page-header h2,
    #page-header p {
        position: relative;
        /* Keeping text above the overlay */
        z-index: 2;
        margin: 0;
    }

    #coupon {
        width: 50%;
        margin-bottom: 30px;
    }

    #coupon h3,
    #subtotal h3 {
        padding-bottom: 15px;


    }

    #coupon input {
        padding: 10px 20px;
        outline: none;
        width: 60%;
        margin-right: 10px;
        border: 1px solid #e2e9e1;
    }

    #coupon button,
    #subtotal button {
        background-color: #088178;
        color: #fff;
        padding: 12px 20px;
    }


    #subtotal {
        width: 100%;
        margin-bottom: 30px;
        border: 1px solid #e2e9e1;
        padding: 30px;
    }

    #subtotal table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    #subtotal table td {
        width: 50%;
        border: 1px solid #e2e9e1;
        padding: 10px;
        font-size: 13px;
    }
</style>

<?php include('includes/footer.php'); ?>