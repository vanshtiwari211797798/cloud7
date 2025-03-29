<?php
include("../includes/db.php");
include('header.php');
?>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['coupon_code'])) {
        echo "
            <script>
                alert('Coupon code is required');
            </script>
        ";
    } elseif (empty($_POST['coupon_off'])) {
        echo "
            <script>
                alert('Coupon off percentage is required');
            </script>
        ";
    } else {
        $coupon_code = $_POST['coupon_code'];
        $coupon_off = $_POST['coupon_off'];
        $fetch_Cpn="SELECT * FROM coupon WHERE coupon_code='$coupon_code'";
        $cpn_data=mysqli_query($conn,$fetch_Cpn);
        if(mysqli_num_rows($cpn_data)==0){
            $sql = "INSERT INTO coupon (coupon_code, coupon_off) VALUES ('$coupon_code','$coupon_off')";
            if (mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Coupon Added successfully');
                    </script>
                ";
            }
        }else{
            echo "
            <script>
                alert('Coupon allreday exist');
            </script>
        ";
        }
    }
}
?>

<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <form role="form" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Coupon Code</label>
                                        <input type="text" class="form-control" placeholder="Coupon Code"
                                            id="exampleInputFile" name="coupon_code">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Coupon Off</label>
                                        <input type="number" class="form-control" placeholder="Coupon off percentage"
                                            id="exampleInputFile" name="coupon_off">
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

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon off</th>
                                        <!-- <th>Update</th> -->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlFetch_coupon = "SELECT * FROM coupon";
                                    $data = mysqli_query($conn, $sqlFetch_coupon);
                                    if (mysqli_num_rows($data) > 0) {
                                        $sr = 1;
                                        while ($res = mysqli_fetch_assoc($data)) {


                                    ?>
                                            <tr>
                                                <td><?= $sr++ ?></td>
                                                <td><?= $res['coupon_code'] ?></td>
                                                <td><?= $res['coupon_off'] ?> % off</td>
                                                <td><a href="delete_coupon.php?id=<?=$res['id']?>">Delete</a></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include('footer.php'); ?>