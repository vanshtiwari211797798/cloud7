<?php
session_start();
include("includes/db.php");
if (!isset($_GET['id'])) {
    header('Location:Wishlist.php');
} else {
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $user_email = $_SESSION['email'];
    $sql="DELETE FROM wisslist WHERE id=$id AND user_email='$user_email'";
    if(mysqli_query($conn,$sql)){
        echo "
        <script>
            alert('Wisslist Deleted Successfully');
            window.location.href='Wishlist.php';
        </script>
    ";
    }
}
