<?php
ob_start();
include("header.php");
include("../includes/db.php");


// here update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['offer_heading'])) {
        echo "
    <script>
        alert('Offer heading field is required');
    </script>
";
    } elseif (empty($_POST['peice'])) {
        echo "
        <script>
            alert('Peice field is required');
        </script>
    ";
    } elseif (empty($_POST['off'])) {
        echo "
        <script>
            alert('Off percentage field is required');
        </script>
    ";
    } else {
        $uid = $_POST['uid'];
        $offer_heading = $_POST['offer_heading'];
        $peice = $_POST['peice'];
        $off = $_POST['off'];
        $sql = "UPDATE top_offer SET offer_heading='$offer_heading',peice='$peice', off='$off' WHERE id=$uid";

        if (mysqli_query($conn, $sql)) {
            echo "
        <script>
            alert('Offer heading updated successfully');
            window.location.href='top_offer.php';
        </script>
    ";
        }
    }
}



if (!isset($_GET['id'])) {
    header('Location:top_offer.php');
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM top_offer WHERE id=$id";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) > 0) {
        $rec = mysqli_fetch_assoc($data)



?>

        <div class="content-wrapper" style="min-height: 1044px;">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Update Top Offer</h3>
                            </div>
                            <form role="form" method="POST">
                                <input type="hidden" name="uid" value="<?=$rec['id']?>">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Top heading</label>
                                                <input type="text" class="form-control" placeholder="Top heading"
                                                    id="exampleInputFile" value="<?= $rec['offer_heading'] ?>" name="offer_heading">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Enter Peice</label>
                                                <input type="number" class="form-control" placeholder="Enter Peice"
                                                    id="exampleInputFile" value="<?= $rec['peice'] ?>" name="peice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Off Percentage</label>
                                                <input type="number" class="form-control" placeholder="Off Percentage"
                                                    id="exampleInputFile" value="<?= $rec['off'] ?>" name="off">
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
        </div>
        </section>
        </div>

<?php

    }
}
?>