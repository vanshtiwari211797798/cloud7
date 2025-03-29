<?php include('header.php'); ?>

<div class="content-wrapper" style="min-height: 948px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users Report</h3>
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
                        <?php
                        // Start a session (optional if needed for logged-in user)

                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SR</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>User</th>
                                        <th>Admin</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                // Check if there are results
                                if (mysqli_num_rows($result) > 0) {
                                    $sr = 1; // Initialize serial number
                                    // Loop through each row in the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $sr++ . "</td>"; // Display serial number
                                        echo "<td>" . $row['full_name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        echo "<td><a href='make_user.php?id=" . $row['id'] . "'>✅</a></td>";
                                        echo "<td><a href='make_admin.php?id=" . $row['id'] . "'>✅</a></td>";
                                        echo "<td><a href='delete_user.php?id=" . $row['id'] . "'>Delete</a></td>";
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