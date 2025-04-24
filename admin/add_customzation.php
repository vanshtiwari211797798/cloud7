<?php
include("../includes/db.php");
include('header.php');
?>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heading = $_POST['heading'];
    $para = $_POST['para'];
    $photoName = $_FILES['photo']['name'];
    $photoNameTmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photoNameTmp,"customization/$photoName");
    $fetch_cust = "SELECT * FROM customization";
    $cpn_data = mysqli_query($conn, $fetch_cust);
    if (mysqli_num_rows($cpn_data) == 0) {
        $sql = "INSERT INTO customization (heading, para,photo) VALUES ('$heading','$para','$photoName')";
        if (mysqli_query($conn, $sql)) {
            echo "
                    <script>
                        alert('Added successfully');
                    </script>
                ";
        }
    } else {
        echo "
            <script>
                alert('Only one data can enter');
            </script>
        ";
    }
}
?>

<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Customization</h3>
                    </div>
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <input type="file" class="form-control"
                                            id="exampleInputFile" name="photo" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Heading</label>
                                        <input type="text" class="form-control" placeholder="Enter heading"
                                            id="exampleInputFile" name="heading" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Paragraph</label>
                                        <input type="text" class="form-control" placeholder="Enter paragraph"
                                            id="exampleInputFile" name="para" required>
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
                                        <th>Photo</th>
                                        <th>Heading</th>
                                        <th>Paragraph</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlFetch_coupon = "SELECT * FROM customization";
                                    $data = mysqli_query($conn, $sqlFetch_coupon);
                                    if (mysqli_num_rows($data) > 0) {
                                        $sr = 1;
                                        while ($res = mysqli_fetch_assoc($data)) {


                                    ?>
                                            <tr>
                                                <td><?= $sr++ ?></td>
                                                <td><img height="60px" width="100px" src="customization/<?=$res['photo']?>" alt=""></td>
                                                <td><?= $res['heading'] ?></td>
                                                <td><?= $res['para'] ?></td>
                                                <td><a href="delete_cust.php?id=<?= $res['id'] ?>">Delete</a></td>
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