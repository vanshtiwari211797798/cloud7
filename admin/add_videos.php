<?php
include('header.php');
include('../includes/db.php');


?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_FILES['video']['name'])) {
        echo "
        <script>
            alert('Video filed is required');
        </script>
    ";
    } else {
        $video = $_FILES['video']['name'];
        $video_tmp_name = $_FILES['video']['tmp_name'];
        move_uploaded_file($video_tmp_name, "products_uploads/$video");
        $sql = "INSERT INTO videos (video) VALUES ('$video')";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Video Uploaded successfully');
            </script>
        ";
        }
    }
}

?>
<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Add Video</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-group input-group-sm">
                                <input type="file" name="video" class="form-control" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit">Add</button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Videos</h3>
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
                                        <th>Id</th>
                                        <th>Video</th>
                                        <th>Update</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT * FROM videos";
                                    $data2 = mysqli_query($conn, $sql2);
                                    if (mysqli_num_rows($data2) > 0) {
                                        while ($res = mysqli_fetch_assoc($data2)) {
                                            $sr=1; //define the serial number of the videos

                                    ?>
                                            <tr>
                                                <td><?=$sr++?></td>
                                                <td> <video class="productVideo" height="100px" width="100px" autoplay muted >
                                                        <source src="products_uploads/<?=$res['video']?>" type="video/mp4">
                                                    </video></td>
                                                <td><a href="update_video.php?id=<?=$res['id']?>">Update</a></td>
                                                <td><a href="delete_video.php?id=<?=$res['id']?>">Delete</a></td>
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