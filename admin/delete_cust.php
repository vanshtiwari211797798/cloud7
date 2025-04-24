<?php
    include("../includes/db.php");
    if(!isset($_GET['id'])){
        header('Location:add_customzation.php');
    }else{
        $id=$_GET['id'];
        $sql="DELETE FROM customization WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Customize deleted successfully');
                window.location.href='add_customzation.php';
            </script>
        ";
        }
    }
?>