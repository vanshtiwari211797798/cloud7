<?php
    include("../includes/db.php");
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id =$_POST['id'];
        $sql="DELETE FROM combo_offer WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            echo "
                <script>
                    alert('Combo offer deleted successfully');
                    window.location.href='Add_combo_offer.php';
                </script>
            ";
        }
    }else{
        header('Location:Add_combo_offer.php');
    }
?>