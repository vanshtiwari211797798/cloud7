<?php include('../includes/db.php'); ?>

<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM slider WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    if (!empty($_FILES['slider_image']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["slider_image"]["name"]);
        move_uploaded_file($_FILES["slider_image"]["tmp_name"], $target_file);
    } else {
        $target_file = $row['slider_image']; // Keep the old image if no new image is uploaded
    }
    $updateQuery = "UPDATE slider SET slider_image='$target_file' WHERE id='$id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Slider image updated successfully!'); window.location='slider.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating slider: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Slider Image</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white text-center">
            <h3><i class="fas fa-image"></i> Update Slider Image</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                <!-- Slider Image Preview -->
                <div class="mb-3 text-center">
                    <label class="form-label"><strong>Current Slider Image:</strong></label><br>
                    <img src="../uploads/<?= $row['slider_image']; ?>" class="img-thumbnail" width="250">
                </div>

                <!-- Upload New Image -->
                <div class="mb-3">
                    <label class="form-label"><strong>Upload New Slider Image:</strong></label>
                    <input type="file" name="slider_image" class="form-control">
                </div>

                <!-- Update Button -->
                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="slider.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
