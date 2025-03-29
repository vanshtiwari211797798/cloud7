<?php include('header.php'); ?>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $facebook_link = $conn->real_escape_string($_POST['facebook_link']);
    $x_link = $conn->real_escape_string($_POST['x_link']);
    $instagram_link = $conn->real_escape_string($_POST['instagram_link']);

    // Insert data into the table
    $query = "INSERT INTO social_media_links (facebook_link, x_link, instagram_link) 
              VALUES ('$facebook_link', '$x_link', '$instagram_link')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Social media links added successfully!'); window.location.href = 'AddSocialMediaLink.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to add links.'); window.history.back();</script>";
    }
}
?>


<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Social Media Link</h3>
                    </div>
                    <form role="form" method="POST" action="AddSocialMediaLink.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Facebook Link</label>
                                        <input type="text" class="form-control" placeholder="Paste your link here..."
                                            id="exampleInputFile" name="facebook_link">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">X Link</label>
                                        <input type="text" class="form-control" placeholder="Paste your link here..."
                                            id="exampleInputFile" name="x_link">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Instagram Link</label>
                                        <input type="text" class="form-control" placeholder="Paste your link here..."
                                            id="exampleInputFile" name="instagram_link">
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
                        <h3 class="box-title">Social Media Link Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM social_media_links ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Facebook Link</th>
                                        <th>X Link</th>
                                        <th>Instagram Link</th>
                                        <th>Post Date</th>
                                        <th>Action</th>
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
                                            echo "<td>" . $row['facebook_link'] . "</td>";
                                            echo "<td>" . $row['x_link'] . "</td>";
                                            echo "<td>" . $row['instagram_link'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>
                                                    <form method='POST' action='delete.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='addsocialmedialink' class='btn btn-danger fa fa-trash'></button>
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