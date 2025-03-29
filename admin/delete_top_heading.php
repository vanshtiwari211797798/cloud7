<?php include('../includes/db.php'); ?>

<?php
    
    if(!isset($_GET['id'])){
        header('Location:top_offer.php');
    }else{
        $id=$_GET['id'];
        $sql="DELETE FROM top_offer WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Offer heading Deleted Successfully');
                window.location.href='top_offer.php';
            </script>
        ";
        }
    }
?>