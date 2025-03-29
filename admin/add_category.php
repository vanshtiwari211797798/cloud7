<?php
include("../includes/db.php");
include('header.php');
?>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        echo "
            <script>
                alert('Category name is required');
            </script>
        ";
    } elseif (empty($_FILES['image']['name'])) {
        echo "
            <script>
                alert('Category image is required');
            </script>
        ";
    } else {
        $name = $_POST['name'];
        $imageName = $_FILES['image']['name'];
        $imageNameTmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imageNameTmp, "category/$imageName");
        $sql = "INSERT INTO category (image, name) VALUES ('$imageName','$name')";
        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Category Uploaded successfully');
                </script>
            ";
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
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile" name="image"
                                            onchange="previewImage(event)">
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
                                        <label for="exampleInputFile">Category Name</label>
                                        <input type="text" class="form-control" placeholder="Category Name"
                                            id="exampleInputFile" name="name">
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
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Category Name</th>
                                        <!-- <th>Update</th> -->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $categoryData_sql = "SELECT * FROM category";
                                    $category_data = mysqli_query($conn, $categoryData_sql);
                                    if (mysqli_num_rows($category_data) > 0) {
                                        while ($record = mysqli_fetch_assoc($category_data)) {
                                            

                                    ?>
                                            <tr>
                                                <td><?=$record['id']?></td>
                                                <td><img src="category/<?=$record['image']?>" alt="category image" height="50px" width="50px"></td>
                                                <td><?=$record['name']?></td>
                                                <!-- <td><a href="" style="color: green;">Update</a></td> -->
                                                <td><a href="delete_category.php?id=<?=$record['id']?>" style="color: red;">Delete</a></td>
                                            </tr>
                                    <?php
                                        }
                                    }
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