<style>
    /* Footer Styling */
    .footer {
        background-color: #2c3e50;
        color: #fff;
        padding: 40px 20px 20px;
        font-family: Arial, sans-serif;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        flex: 1 1 200px;
        margin-bottom: 20px;
    }

    .footer-heading {
        font-size: 18px;
        margin-bottom: 15px;
        color: #f39c12;
    }

    .footer-links,
    .footer-contact,
    .footer-hours {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li,
    .footer-contact li,
    .footer-hours li {
        margin-bottom: 10px;
    }

    .footer-links a,
    .footer-contact a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover,
    .footer-contact a:hover {
        color: #f39c12;
    }

    .footer-social {
        display: flex;
        gap: 15px;
    }

    .footer-social a {
        color: #fff;
        font-size: 20px;
        transition: color 0.3s ease;
    }

    .footer-social a:hover {
        color: #f39c12;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #444;
        font-size: 14px;
    }

    .footer-bottom a {
        color: #f39c12;
        text-decoration: none;
    }

    .footer-bottom a:hover {
        text-decoration: underline;
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <!-- Quick Links -->
        <div class="footer-section">
            <h4 class="footer-heading">Quick Links</h4>
            <ul class="footer-links">
                <li><a href="./about.php">About Us</a></li>
                <li><a href="./contact.php">Contact Us</a></li>
                <li><a href="./Privacy-Policy.php">Privacy Policy</a></li>
                <li><a href="./Terms-Of-Use.php">Terms Of Use</a></li>
                <li><a href="./Refund-Policy.php">Refund Policy</a></li>
                <!-- <li><a href="#">Shipping Policy</a></li> -->
                <li><a href="./returnorder.php">Return Your Order</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div class="footer-section">
            <h4 class="footer-heading">Contact</h4>
            <ul class="footer-contact">
                <li><a href="tel:+917376676696">+91 7376676696</a></li>
                <li><a href="mailto:cloud7perfumes@gmail.com">cloud7perfumes@gmail.com</a></li>
            </ul>
        </div>

        <!-- Location -->
        <div class="footer-section">
            <h4 class="footer-heading">Location</h4>
            <p>Gorkhapur, Uttar Pradesh, India</p>
        </div>

        <!-- Shop Hours -->
        <div class="footer-section">
            <h4 class="footer-heading">Shop Hours</h4>
            <ul class="footer-hours">
                <li>Mon to Fri: 8:15 am — 5:30 pm</li>
                <li>Sat: 8:15 am — 5:30 pm</li>
                <li>Sun: 10:00 am — 8:00 pm</li>
            </ul>
        </div>

        <!-- Follow Us -->
        <div class="footer-section">
            <h4 class="footer-heading">Follow Us</h4>
            <div class="footer-social">
                <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/cloud7perfumes/?igsh=dzF5azVnZjJncnV2#" target="" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <p>© C7Cloud7</p>
        <p>Developed by <a href="#" target="_blank">Gyanvi Digital</a></p>
    </div>
</footer>
<script src="./assets/js/script.js"></script>
</body>

</html>