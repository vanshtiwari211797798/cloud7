<?php
include('header.php');
include('../includes/db.php');


?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['offer_heading'])) {
        echo "
                <script>
                    alert('Offer heading field is required')
                </script>
            ";
    }elseif(empty($_POST['peice'])){
        echo "
                <script>
                    alert('Peice field is required')
                </script>
            ";
    }elseif(empty($_POST['off'])){
        echo "
        <script>
            alert('Off field is required')
        </script>
    ";
    } else {
        $offer_heading = $_POST['offer_heading'];
        $peice = $_POST['peice'];
        $off = $_POST['off'];
        $sql = "INSERT INTO top_offer (offer_heading, peice, off) VALUES ('$offer_heading','$peice','$off')";
        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Offer heading Added Successfully');
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
                        <h3 class="box-title">Add Top Offer</h3>
                    </div>
                    <form role="form" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Top heading</label>
                                        <input type="text" class="form-control" placeholder="Top heading"
                                            id="exampleInputFile" name="offer_heading">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Enter Peice</label>
                                        <input type="number" class="form-control" placeholder="Enter Peice"
                                            id="exampleInputFile" name="peice">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Off Percentage</label>
                                        <input type="number" class="form-control" placeholder="Off Percentage"
                                            id="exampleInputFile" name="off">
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
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Top Heading</h3>
                        <!-- <div class="box-tools">
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SR</th>
                                        <th>Heading</th>
                                        <th>Total Peice</th>
                                        <th>Off Percentage</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM top_offer";
                                    $data = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($data) > 0) {
                                        while ($record = mysqli_fetch_assoc($data)) {



                                    ?>
                                            <tr>
                                                <td><?= $record['id'] ?></td>
                                                <td><?= $record['offer_heading'] ?></td>
                                                <td><?= $record['peice'] ?></td>
                                                <td><?= $record['off'] ?>%</td>
                                                <td><a href="update_top_offer.php?id=<?= $record['id'] ?>" style="color: green;">Update</a></td>
                                                <td><a href="delete_top_heading.php?id=<?= $record['id'] ?>" style="color: red;">Delete</a></td>
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