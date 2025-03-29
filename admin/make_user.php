<?php
    include("../includes/db.php");
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="UPDATE users SET role=0 WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
                <script>
                    alert('User Updated successfully');
                    window.location.href='users.php';
                </script>
            ";
        }
    }else{
        header('Location:users.php');
    }
?>