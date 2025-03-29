<?php include('header.php'); ?>

<?php

// Check if the form has been submitted and if the password is not empty
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["new_password"])) {
    // Get the new password from the form
    $new_password = $_POST["new_password"];

    // Update the password directly in the database (no hash)
    $sql = "UPDATE adlogin SET password='$new_password'";

    // Run the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        // Success message with alert styling
        echo "<script>alert('Password updated successfully..!');windows.history.back();</script>";
    } else {
        // Error message with alert styling
        echo '<div style="color: red; padding: 10px; border: 1px solid red;">Error updating password: ' . mysqli_error($conn) . '</div>';
    }
} else {
    // Message for empty password field
    // echo '<div style="color: red; padding: 10px; border: 1px solid red;">Please enter a new password.</div>';
}
?>



<div class="content-wrapper" style="min-height: 1044px;">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Change Password</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="changepassword.php">
                            <div class="input-group input-group-sm">
                                <input type="password" name="new_password" class="form-control" placeholder="Please Enter Your New Password" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit">Change</button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include('footer.php'); ?>




<!-- Warning: Undefined global variable $_SESSION in F:\xampp\htdocs\BattingRaja\admin\changepassword.php on line 12

Warning: Trying to access array offset on value of type null in F:\xampp\htdocs\BattingRaja\admin\changepassword.php on line 12 -->