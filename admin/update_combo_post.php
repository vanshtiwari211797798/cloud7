<?php
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['id'];
    
    // Old images (used if no new image is uploaded)
    $img1 = $_POST['old_img_1'];
    $img2 = $_POST['old_img_2'];
    $img3 = $_POST['old_img_3'];
    $img4 = $_POST['old_img_4'];

    // Form fields
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

    // Handle file uploads (primary and secondary image)
    $img_data_1 = $img1; // Default to old image
    $img_data_2 = $img2; // Default to old image

    if (!empty($_FILES['primary_image_url']['name'])) {
        // Check if a new primary image is uploaded
        $img_data_1 = $_FILES['primary_image_url']['name'];
        $primary_image_url_tmp = $_FILES['primary_image_url']['tmp_name'];
        
        // Move the uploaded file to the server
        if (move_uploaded_file($primary_image_url_tmp, "products_uploads/$img_data_1")) {
            echo "Primary image uploaded successfully.<br>"; // Debugging line
        } else {
            echo "Failed to upload primary image.<br>"; // Debugging line
        }
    }

    if (!empty($_FILES['secondary_image_url']['name'])) {
        // Check if a new secondary image is uploaded
        $img_data_2 = $_FILES['secondary_image_url']['name'];
        $secondary_image_url_tmp = $_FILES['secondary_image_url']['tmp_name'];
        
        // Move the uploaded file to the server
        if (move_uploaded_file($secondary_image_url_tmp, "products_uploads/$img_data_2")) {
            echo "Secondary image uploaded successfully.<br>"; // Debugging line
        } else {
            echo "Failed to upload secondary image.<br>"; // Debugging line
        }
    }

    // Update SQL query with new or existing image paths
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

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Product Updated successfully');
                window.location.href='Add_combo_offer.php';
            </script>
        ";
    } else {
        echo "<script>alert('Error updating product: " . mysqli_error($conn) . "');</script>";
    }

} else {
    header('Location:BestSellerPerfumes.php');
}
