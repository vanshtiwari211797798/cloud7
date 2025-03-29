<?php include('header.php'); ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $vision = mysqli_real_escape_string($conn, $_POST['vision']);
    $mission = mysqli_real_escape_string($conn, $_POST['mission']);

    // Check if there's already an entry in the table
    $checkQuery = "SELECT COUNT(*) as count FROM vision_mission";
    $checkResult = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);

    if ($row['count'] > 0) {
        echo "<script>alert('Only one entry is allowed in the Mission & Vision.'); window.history.back();</script>";
    } else {
        // Insert into table
        $query = "INSERT INTO vision_mission (vision, mission) VALUES ('$vision', '$mission')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Mission & Vision added successfully!'); window.location.href = 'about.php';</script>";
        } else {
            echo "<script>alert('Failed to add data.'); window.history.back();</script>";
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
                        <h3 class="box-title">Mission & Vision</h3>
                    </div>
                    <form role="form" method="POST" action="about.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Vision</label>
                                        <textarea placeholder="Write your vision..." name="vision" rows="4" class="form-control" required style="width: 100%;"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Mission</label>
                                        <textarea placeholder="Write your mission..." name="mission" rows="4" class="form-control" required style="width: 100%;"></textarea>
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
                        <h3 class="box-title">Mission & Vision Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM vision_mission ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mission</th>
                                        <th>Vision</th>
                                        <th>Created At</th>
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
                                            echo "<td>" . $row['vision'] . "</td>";
                                            echo "<td>" . $row['mission'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>
                                            <form method='POST' action='updateabout.php'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' name='about' class='btn btn-primary fa fa-pencil'></button>
                                            </form>
                                            </td>";
                                            echo "<td>
                                            <form method='POST' action='delete.php'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' name='about' class='btn btn-danger fa fa-trash'></button>
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