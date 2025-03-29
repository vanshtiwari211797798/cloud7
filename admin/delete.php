<?php include('../includes/db.php'); ?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM slider WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Image deleted successfully!'); window.location.href = 'slider.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.'); window.location.href = 'slider.php';</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['about'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM vision_mission WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Mission & Vision deleted successfully!'); window.location.href = 'about.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.');window.location.href = 'about.php';</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ceoprofile'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM founder_note WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Founder note deleted successfully!'); window.location.href = 'ceoprofile.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.'); window.location.href = 'ceoprofile.php';</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addsocialmedialink'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM social_media_links WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Link deleted successfully!'); window.location.href = 'AddSocialMediaLink.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.'); window.location.href = 'AddSocialMediaLink.php';</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['giftbox'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM gifting_wooden_box_perfumes WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Gift deleted successfully!'); window.location.href = 'GiftingWoodenBoxPerfumes.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.'); window.location.href = 'GiftingWoodenBoxPerfumes.php';</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['perfumes'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM product_items WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product deleted successfully!'); window.location.href = 'BestSellerPerfumes.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the Product.'); window.location.href = 'BestSellerPerfumes.php';</script>";
    }
}
?>