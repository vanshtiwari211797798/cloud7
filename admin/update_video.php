<?php
ob_start();
include("header.php");
include("../includes/db.php");


// here update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['uid'];
    $old_file = $_POST['old_file'];
    if (empty($_FILES['video']['name'])) {
        $fileName = $old_file;
    } else {
        $fileName = $_FILES['video']['name'];
        $fileNameTmp = $_FILES['video']['tmp_name'];
        move_uploaded_file($fileNameTmp, "products_uploads/$fileName");
    }
    $updtVdo = "UPDATE videos SET video='$fileName' WHERE id=$id";
    if (mysqli_query($conn, $updtVdo)) {
        echo "
    <script>
        alert('Video Updated successfully');
        window.location.href='add_videos.php';
    </script>
";
    }
}





if (!isset($_GET['id'])) {
    header('Location:add_videos.php');
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM videos WHERE id=$id";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) > 0) {
        $res = mysqli_fetch_assoc($data);

?>

        <div class="content-wrapper" style="min-height: 1044px;">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Update Video</h3>
                            </div>
                            <div class="box-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="uid" value="<?= $res['id'] ?>">
                                    <input type="hidden" name="old_file" value="<?= $res['video'] ?>">
                                    <div class="input-group input-group-sm">
                                        <input type="file" name="video" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-flat" type="submit">Update</button>
                                        </span>
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