<?php
ob_start();
include("../includes/db.php");
include('header.php');

// update the delivery date
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $uid=$_POST['uid'];
        $delivery_date = $_POST['delivery_date'];
        $sql = "UPDATE orders SET delivery_date='$delivery_date' WHERE order_id=$uid";
        if(mysqli_query($conn,$sql)){
            echo "
                <script>
                    alert('Delivery Date updated successfully');
                    window.location.href='orderhistory.php';
                </script>
            ";
        }
    }


if(!isset($_GET['order_id'])){
    header('Location:orderhistory.php');
}else{
    $order_id=$_GET['order_id'];
    $sqlFetchOrderData="SELECT * FROM orders WHERE order_id=$order_id";
    $dataOrder = mysqli_query($conn,$sqlFetchOrderData);
    if(mysqli_num_rows($dataOrder)>0){
        $res = mysqli_fetch_assoc($dataOrder);
    }
}
?>

<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Delivery Date</h3>
                    </div>
                    <form role="form" method="POST">
                        <input type="hidden" name="uid" value="<?=$res['order_id']?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Delivery Date</label>
                                        <input type="date" class="form-control"
                                            id="exampleInputFile" name="delivery_date" value="<?=$res['delivery_date']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

   

        </div>
    </section>
</div>

<?php include('footer.php'); ?>