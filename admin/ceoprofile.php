<?php include('header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $founder_name = mysqli_real_escape_string($conn, $_POST['founder_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $founder_image = '';

    // Handle file upload
    if (isset($_FILES['founder_image']) && $_FILES['founder_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $fileName = basename($_FILES['founder_image']['name']);
        $filePath = $uploadDir . $fileName;

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['founder_image']['tmp_name'], $filePath)) {
            $founder_image = $fileName;
        }
    }

    // Check if there is already an entry in the table
    $checkQuery = "SELECT COUNT(*) as count FROM founder_note";
    $checkResult = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);

    if ($row['count'] == 0) {
        $query = "INSERT INTO founder_note (founder_name, description, founder_image) VALUES ('$founder_name', '$description', '$founder_image')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Founder note added successfully!'); window.location.href = 'ceoprofile.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to add founder note.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Only one founder note is allowed.'); window.history.back();</script>";
    }
}
?>



<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">CEO Profile</h3>
                    </div>
                    <form role="form" method="POST" action="ceoprofile.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile" name="founder_image"
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
                                        <label for="exampleInputFile">Founder Name</label>
                                        <input type="text" class="form-control" placeholder="founder_name"
                                            id="exampleInputFile" name="founder_name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Note</label>
                                        <input type="text" class="form-control" placeholder="Write a note..."
                                            id="exampleInputFile" name="description">
                                    </div>
                                </div>
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
                        <h3 class="box-title">CEO Profile Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM founder_note ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Founder Name</th>
                                        <th>Image</th>
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
                                            echo "<td>" . $row['founder_name'] . "</td>";
                                            echo "<td><img src='../uploads/" . $row['founder_image'] . "' style='max-width: 100px; height: auto;' /></td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>
                                                    <form method='POST' action='updatecp.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='ceoprofile' class='btn btn-primary fa fa-edit'></button>
                                                    </form>
                                                </td>";
                                            echo "<td>
                                                    <form method='POST' action='delete.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='ceoprofile' class='btn btn-danger fa fa-trash'></button>
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