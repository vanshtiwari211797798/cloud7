<?php
include("../includes/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['id'];
    $img1 = $_POST['old_img_1'];
    $img2 = $_POST['old_img_2'];
    $img3 = $_POST['old_img_3'];
    $img4 = $_POST['old_img_4'];
    $best_seller_catrgory = mysqli_real_escape_string($conn, $_POST['best_seller_catrgory']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $discount_percentage = mysqli_real_escape_string($conn, $_POST['discount_percentage']);
    $sale_price = mysqli_real_escape_string($conn, $_POST['sale_price']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $raters = mysqli_real_escape_string($conn, $_POST['raters']);
    $is_best_seller = mysqli_real_escape_string($conn, $_POST['is_best_seller']);
    $product_discription = mysqli_real_escape_string($conn, $_POST['product_discription']);


    // $third_image_url = $_FILES['third_image_url']['name'];
    // $fourth_image_url = $_FILES['fourth_image_url']['name'];

    if (empty($primary_image_url)) {

        $img_data_1 = $img1;
        $img_data_2 = $img2;
        $img_data_3 = $img3;
        $img_data_4 = $img4;
    } else {

        $img_data_1 = $_FILES['primary_image_url']['name'];
        $img_data_2 = $_FILES['secondary_image_url']['name'];
        $primary_image_url_tmp = $_FILES['primary_image_url']['tmp_name'];
        $secondary_image_url_tmp = $_FILES['secondary_image_url']['tmp_name'];
        move_uploaded_file($primary_image_url_tmp, "products_uploads/$img_data_1");
        move_uploaded_file($secondary_image_url_tmp, "products_uploads/$img_data_2");
    }
    $sql = "UPDATE combo_offer SET 
    best_seller_catrgory = '$best_seller_catrgory',
    product_name = '$product_name',
    quantity = '$quantity',
    product_price = '$product_price',
    discount_percentage = '$discount_percentage',
    sale_price = '$sale_price',
    rating = '$rating',
    raters = '$raters',
    is_best_seller = '$is_best_seller',
    product_discription = '$product_discription',
    primary_image_url = '$img_data_1',
    secondary_image_url = '$img_data_2'
WHERE id = $uid";


    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Product Updated successfully');
            window.location.href='Add_combo_offer.php';
        </script>
    ";
    }

    // $third_image_url_tmp = $_FILES['third_image_url']['tmp_name'];
    // $fourth_image_url_tmp = $_FILES['fourth_image_url']['tmp_name'];

    // move_uploaded_file($third_image_url_tmp, "products_uploads/$third_image_url_tmp");
    // move_uploaded_file($fourth_image_url_tmp, "products_uploads/$fourth_image_url_tmp");

} else {
    header('Location:BestSellerPerfumes.php');
}
