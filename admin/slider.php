<?php include('header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // File upload handling
    if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/'; // Directory to store uploaded files
        $fileName = basename($_FILES['slider_image']['name']);
        $filePath = $uploadDir . $fileName;

        // Check the number of images already uploaded
        $query = "SELECT COUNT(*) as total FROM slider";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['total'] < 4) {
            // Create the upload directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($_FILES['slider_image']['tmp_name'], $filePath)) {
                // Insert file details into the database
                $query = "INSERT INTO slider (slider_image) VALUES ('$fileName')";

                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Image uploaded and saved successfully!'); window.location.href = 'slider.php';</script>";
                } else {
                    echo "<script>alert('Error saving image details to the database.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Error uploading file.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Maximum of 4 images can be uploaded otherwise your website will be slow down with more images..!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No file uploaded or an error occurred.'); window.history.back();</script>";
    }
}
?>

<?php
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = intval($_POST['id']); // Sanitize the input

    // Delete the record from the slider table
    $query = "DELETE FROM slider WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Image deleted successfully!'); window.location.href = 'slider.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the image.'); window.history.back();</script>";
    }
}
?>



<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <form role="form" method="POST" action="slider.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile" name="slider_image"
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
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-top: 25px;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Slider Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM slider ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Images</th>
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
                                        // echo "<td>" . $row['slider_image'] . "</td>";
                                        echo "<td><img src='../uploads/" . $row['slider_image'] . "' alt='Slider Image' style='max-width: 100px; height: auto;'></td>";
                                        echo "<td>" . $row['uploaded_at'] . "</td>";
                                        echo "<td>
                                                <form method='POST' action='updateslider.php'>
                                                    <input type='hidden' name='id' value='" . $row['id']. "'>
                                                    <button type='submit' name='edit' class='btn btn-warning fa fa-edit'></button>
                                                </form>
                                            </td>";
                                        echo "<td>
                                                <form method='POST' action='delete.php'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' name='delete' class='btn btn-danger fa fa-trash'></button>
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