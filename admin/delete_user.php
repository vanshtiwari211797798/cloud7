<?php
    include("../includes/db.php");
    if(!isset($_GET['id'])){
        header('Location:users.php');
    }else{
        $id=$_GET['id'];
        $sql="DELETE FROM users WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('User deleted successfully');
                window.location.href='users.php';
            </script>
        ";
        }
    }
?>