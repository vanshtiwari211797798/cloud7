<?php include('../includes/db.php'); ?>

<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Fetch the current record
    $query = "SELECT * FROM vision_mission WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $vision = mysqli_real_escape_string($conn, $_POST['vision']);
    $mission = mysqli_real_escape_string($conn, $_POST['mission']);
    $updateQuery = "UPDATE vision_mission 
                    SET vision='$vision', mission='$mission' 
                    WHERE id='$id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Mission & Vision Updated Successfully!'); window.location='about.php';</script>";
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
    <title>Update Vision & Mission</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-bullseye"></i> Update Vision & Mission</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                <!-- Vision -->
                <div class="mb-3">
                    <label class="form-label"><strong>Vision:</strong></label>
                    <textarea name="vision" class="form-control" rows="3" required><?= $row['vision']; ?></textarea>
                </div>

                <!-- Mission -->
                <div class="mb-3">
                    <label class="form-label"><strong>Mission:</strong></label>
                    <textarea name="mission" class="form-control" rows="3" required><?= $row['mission']; ?></textarea>
                </div>

                <!-- Update Button -->
                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="about.php" class="btn btn-secondary">
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
