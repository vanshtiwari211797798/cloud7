<?php
include("includes/db.php");
// session_start();

// $sql = "SELECT *  FROM announcement";
// $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C7CLOUD7</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>




    <!-- Announcement Bar -->
    <div class="announcement-bar">
        <?php
        $sql = "SELECT * FROM top_offer";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $res = mysqli_fetch_assoc($data);
            $heading = isset($res['offer_heading']) ? $res['offer_heading'] : '';
        ?>
            <p><?= $heading ?></p>
        <?php
        }
        ?>
    </div>




    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-wrapper">
                <!-- Left - Mobile Menu -->
                <div class="header-left">
                    <button id="menu-toggle" class="tap-area" aria-label="Navigation">
                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1h18M0 13h18H0zm0-6h18H0z" stroke="currentColor" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>

                <!-- Center - Logo -->
                <div class="header-center">
                    <a href="index.php" class="logo-link">
                        <img src="./assets/images/cloud7_logo.png" alt="C7CLOUD7 Logo" class="logo-image">
                    </a>
                </div>

                <!-- Right - Icons -->
                <div class="header-right">
                    <!-- Search Icon -->
                    <!-- <button id="search-toggle" class="tap-area" aria-label="Search">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2" fill="none"></circle>
                            <line x1="14" y1="14" x2="19" y2="19" stroke="currentColor" stroke-width="2"></line>
                        </svg>
                    </button> -->

                    <!-- User Account Icon - Only show when not logged in -->
                    <a href="includes/authentication/login.php" class="tap-area hide-on-mobile" aria-label="Login" id="user-icon">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9" cy="5" r="4" stroke="currentColor" stroke-width="2" stroke-linejoin="round" fill="none"></circle>
                            <path d="M1 17v0a4 4 0 014-4h8a4 4 0 014 4v0" stroke="currentColor" stroke-width="2" fill="none"></path>
                        </svg>
                    </a>

                    <!-- Wishlist Icon - Only show when not logged in -->
                    <a href="Wishlist.php" class="tap-area hide-on-mobile" aria-label="Wishlist" id="wishlist-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                        </svg>
                    </a>

                    <!-- Cart Icon -->
                    <a href="cart.php" class="tap-area cart-link" aria-label="Cart">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1H4L5 11H17L19 4H8" stroke="currentColor" stroke-width="2" fill="none"></path>
                            <circle cx="6" cy="17" r="2" stroke="currentColor" stroke-width="2" fill="none"></circle>
                            <circle cx="16" cy="17" r="2" stroke="currentColor" stroke-width="2" fill="none"></circle>
                        </svg>
                        <?php
                        $email_id = isset($_SESSION['email']) ? $_SESSION['email'] : '';
                        $sql =  "SELECT * FROM mycarts WHERE user_email='$email_id'";
                        $data = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($data);
                        ?>
                        <span class="cart-badge"><?= $num_rows ?></span>
                    </a>
                    <a href="myorders.php" class="tap-area hide-on-mobile" aria-label="My Orders" id="orders-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <!-- You can use a shopping cart or any order-related icon. Here's an example using a cart icon -->
                            <path d="M7 4V2h10v2h2v2h-1l-2.6 8.5c-.1.3-.3.5-.6.5H9.2c-.3 0-.5-.2-.6-.5L6 8H3V6h1l2.6-8.5c.1-.3.3-.5.6-.5h8.8c.3 0 .5.2.6.5L21 6h1v2h-2v2h-2l-1.6-5.5L13.6 8h-3.2L7 4zM8.5 11h7l1.4 4H7l1.4-4zM6 19c0-.6.4-1 1-1s1 .4 1 1-.4 1-1 1-1-.4-1-1zm12 0c0-.6.4-1 1-1s1 .4 1 1-.4 1-1 1-1-.4-1-1z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Bar - Hidden by default -->
        <div id="search-bar" class="search-bar">
            <form action="searchproduct.php" method="GET">
                <input type="text" name="product_name" placeholder="Search for a product..." class="search-input" required>
            </form>
        </div>
    </header>

    <!-- Mobile Navigation Menu - Hidden by default -->
    <div id="mobile-nav-overlay" class="mobile-nav-overlay">
        <div id="mobile-nav" class="mobile-nav">
            <div class="mobile-nav-header">
                <h2 class="mobile-nav-title">Menu</h2>
                <button id="mobile-nav-close" class="mobile-nav-close">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 13L1 1M13 1L1 13" stroke="currentColor" stroke-width="2"></path>
                    </svg>
                </button>
            </div>

            <ul class="mobile-nav-list">
                <li class="mobile-nav-item">
                    <a href="index.php" class="mobile-nav-link">Home</a>
                </li>

                <li class="mobile-nav-item">
                    <button id="shop-dropdown-toggle" class="mobile-nav-button">
                        Shop
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <div id="shop-dropdown" class="dropdown-content">
                        <a href="Discory.php" class="dropdown-link">Discovery Set</a>
                        <a href="Gifting.php" class="dropdown-link">Gifting Perfumes</a>
                        <a href="wolden.php" class="dropdown-link">Wooden Box</a>
                        <a href="Attar.php" class="dropdown-link">Attar Role On</a>
                    </div>
                </li>

                <li class="mobile-nav-item">
                    <a href="about.php" class="mobile-nav-link">About us</a>
                </li>

                <li class="mobile-nav-item">
                    <a href="Customization.php" class="mobile-nav-link">Customization</a>
                </li>

                <li class="mobile-nav-item">
                    <a href="contact.php" class="mobile-nav-link">Contact us</a>
                </li>

                <li class="mobile-nav-item" id="profile-menu-item" style="display: none;">
                    <a href="userprofile.php" class="mobile-nav-link">Profile</a>
                </li>
            </ul>

            <div class="mobile-nav-footer">
                <a href="includes/authentication/login.php" class="account-link" id="login-link">
                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="5" r="4" stroke="currentColor" stroke-width="2" stroke-linejoin="round" fill="none"></circle>
                        <path d="M1 17v0a4 4 0 014-4h8a4 4 0 014 4v0" stroke="currentColor" stroke-width="2" fill="none"></path>
                    </svg>
                    <span id="login-text">Log in</span>
                </a>
            </div>
            <div class="mobile-nav-footer">
                <a href="includes/authentication/logout.php" class="account-link" id="login-link">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span id="login-text">Log out</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Contact Buttons -->
    <a href="tel:7376676696" class="floating-button phone-button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>

    <a href="https://api.whatsapp.com/send?phone=7376676696" target="_blank" class="floating-button whatsapp-button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
        </svg>
    </a>