<?php include('header.php'); ?>

<?php
// include "db_connect.php"; // Make sure your DB connection file is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['description'])) {
        echo "<script>alert('Category name is required');</script>";
    } elseif (empty($_FILES['gift_image']['name'])) {
        echo "<script>alert('Category image is required');</script>";
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['description']);
        $imageName = $_FILES['gift_image']['name'];
        $imageTmp = $_FILES['gift_image']['tmp_name'];

        // Optional: Validate file type (allow only jpg, png, jpeg, gif)
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed');</script>";
            exit;
        }

        // Move file
        if (move_uploaded_file($imageTmp, "../gift/$imageName")) {
            $sql = "INSERT INTO gifting_wooden_box_perfumes (gift_image, description) VALUES ('$imageName','$name')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert(' uploaded successfully');</script>";
            } else {
                echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Image upload failed');</script>";
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
                        <h3 class="box-title">Gifting Wooden Box Perfumes</h3>
                    </div>
                    <form role="form" method="POST" action="GiftingWoodenBoxPerfumes.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile" name="gift_image"
                                            onchange="previewImage(event)">
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="form-group">
                                        <img id="imagePreview" src="#" alt="Image Preview"
                                            style="display: none; max-width: 100%; height: auto;" />
                                    </div>
                                </div>
                                <script>
                                function previewImage(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('imagePreview');
                                        output.src = reader.result;
                                        output.style.display = 'block';
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                                </script>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Description</label>
                                        <input type="text" class="form-control" placeholder="Description"
                                            id="exampleInputFile" name="description">
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
                        <h3 class="box-title">Gifting Wooden Box Perfumes Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM gifting_wooden_box_perfumes ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gift Image</th>
                                        <th>Description</th>
                                        <th>Upload Date</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are results
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row in the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td><img src='../gift/" . $row['gift_image'] . "' style='max-width: 100px; height: auto;' /></td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>
                                                    <form method='POST' action='updategwpb.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='giftbox' class='btn btn-primary fa fa-edit'></button>
                                                    </form>
                                                </td>";
                                            echo "<td>
                                                    <form method='POST' action='delete.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='giftbox' class='btn btn-danger fa fa-trash'></button>
                                                    </form>
                                                </td>";
                                        echo "</tr>";
                                        }
                                    } else {
                                        // If no users found, display a message
                                        echo "<tr><td colspan='12'>No users found</td></tr>";
                                    }
                                    //mysqli_close($conn);
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