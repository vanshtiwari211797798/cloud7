<?php
include('header.php');
include("../includes/db.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['best_seller_catrgory'])) {
        echo "
            <script>
                alert('Category is required');
            </script>
        ";
    } elseif (empty($_POST['product_name'])) {
        echo "
        <script>
            alert('Product name is required');
        </script>
    ";
    } elseif (empty($_POST['quantity'])) {
        echo "
        <script>
            alert('Quantity is required');
        </script>
    ";
    } elseif (empty($_POST['product_price'])) {
        echo "
        <script>
            alert('Product price is required');
        </script>
    ";
    } elseif (empty($_POST['discount_percentage'])) {
        echo "
        <script>
            alert('Discount percentage is required');
        </script>
    ";
    } elseif (empty($_POST['sale_price'])) {
        echo "
        <script>
            alert('Sale price is required');
        </script>
    ";
    } elseif (empty($_FILES['primary_image_url']['name'])) {
        echo "
        <script>
            alert('Primary image is required');
        </script>
    ";
    } elseif (empty($_POST['rating'])) {
        echo "
        <script>
            alert('Rating is required');
        </script>
    ";
    } elseif (empty($_POST['raters'])) {
        echo "
        <script>
            alert('Raters is required');
        </script>
    ";
    } elseif (empty($_POST['is_best_seller'])) {
        echo "
        <script>
            alert('Best seller is required');
        </script>
    ";
    } elseif (empty($_POST['product_discription'])) {
        echo "
        <script>
            alert('Product Description is required');
        </script>
    ";
    } else {
        $best_seller_catrgory = mysqli_real_escape_string($conn, $_POST['best_seller_catrgory']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $discount_percentage = mysqli_real_escape_string($conn, $_POST['discount_percentage']);
        $sale_price = mysqli_real_escape_string($conn, $_POST['sale_price']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $raters = mysqli_real_escape_string($conn, $_POST['raters']);
        $is_best_seller = mysqli_real_escape_string($conn, $_POST['is_best_seller']);
        $product_discription = mysqli_real_escape_string($conn, $_POST['product_discription']);

        $primary_image_url = $_FILES['primary_image_url']['name'];
        $secondary_image_url = $_FILES['secondary_image_url']['name'];
        $third_image_url = $_FILES['third_image_url']['name'];
        $fourth_image_url = $_FILES['fourth_image_url']['name'];


        $primary_image_url_tmp = $_FILES['primary_image_url']['tmp_name'];
        $secondary_image_url_tmp = $_FILES['secondary_image_url']['tmp_name'];
        $third_image_url_tmp = $_FILES['third_image_url']['tmp_name'];
        $fourth_image_url_tmp = $_FILES['fourth_image_url']['tmp_name'];
        move_uploaded_file($primary_image_url_tmp, "products_uploads/$primary_image_url");
        move_uploaded_file($secondary_image_url_tmp, "products_uploads/$secondary_image_url");
        move_uploaded_file($third_image_url_tmp, "products_uploads/$third_image_url");
        move_uploaded_file($fourth_image_url_tmp, "products_uploads/$fourth_image_url");

        $sql = "INSERT INTO combo_offer (
            best_seller_catrgory, product_name, quantity, product_price, discount_percentage, 
            sale_price, rating, raters, is_best_seller, product_discription, 
            primary_image_url, secondary_image_url,third_image_url,fourth_image_url
        ) VALUES (
            '$best_seller_catrgory', '$product_name', '$quantity', '$product_price', '$discount_percentage', 
            '$sale_price', '$rating', '$raters', '$is_best_seller', '$product_discription', 
            '$primary_image_url', '$secondary_image_url','$third_image_url','$fourth_image_url'
        )";

        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Product added successfully');
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
                        <h3 class="box-title">Add Products</h3>
                    </div>
                    <form role="form" method="POST" action="" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <!-- Best Seller Category -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="best_seller_catrgory">Best Seller Category</label>
                                        <select class="form-control" id="best_seller_catrgory"
                                            name="best_seller_catrgory">
                                            <option value="" selected>Select Seller Category</option>
                                            <!-- <option value="Our Best Seller Perfumes">Our Best Seller Perfumes</option>
                                            <option value="Combo Offer">Combo Offer</option>
                                            <option value="Unisex">Unisex</option>
                                            <option value="Discovery Set">Discovery Set</option>
                                            <option value="Wolden Set">Wolden Set</option>
                                            <option value="Wolden Set">Gifting Box</option>
                                            <option value="Men">Men</option>
                                            <option value="Women">Women</option> -->
                                            <?php
                                            $category_fetch_sql = "SELECT name FROM category";
                                            $category_data = mysqli_query($conn, $category_fetch_sql);
                                            if (mysqli_num_rows($category_data) > 0) {
                                                while ($record = mysqli_fetch_assoc($category_data)) {



                                            ?>
                                                    <option value="<?=$record['name']?>"><?=$record['name']?></option>
                                            <?php
                                                }
                                            }else{
                                                echo "No category available";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Name -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="product_name"
                                            placeholder="Enter product name" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantity">Select Quantity</label>
                                        <select class="form-control" id="quantity" name="quantity" required>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Price -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="productPrice">Product MRP Price</label>
                                        <input type="number" step="0.01" class="form-control" id="productPrice"
                                            name="product_price" placeholder="Enter product price" required>
                                    </div>
                                </div>

                                <!-- Discount Percentage -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="DiscountPercentage">Discount Percentage</label>
                                        <input type="number" class="form-control" id="DiscountPercentage"
                                            name="discount_percentage" placeholder="Enter discount percentage" required>
                                    </div>
                                </div>

                                <!-- Sale Price (Auto-Calculated) -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="salePrice">Product Selling Price</label>
                                        <input type="number" step="0.01" class="form-control" id="salePrice"
                                            name="sale_price" placeholder="Enter sale price" required readonly>
                                    </div>
                                </div>

                                <!-- Product Image -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="primaryImage">Primary Image</label>
                                        <input type="file" id="primaryImage" name="primary_image_url"
                                            onchange="previewImage(event, 'primaryPreview')" required>
                                        <p class="help-block">Upload the primary image of the product.</p>
                                    </div>
                                    <div class="form-group">
                                        <img id="primaryPreview" src="#" alt="Primary Image Preview"
                                            style="display: none; max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- Secondary Image -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="secondaryImage">Secondary Image</label>
                                        <input type="file" id="secondaryImage" name="secondary_image_url"
                                            onchange="previewImage(event, 'secondaryPreview')">
                                        <p class="help-block">Upload the secondary image of the product (optional).</p>
                                    </div>
                                    <div class="form-group">
                                        <img id="secondaryPreview" src="#" alt="Secondary Image Preview"
                                            style="display: none; max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- Tertiary Image -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="TertiaryImage">Tertiary Image</label>
                                        <input type="file" id="TertiaryImage" name="third_image_url"
                                            onchange="previewImage(event, 'TertiaryPreview')">
                                        <p class="help-block">Upload the tertiary image of the product (optional).</p>
                                    </div>
                                    <div class="form-group">
                                        <img id="TertiaryPreview" src="#" alt="Tertiary Image Preview"
                                            style="display: none; max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- Quaternary Image -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="QuaternaryImage">Quaternary Image</label>
                                        <input type="file" id="QuaternaryImage" name="fourth_image_url"
                                            onchange="previewImage(event, 'QuaternaryPreview')">
                                        <p class="help-block">Upload the quaternary image of the product (optional).</p>
                                    </div>
                                    <div class="form-group">
                                        <img id="QuaternaryPreview" src="#" alt="Quaternary Image Preview"
                                            style="display: none; max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- Product Rating -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="productRating">Product Rating</label>
                                        <input type="number" step="0.1" class="form-control" id="productRating"
                                            name="rating" placeholder="Enter product rating (e.g., 4.5)">
                                    </div>
                                </div>

                                <!-- Product Raters -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="ratersCount">Number of Raters</label>
                                        <input type="number" class="form-control" id="ratersCount" name="raters"
                                            placeholder="Enter number of raters">
                                    </div>
                                </div>

                                <!-- Best Seller -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="isBestSeller">Best Seller</label>
                                        <select class="form-control" id="isBestSeller" name="is_best_seller">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Discription -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="productDiscription">Product Discription</label>
                                        <input type="text" class="form-control" id="productDiscription" name="product_discription"
                                            placeholder="Enter product discription" required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-top: 25px;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        function previewImage(event, previewId) {
                            var reader = new FileReader();
                            reader.onload = function() {
                                var output = document.getElementById(previewId);
                                output.src = reader.result;
                                output.style.display = 'block';
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    </script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const productPrice = document.getElementById("productPrice");
                            const discountPercentage = document.getElementById("DiscountPercentage");
                            const salePrice = document.getElementById("salePrice");

                            function calculateSalePrice() {
                                let price = parseFloat(productPrice.value) || 0;
                                let discount = parseFloat(discountPercentage.value) || 0;
                                let discountAmount = (discount / 100) * price;
                                let finalPrice = price - discountAmount;
                                salePrice.value = finalPrice.toFixed(2); // Keep two decimal places
                            }

                            productPrice.addEventListener("input", calculateSalePrice);
                            discountPercentage.addEventListener("input", calculateSalePrice);
                        });
                    </script>

                </div>
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Products Report</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php


                        // Query to select all fields from the user_register table
                        $sql = "SELECT * FROM product_items ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <div style="overflow-x: auto; overflow-y: auto; max-height: 400px; max-width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <!-- <th>Product Id</th> -->
                                        <th>Product Category</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Primary Image</th>
                                        <th>Product Price</th>
                                        <th>Discount Percentage</th>
                                        <th>Sale Price</th>
                                        <th>Rating</th>
                                        <th>Raters</th>
                                        <th>Best Seller</th>
                                        <th>Upload Date</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query to fetch data from the products table
                                    $query = "SELECT * FROM combo_offer ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);

                                    // Check if there are results
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row in the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            // echo "<td>" . $row['product_id'] . "</td>";
                                            echo "<td>" . $row['best_seller_catrgory'] . "</td>";
                                            echo "<td>" . $row['product_name'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td><img src='products_uploads/" . $row['primary_image_url'] . "' style='max-width: 100px; height: auto;' /></td>";
                                            echo "<td style='color:green;'>₹" . number_format($row['product_price'], 2) . "</td>";
                                            echo "<td style='color:green;'>" . $row['discount_percentage'] . "%</td>";  // Display discount percentage as a percentage
                                            echo "<td style='color:green;'>₹" . number_format($row['sale_price'], 2) . "</td>";
                                            echo "<td>" . $row['rating'] . "</td>";
                                            echo "<td>" . $row['raters'] . "</td>";
                                            echo "<td>" . ($row['is_best_seller'] ? "Yes" : "No") . "</td>";
                                            echo "<td>" . $row['created_At'] . "</td>";
                                            echo "<td>
                                                    <form method='POST' action='update_combo_offer.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='perfumes' class='btn btn-primary fa fa-edit'></button>
                                                    </form>
                                                </td>";
                                            echo "<td>
                                                    <form method='POST' action='delete_combo_offer.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='perfumes' class='btn btn-danger fa fa-trash'></button>
                                                    </form>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No products found</td></tr>";
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