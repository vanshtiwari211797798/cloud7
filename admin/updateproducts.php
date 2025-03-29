<?php include('../includes/db.php'); ?>

<?php
// Check if an ID is provided
if (!isset($_POST['id'])) {
    echo "<script>alert('No product selected.'); window.location.href='product_list.php';</script>";
    exit;
}

$product_id = $_POST['id'];

// Fetch the existing product data
$query = "SELECT * FROM product_items WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

// If product not found, redirect
if (!$product) {
    echo "<script>alert('Product not found.'); window.location.href='product_list.php';</script>";
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Update Product</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="update_product_post.php">
                    <input type="hidden" name="id" value="<?= $product['id']; ?>">
                    <input type="hidden" name="old_img_1" value="<?= $product['primary_image_url']; ?>">
                    <input type="hidden" name="old_img_2" value="<?= $product['secondary_image_url']; ?>">
                    <input type="hidden" name="old_img_3" value="<?= $product['third_image_url']; ?>">
                    <input type="hidden" name="old_img_4" value="<?= $product['fourth_image_url']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Category:</label>
                                <input type="text" class="form-control" name="best_seller_catrgory"
                                    value="<?= $product['best_seller_catrgory']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Product Name:</label>
                                <input type="text" class="form-control" name="product_name"
                                    value="<?= $product['product_name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Quantity:</label>
                                <input type="text" class="form-control" name="quantity"
                                    value="<?= $product['quantity']; ?>" required>
                            </div>
                            <?php
                            $product_price = isset($product['product_price']) ? (float)$product['product_price'] : 0;
                            $discount_percentage = isset($product['discount_percentage']) ? (float)$product['discount_percentage'] : 0;

                            // Sale Price Calculation
                            $sale_price = $product_price - ($product_price * ($discount_percentage / 100));
                            ?>

                            <div class="mb-3">
                                <label class="form-label">Product Price:</label>
                                <input type="number" step="0.01" class="form-control" name="product_price"
                                    value="<?= $product_price; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Discount Percentage:</label>
                                <input type="number" step="0.01" class="form-control" name="discount_percentage"
                                    value="<?= $discount_percentage; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sale Price:</label>
                                <input type="number" step="0.01" class="form-control" name="sale_price"
                                    value="<?= number_format($sale_price, 2); ?>" readonly required>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Rating:</label>
                                <input type="number" class="form-control" name="rating"
                                    value="<?= $product['rating']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Raters:</label>
                                <input type="number" class="form-control" name="raters"
                                    value="<?= $product['raters']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Is Best Seller (0/1):</label>
                                <input type="number" class="form-control" name="is_best_seller"
                                    value="<?= $product['is_best_seller']; ?>" required readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Product Description:</label>
                                <textarea class="form-control" rows="3" name="product_discription"
                                    required><?= $product['product_discription']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="text-center mb-3">Product Images</h5>

                    <div class="row">
                        <div class="col-md-3 text-center">
                            <label class="form-label">Primary Image:</label>
                            <input type="file" class="form-control mb-2" name="primary_image_url">
                            <img src="products_uploads/<?= $product['primary_image_url']; ?>" class="img-thumbnail"
                                width="100">
                        </div>

                        <div class="col-md-3 text-center">
                            <label class="form-label">Secondary Image:</label>
                            <input type="file" class="form-control mb-2" name="secondary_image_url">
                            <img src="products_uploads/<?= $product['secondary_image_url']; ?>" class="img-thumbnail"
                                width="100">
                        </div>
                        <!-- 
                        <div class="col-md-3 text-center">
                            <label class="form-label">Tertiary Image:</label>
                            <input type="file" class="form-control mb-2" name="Tertiary_image_url">
                            <img src="../uploads/<?= $product['Tertiary_image_url']; ?>" class="img-thumbnail"
                                width="100">
                        </div>

                        <div class="col-md-3 text-center">
                            <label class="form-label">Quaternary Image:</label>
                            <input type="file" class="form-control mb-2" name="Quaternary_image_url">
                            <img src="../uploads/<?= $product['Quaternary_image_url']; ?>" class="img-thumbnail"
                                width="100">
                        </div> -->
                    </div>

                    <hr>

                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-success px-4">Update Product</button>
                        <a href="BestSellerPerfumes.php" class="btn btn-secondary px-4">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <!-- javascript code here -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const productPriceInput = document.querySelector('input[name="product_price"]');
    const discountInput = document.querySelector('input[name="discount_percentage"]');
    const salePriceInput = document.querySelector('input[name="sale_price"]');

    function updateSalePrice() {
        let productPrice = parseFloat(productPriceInput.value) || 0;
        let discount = parseFloat(discountInput.value) || 0;
        let salePrice = productPrice - (productPrice * (discount / 100));
        salePriceInput.value = salePrice.toFixed(2);
    }

    productPriceInput.addEventListener("input", updateSalePrice);
    discountInput.addEventListener("input", updateSalePrice);
});
</script>

</body>

</html>