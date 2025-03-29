<?php
session_start();
ob_start();
include 'includes/header.php';
if (!isset($_SESSION['email'])) {
    header("Location:includes/authentication/login.php");
}
?>
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
<div class="cartt">
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>SR NO</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Contact</td>
                    <td>Address</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Payment <br> Status</td>
                    <td>Delivery <br> Status</td>
                    <td>Delivery <br> Date</td>
                    <td>Payment <br> Id</td>
                    <td>Re Order</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
                $sql = "SELECT o.*, p.product_name, p.primary_image_url 
                FROM orders o
                LEFT JOIN product_items p ON o.product_id = p.id 
                WHERE o.user_email = '$userEmail'
                ORDER BY o.order_id DESC";
        
                $data = mysqli_query($conn, $sql);
                if (mysqli_num_rows($data) > 0) {
                    $sr = 1;
                    while ($res = mysqli_fetch_assoc($data)) {
                       
                ?>
                        <tr> <!-- TR tag should be inside the loop -->
                            <td><?= $sr++ ?></td>
                            <td><img src="admin/products_uploads/<?= $res['primary_image_url'] ?>" alt="<?= $res['product_name'] ?>" style="width: 50px; height: auto;"></td> <!-- Display product image -->
                            <td><?= $res['user_name'] ?></td>
                            <td><?= $res['user_contact'] ?></td>
                            <td><?= $res['user_address'] ?></td>
                            <td><?= $res['quantity'] ?></td>
                            <td>₹<?= $res['sale_price'] ?></td>
                            <td><?= $res['payment_status'] ?></td>
                            <td><?= $res['delivery_status'] ?></td>
                            <td><?= $res['delivery_date'] ?></td>
                            <td><?= $res['payment_id'] ?></td>
                            <td><a href="single-product.php?id=<?=$res['product_id']?>" style="text-decoration: none;">Re Order</a></td>
                        </tr> <!-- TR tag closes inside the loop -->
                <?php
                    }
                }
                ?>



            </tbody>
        </table>
    </section>

   

</div>

<?php include 'includes/footer.php'; ?>