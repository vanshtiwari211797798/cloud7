<?php
    include("../includes/db.php");
    if(!isset($_GET['id'])){
        header('Location:add_coupon.php');
    }else{
        $id=$_GET['id'];
        $sql="DELETE FROM coupon WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Coupon deleted successfully');
                window.location.href='add_coupon.php';
            </script>
        ";
        }
    }
?>