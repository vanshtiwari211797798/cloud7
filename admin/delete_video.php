<?php
    include("../includes/db.php");
    if(!isset($_GET['id'])){
        header('Location:add_videos.php');
    }else{
        $id=$_GET['id'];
        $sql="DELETE FROM videos WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Video deleted successfully');
                window.location.href='add_videos.php';
            </script>
        ";
        }
    }
?>