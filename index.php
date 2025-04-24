<?php
session_start();
ob_start();
$emailData = isset($_SESSION['email']) ? $_SESSION['email'] : '';
include 'includes/header.php';
include("includes/db.php");

?>


<div class="slider-container">
    <!-- <div class="slide">
        <img src="assets/images//1.jpeg" alt="">
        <div class="caption">hello caption</div>
    </div> -->


    <?php
    $sqlSlider = "SELECT * FROM slider";
    $sliderData = mysqli_query($conn, $sqlSlider);
    if (mysqli_num_rows($sliderData) > 0) {
        while ($res = mysqli_fetch_assoc($sliderData)) {


    ?>
            <div class="slide">
                <img src="uploads/<?= $res['slider_image'] ?>"
                    alt="slider image" />

            </div>
    <?php
        }
    }
    ?>



    <span class="arrow prev" onclick="controller(-1)">&#10094;</span>
    <span class="arrow next" onclick="controller(1)">&#10095;</span>
</div>





<style>
    .con {
        padding: 20px;
        background: #f4f4f4;
    }

    .slider-wrapper {
        position: relative;
        overflow: hidden;
    }

    .manual-slider {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
    }

    .product-card {
        flex: 0 0 auto;
        width: 300px;
        margin-right: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        height: 400px;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .product-image-container {
        height: 240px;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        transition: 0.4s;
    }

    .product-image.hover {
        opacity: 0;
    }

    .product-card:hover .product-image.default {
        opacity: 0;
    }

    .product-card:hover .product-image.hover {
        opacity: 1;
    }

    .slider-buttons {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        z-index: 10;
    }

    .slider-buttons button {
        background-color: rgb(0 0 0 / 19%);
        color: white;
        border: none;
        /* font-size: 20px; */
        padding: 10px;
        cursor: pointer;
        border-radius: 9%;
    }

    .discount-badge {
        font-size: 12px;
        background: red;
        color: white;
        padding: 2px 6px;
        display: inline-block;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .wishlist-icon {
        float: right;
    }

    .product-title {
        font-weight: bold;
        margin-top: 10px;
    }

    .product-price {
        margin-top: 5px;
    }

    .original-price {
        text-decoration: line-through;
        margin-left: 5px;
        color: gray;
    }
</style>

<div class="con">
    <h2 style="text-align:center;">Best Seller Perfumes</h2>

    <div class="slider-wrapper">
        <!-- Slider Buttons -->
        <div class="slider-buttons">
            <button onclick="slideLeft()">&#10094;</button>
            <button onclick="slideRight()">&#10095;</button>
        </div>

        <!-- Slider Content -->
        <div class="manual-slider" id="productSlider">
            <?php
            $sql = "SELECT * FROM product_items";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($record = mysqli_fetch_assoc($data)) {
                    $color = "black";
                    $dataWiss = "SELECT * FROM wisslist WHERE shop_id='{$record['id']}' AND user_email='{$emailData}'";
                    $checkData = mysqli_query($conn, $dataWiss);
                    if (mysqli_num_rows($checkData) > 0) {
                        $color = "blue";
                    }
            ?>
                    <div class="product-card" onclick="navigateBuyPage(<?= $record['id'] ?>)">
                        <div class="discount-badge"><?= $record['discount_percentage'] ?>% OFF</div>
                        <a href="add_wishlist.php?id=<?= $record['id'] ?>">
                            <i style="color: <?= $color ?>;" class="wishlist-icon fas fa-heart"></i>
                        </a>
                        <div class="product-image-container">
                            <img class="product-image default" src="admin/products_uploads/<?= $record['primary_image_url'] ?>">
                            <img class="product-image hover" src="admin/products_uploads/<?= $record['secondary_image_url'] ?>">
                        </div>
                        <div class="product-title"><?= $record['product_name'] ?></div>
                        <div class="product-rating">
                            <?php
                            $rating = intval($record['rating']);
                            echo str_repeat("★", $rating) ?: "No Rating";
                            ?>
                        </div>
                        <div class="product-price">
                            ₹<?= $record['sale_price'] ?>
                            <span class="original-price">₹<?= $record['product_price'] ?></span>
                        </div>
                        <div class="action-buttons">
                            <a href="single-product.php?id=<?= $record['id'] ?>"><button>View</button></a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No Any Product";
            }
            ?>
        </div>
    </div>
</div>

<script>
    const slider = document.getElementById('productSlider');
    const cardWidth = 265; // Adjust according to card + margin

    function slideRight() {
        slider.scrollBy({
            left: cardWidth,
            behavior: 'smooth'
        });
    }

    function slideLeft() {
        slider.scrollBy({
            left: -cardWidth,
            behavior: 'smooth'
        });
    }
</script>




<script>
    const navigateBuyPage = (id) => {
        window.location.href = `single-product.php?id=${id}`;
    }
</script>
<div class="videos-row">
    <button class="slider-btn prev" onclick="slideVideos(-1)">&#10094;</button>

    <div class="slider-container">
        <div class="video-slider-track">
            <?php
            $fetchVideo = "SELECT * FROM videos";
            $videoData = mysqli_query($conn, $fetchVideo);
            if (mysqli_num_rows($videoData) > 0) {
                while ($response = mysqli_fetch_assoc($videoData)) {
            ?>
                    <div class="video-wrapper">
                        <video class="productVideo" autoplay muted loop>
                            <source src="admin/products_uploads/<?= $response['video'] ?>" type="video/mp4">
                        </video>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <button class="slider-btn next" onclick="slideVideos(1)">&#10095;</button>
</div>

<style>
    .videos-row {
        position: relative;
        width: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .slider-container {
        width: 100%;
        overflow: hidden;
    }

    .video-slider-track {
        display: flex;
        transition: transform 0.5s ease;
        gap: 16px;
    }

    .video-wrapper {
        width: 300px;
        height: 500px;
        flex-shrink: 0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #000;
        /* fallback background for video loading */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .productVideo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* ensures the video fills the box and is cropped if needed */
        display: block;
        border-radius: 10px;
    }


    .slider-btn {
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        padding: 10px 15px;
        z-index: 1;
        /*border-radius: 60%;*/
        transition: background-color 0.3s;
    }

    .slider-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slider-btn.prev {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .slider-btn.next {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Optional: responsive tweaks */
    @media (max-width: 768px) {
        .video-wrapper {
            width: 250px;
            height: 160px;
        }
    }
</style>

<script>
    let slideIndex = 0;

    function slideVideos(direction) {
        const track = document.querySelector('.video-slider-track');
        const slideWidth = document.querySelector('.video-wrapper').offsetWidth + 16; // width + gap
        const maxScroll = track.scrollWidth - track.clientWidth;

        slideIndex += direction;

        let offset = slideIndex * slideWidth;
        if (offset < 0) {
            offset = 0;
            slideIndex = 0;
        } else if (offset > maxScroll) {
            offset = maxScroll;
            slideIndex--;
        }

        track.style.transform = `translateX(-${offset}px)`;
    }
</script>



<section class="shop-by-category">
    <h2>Shop By Category</h2>
    <p>Explore our premium range of products</p>

    <div class="category-slider-wrapper">
        <button class="slider-btn prev" onclick="slideCategories(-1)">&#10094;</button>

        <div class="category-slider-container">
            <div class="category-slider-track">
                <?php
                $category_sql = "SELECT * FROM category";
                $category_data = mysqli_query($conn, $category_sql);
                if (mysqli_num_rows($category_data) > 0) {
                    while ($responseData = mysqli_fetch_assoc($category_data)) {
                ?>
                        <div class="category-item">
                            <a href="product_by_category.php?category=<?= $responseData['name'] ?>">
                                <img src="admin/category/<?= $responseData['image'] ?>" alt="<?= $responseData['name'] ?>">
                                <h3><?= $responseData['name'] ?></h3>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <button class="slider-btn next" onclick="slideCategories(1)">&#10095;</button>
    </div>
</section>
<style>
    .shop-by-category {
        padding: 60px 20px;
        background-color: #f5f5f5;
        text-align: center;
    }

    .shop-by-category h2 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    .shop-by-category p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        color: #777;
    }

    .category-slider-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .category-slider-container {
        overflow: hidden;
        width: 100%;
    }

    .category-slider-track {
        display: flex;
        gap: 20px;
        transition: transform 0.5s ease;
    }

    .category-item {

        min-width: 200px;
        max-width: 200px;
        height: 400px;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;

    }

    .category-item:hover {
        transform: translateY(-5px);
    }

    .category-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* this shows the full image without cropping */
        background-color: #fff;
        /* fallback for transparent images */
        display: block;
    }

    .category-item h3 {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 10px 0;
        margin: 0;
        font-size: 1.1rem;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-weight: 600;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }



    .slider-btn {
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        padding: 10px;
        /*border-radius: 50%;*/
        transition: background-color 0.3s ease;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
    }

    .slider-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slider-btn.prev {
        left: 10px;
    }

    .slider-btn.next {
        right: 10px;
    }
</style>

<script>
    let catIndex = 0;

    function slideCategories(direction) {
        const track = document.querySelector('.category-slider-track');
        const itemWidth = document.querySelector('.category-item').offsetWidth + 20; // 20 = gap
        const maxScroll = track.scrollWidth - track.clientWidth;

        catIndex += direction;

        let offset = catIndex * itemWidth;
        if (offset < 0) {
            offset = 0;
            catIndex = 0;
        } else if (offset > maxScroll) {
            offset = maxScroll;
            catIndex--;
        }

        track.style.transform = `translateX(-${offset}px)`;
    }
</script>


<div class="gifting-wrapper">
    <div class="gifting-image-wrapper">
        <img src="./uploads/SUB_5044.JPG" alt="Gifting Wooden Box Perfume" class="gifting-image" loading="lazy">
    </div>
    <div class="gifting-content-wrapper">
        <div class="gifting-content-list">
            <div class="gifting-content text-container text--center">
                <h3 class="gifting-heading">Our Gifting Wooden Box Perfumes</h3>
                <div class="gifting-text-wrapper">
                    <p>Test</p>
                    <div class="gifting-button-wrapper">
                        <a href="Gifting.php" class="gifting-button">Indulge Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .combo-slider-wrapper {
        width: 90%;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        padding: 10px 0;
    }

    .combo-slider {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
    }

    .product-card {
        flex: 0 0 auto;
        width: 250px;
        margin-right: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .product-image-container {
        height: 180px;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        transition: 0.4s;
    }

    .product-image.hover {
        opacity: 0;
    }

    .product-card:hover .product-image.default {
        opacity: 0;
    }

    .product-card:hover .product-image.hover {
        opacity: 1;
    }

    .slider-buttons {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        z-index: 10;
    }

    .slider-buttons button {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        font-size: 20px;
        padding: 10px;
        cursor: pointer;
        border-radius: 50%;
    }

    .discount-badge {
        font-size: 12px;
        background: red;
        color: white;
        padding: 2px 6px;
        display: inline-block;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .wishlist-icon {
        float: right;
    }

    .product-title {
        font-weight: bold;
        margin-top: 10px;
    }

    .product-price {
        margin-top: 5px;
    }

    .original-price {
        text-decoration: line-through;
        margin-left: 5px;
        color: gray;
    }
</style>

<div>
    <h2 style="text-align:center;">Combo Offer</h2>

    <div class="combo-slider-wrapper">
        <!-- Buttons -->
        <div class="slider-buttons">
            <button onclick="comboSlideLeft()">&#10094;</button>
            <button onclick="comboSlideRight()">&#10095;</button>
        </div>

        <!-- Slider -->
        <div class="combo-slider" id="comboSlider">
            <?php
            $sql = "SELECT * FROM combo_offer";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($record = mysqli_fetch_assoc($data)) {
                    $color = "black";
                    $dataWiss = "SELECT * FROM wisslist WHERE shop_id='{$record['id']}' AND user_email='{$emailData}'";
                    $checkData = mysqli_query($conn, $dataWiss);
                    if (mysqli_num_rows($checkData) > 0) {
                        $color = "blue";
                    }
            ?>
                    <div class="product-card" onclick="navigateBuyPageCombo(<?= $record['id'] ?>)">
                        <div class="discount-badge"><?= $record['discount_percentage'] ?>% OFF</div>
                        <a href="add_wishlist_combo.php?id=<?= $record['id'] ?>">
                            <i style="color: <?= $color ?>;" class="wishlist-icon fas fa-heart"></i>
                        </a>

                        <div class="product-image-container">
                            <img class="product-image default" src="admin/products_uploads/<?= $record['primary_image_url'] ?>">
                            <img class="product-image hover" src="admin/products_uploads/<?= $record['secondary_image_url'] ?>">
                        </div>

                        <div class="product-title"><?= $record['product_name'] ?></div>

                        <div class="product-rating">
                            <?php
                            $rating = intval($record['rating']);
                            echo str_repeat("★", $rating) ?: "No Rating";
                            ?>
                        </div>

                        <div class="product-price">
                            ₹<?= $record['sale_price'] ?>
                            <span class="original-price">₹<?= $record['product_price'] ?></span>
                        </div>

                        <div class="action-buttons">
                            <a href="single-product.php?id=<?= $record['id'] ?>"><button>View</button></a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No product found";
            }
            ?>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    const comboSlider = document.getElementById('comboSlider');
    const comboCardWidth = 265;

    function comboSlideRight() {
        comboSlider.scrollBy({
            left: comboCardWidth,
            behavior: 'smooth'
        });
    }

    function comboSlideLeft() {
        comboSlider.scrollBy({
            left: -comboCardWidth,
            behavior: 'smooth'
        });
    }

    const navigateBuyPageCombo = (id) => {
        window.location.href = `single-product.php?id=${id}`;
    }
</script>





<?php include 'includes/footer.php'; ?>