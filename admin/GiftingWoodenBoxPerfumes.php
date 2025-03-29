<?php include('header.php'); ?>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // File upload configuration
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["giftimage"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["giftimage"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "<script>alert('File is not an image.');window.location.back();</script>";
        $upload_ok = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, image is already exist in upload folder already exists.');window.location.back();</script>";
        $upload_ok = 0;
    }

    // Check file size (limit: 5MB)
    if ($_FILES["giftimage"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');window.location.back();</script>";
        $upload_ok = 0;
    }

    // Allow only certain file formats
    if (
        $image_file_type != "jpg" &&
        $image_file_type != "png" &&
        $image_file_type != "jpeg" &&
        $image_file_type != "gif"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.location.back();</script>";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');window.location.back();</script>";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["giftimage"]["tmp_name"], $target_file)) {
            // Sanitize description input
            $description = $conn->real_escape_string($_POST['paragraph']);

            // Check if there is already an entry in the database
            $check_sql = "SELECT COUNT(*) as count FROM gifting_wooden_box_perfumes";
            $check_result = $conn->query($check_sql);
            $row = $check_result->fetch_assoc();

            if ($row['count'] > 0) {
                echo "<script>alert('Only one entry is allowed.');window.location.href='GiftingWoodenBoxPerfumes.php';</script>";
            } else {
                // Insert data into the database
                $sql = "INSERT INTO gifting_wooden_box_perfumes (gift_image, description)
                        VALUES ('$target_file', '$description')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Gift added successfully!');window.location.href='GiftingWoodenBoxPerfumes.php'</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "');window.location.back();</script>";
                }
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');window.location.back();</script>";
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
                                        <input type="file" id="exampleInputFile" name="giftimage"
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
                                            id="exampleInputFile" name="paragraph">
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
                                            echo "<td><img src='../uploads/" . $row['gift_image'] . "' style='max-width: 100px; height: auto;' /></td>";
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