<?php include('../includes/db.php'); ?>

<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the current record
    $query = "SELECT * FROM gifting_wooden_box_perfumes WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    
    // Escape special characters to prevent SQL injection
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle file upload
    if (!empty($_FILES['gift_image']['name'])) {
        $target_dir = "../gift/";
        $target_file = $target_dir . basename($_FILES["gift_image"]["name"]);
        move_uploaded_file($_FILES["gift_image"]["tmp_name"], $target_file);
    } else {
        $target_file = $row['gift_image']; // Keep the old image if no new image is uploaded
    }

    // Update the record safely
    $updateQuery = "UPDATE gifting_wooden_box_perfumes 
                    SET gift_image='$target_file', description='$description' 
                    WHERE id='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Gifting Wooden Box Perfumes updated successfully!');window.location='GiftingWoodenBoxPerfumes.php';</script>"; //window.location='GiftingWoodenBoxPerfumes.php';
        exit;
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Gift Box</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-gift"></i> Update Gift Box</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                <!-- Gift Image Preview -->
                <div class="mb-3 text-center">
                    <label class="form-label"><strong>Current Gift Image:</strong></label><br>
                    <img src="../gift/<?= $row['gift_image']; ?>" class="img-thumbnail" width="150">
                </div>

                <!-- Upload New Image -->
                <div class="mb-3">
                    <label class="form-label"><strong>Upload New Gift Image:</strong></label>
                    <input type="file" name="gift_image" class="form-control">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label"><strong>Description:</strong></label>
                    <textarea name="description" class="form-control" rows="4"><?= $row['description']; ?></textarea>
                </div>

                <!-- Update Button -->
                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="GiftingWoodenBoxPerfumes.php" class="btn btn-secondary">
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
