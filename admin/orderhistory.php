<?php include('header.php'); ?>

<div class="content-wrapper" style="min-height: 948px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Order History Report</h3>
                        <!-- <div class="box-tools">
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Query to select all fields from the orders table and join product_items to get product_name
                        $sql = "SELECT o.*, p.product_name,p.primary_image_url 
            FROM orders o
            LEFT JOIN product_items p ON o.product_id = p.id 
            ORDER BY o.order_id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="dark">
                                        <th>OrderID</th>
                                        <th>Product Id</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Address</th>
                                        <th>Quantity</th>
                                        <th>Sale Price</th>
                                        <th>Payment Status</th>
                                        <th>PaymentID</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Status</th>
                                        <th>Approved Order</th>
                                        <th>Rejected Order</th>
                                        <!-- <th>Delivery Date</th> -->
                                        <th>Delivered Order</th>

                                        <!-- <th>Approved Status</th>
                    <th>Reject Status</th>
                    <th>Delivered Status</th> -->
                                        <th>Add Delivery Date</th>
                                        <th>Download Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row in the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['order_id'] . "</td>";
                                            echo "<td>" . $row['product_id'] . "</td>";
                                            echo "<td>" . $row['user_name'] . "</td>";
                                            echo "<td>" . $row['user_contact'] . "</td>";
                                            echo "<td><img src='products_uploads/" . $row['primary_image_url'] . "' alt='User Image' height='90px' width='90px'></td>";
                                            echo "<td>" . $row['product_name'] . "</td>"; // Display product name from product_items table
                                            echo "<td>" . $row['user_address'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['sale_price'] . "</td>";
                                            echo "<td>" . $row['payment_status'] . "</td>";
                                            echo "<td>" . $row['payment_id'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>" . $row['delivery_date'] . "</td>";
                                            echo "<td>" . $row['delivery_status'] . "</td>";

                                            // Add status as query parameter in each link
                                            echo "<td class='text-center'><a href='update_order_status.php?order_id=" . $row['order_id'] . "&status=Approved'>✅</a></td>";
                                            echo "<td class='text-center'><a href='update_order_status.php?order_id=" . $row['order_id'] . "&status=Rejected'>❌</a></td>";
                                            echo "<td class='text-center'><a href='update_order_status.php?order_id=" . $row['order_id'] . "&status=Delivered'>📦</a></td>";
                                            echo "<td class='text-center'><a href='add_delivery_date.php?order_id=" . $row['order_id'] . "'>Add Date</a></td>";
                                            echo "<td class='text-center'><a href='invoice.php?order_id=" . $row['order_id'] . "' class='btn btn-primary fa fa-download'></a></td>";

                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no orders found, display a message
                                        echo "<tr><td colspan='13'>No orders found</td></tr>";
                                    }
                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<?php include('footer.php'); ?>