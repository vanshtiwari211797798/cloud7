<?php
  include("../includes/db.php"); 
    $id = $_GET['order_id'];
    $delivery_status = $_GET['status'];
    $sql="UPDATE orders SET delivery_status='$delivery_status' WHERE order_id=$id";
    if(mysqli_query($conn,$sql)){
        echo "
            <script>
                alert('Delivery Status Updated Successfully');
                window.location.href='orderhistory.php';
            </script>
        ";
    }
?>