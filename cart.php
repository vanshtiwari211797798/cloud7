<?php
session_start();
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
?>




<div class="cartt">
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td>Order Now</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
                $sql = "SELECT * FROM mycarts WHERE user_email='$userEmail'";
                $data = mysqli_query($conn, $sql);
                if (mysqli_num_rows($data) > 0) {
                    while ($res = mysqli_fetch_assoc($data)) {
                ?>
                        <tr> <!-- TR tag should be inside the loop -->
                            <td><a href="delete_cart.php?id=<?= $res['id'] ?>"><i class="far fa-times-circle"></i></a></td>
                            <td><img src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt=""></td>
                            <td><?= $res['product_name'] ?></td>
                            <td><?= $res['product_quantity'] ?> Qty</td>
                            <td>₹<?= $res['product_price'] ?></td>
                            <td><a href="single-product.php?id=<?= $res['product_id'] ?>">Order Now</a></td>
                        </tr> <!-- TR tag closes inside the loop -->
                <?php
                    }
                }
                ?>


            </tbody>
        </table>
    </section>

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
            ?>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₹<?php echo number_format($total_price, 2); ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td style="color:green; font-weight:bolder">Free</td>
                </tr>
                <?php
                $dataCouponSql = "SELECT * FROM coupon";
                $dataCpn = mysqli_query($conn, $dataCouponSql);
                if (mysqli_num_rows($dataCpn) > 0) {
                    while ($recordCpn = mysqli_fetch_assoc($dataCpn)) {


                ?>
                        <tr>
                            <td>Enter Coupon</td>
                            <td style="color:green; font-weight:bolder">
                                <?=$recordCpn['coupon_code']?> (<?=$recordCpn['coupon_off']?>% off)
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₹<?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
            </table>
            <!-- <button class="normal" style="border: 0px;">Proceed to Order</button> -->
        </div>
    </section>

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

    #cart {
        overflow-x: auto;
        padding: 20px;
    }

    #cart table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        white-space: nowrap;
    }

    #cart table img {
        width: 70px;
    }

    #cart table td:nth-child(1) {
        width: 100px;
        text-align: center;
    }

    #cart table td:nth-child(2) {
        width: 150px;
        text-align: center;
    }

    #cart table td:nth-child(3) {
        width: 250px;
        text-align: center;
    }

    #cart table td:nth-child(4),
    #cart table td:nth-child(5),
    #cart table td:nth-child(6) {
        width: 150px;
        text-align: center;
    }

    #cart table td:nth-child(5) input {
        width: 70px;
        padding: 10px 5px 10px 15px;
    }

    #cart table thead {
        border: 1px solid #e2e9e1;
        border-left: none;
        border-right: none;
    }

    #cart table thead td {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        padding: 18px 0;
    }


    #cart table tbody tr td {
        padding-top: 15px;
    }

    #cart table tbody td {
        font-size: 13px;
    }

    #cart-add {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 30px;
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
        width: 50%;
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