<?php include('../includes/db.php'); ?>
<?php
session_start();
// if admin is not login then navigate to the index page
if (!isset($_SESSION['admin_email'])) {
    header('Location:../includes/authentication/login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cloud7 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo"><b>Hi!</b>Admin</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" class="user-image"
                                    alt="User Image" />
                                <span class="hidden-xs">Cloud7 Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" class="img-circle"
                                        alt="User Image" />
                                    <p>
                                        Saiba Javed - CEO
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" class="img-circle"
                            alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Saiba Javed</p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="contactrpt.php"><i class="fa fa-phone"></i> Contact</a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Frontend</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="slider.php"><i class="fa fa-image"></i> Slider</a></li>
                            <li><a href="about.php"><i class="fa fa-info"></i> About</a></li>
                        </ul>
                    </li>
                    <li><a href="BestSellerPerfumes.php"><i class="fa fa-flask"></i> Add Products</a></li>
                    <li><a href="Add_combo_offer.php"><i class="fa fa-flask"></i> Add Combo offer</a></li>
                    <li><a href="add_videos.php"><i class="fa fa-flask"></i> Add Videos</a></li>
                    <li><a href="add_category.php"><i class="fa fa-flask"></i> Add Category</a></li>
                    <li><a href="add_coupon.php"><i class="fa fa-flask"></i> Add Coupon</a></li>
                    <li><a href="orderhistory.php"><i class="fa fa-flask"></i> Order History</a></li>
                    <li><a href="users.php"><i class="fa fa-flask"></i> Users Reports</a></li>
                    <li><a href="top_offer.php"><i class="fa fa-flask"></i> Top Offer</a></li>
                    <li><a href="GiftingWoodenBoxPerfumes.php"><i class="fa fa-flask"></i> Gifting Wooden Box Perfumes</a></li>
                    <!-- <li><a href="ComboOffer.php"><i class="fa fa-percent"></i> Combo Offer</a></li> -->
                    <!-- <li><a href="WhyTrustUs.php"><i class="fa fa-handshake-o"></i> Why Trust Us?</a></li> -->
                    <li><a href="ceoprofile.php"><i class="fa fa-user"></i> CEO Profile</a></li>
                    <li><a href="AddSocialMediaLink.php"><i class="fa fa-facebook"></i> Add Social Media Link</a></li>
                    <li><a href="changepassword.php"><i class="fa fa-link"></i> Change Password</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>