<?php include('header.php'); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <?php
    $result = $conn->query("SELECT COUNT(*) AS order_count FROM orders");
    $orderCount = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $orderCount = $row['order_count'];
    }
    ?>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $orderCount; ?></h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="orderhistory.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <?php
            $result = $conn->query("SELECT SUM(sale_price) AS total_profit FROM orders");
            $totalProfit = 0;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalProfit = $row['total_profit'];
            }
            ?>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>₹<?php echo number_format($totalProfit, 2); ?></h3>
                        <p>Total Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <?php
            $result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
            $totalUsers = 0;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalUsers = $row['total_users'];
            }
            ?>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $totalUsers; ?></h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="users.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <?php
            $result = $conn->query("SELECT COUNT(*) AS total_contacts FROM contact_us");
            $totalContacts = 0;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalContacts = $row['total_contacts'];
            }
            ?>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $totalContacts; ?></h3>
                        <p>Contacts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="contactrpt.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <?php
            $result = $conn->query("SELECT COUNT(*) AS total_products FROM product_items");
            $totalProducts = 0;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalProducts = $row['total_products'];
            }
            ?>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php echo $totalProducts; ?></h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="BestSellerPerfumes.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>