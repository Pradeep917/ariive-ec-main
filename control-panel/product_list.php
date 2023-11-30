<?php
include 'nav.php';
?>
<div class="wrapper flex-column bg-light">
    <div class="body">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between header-btn">
                        <h4 class="card-title mb-0">Product List</h4>
                        <h4 class="card-title add-btn mb-0"><a href="add_product.php" class="">Add Product</a><i class="bi bi-plus"></i></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Qty</th>
                                <th>Gender</th>                                
                                <th>Edit</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product_query = "SELECT 
                                tbl_product.prod_id,
                                MAX(tbl_image.image_path) AS image_path,
                                tbl_product.product_name,
                                category.cat_name AS category_name, -- Include category name here
                                tbl_product.product_code,
                                tbl_product.product_price,
                                tbl_product.product_discount,
                                tbl_product.product_color,
                                tbl_product.gender,
                                tbl_product.created_at
                            FROM tbl_product
                            LEFT JOIN tbl_image ON tbl_product.prod_id = tbl_image.product_id
                            LEFT JOIN category ON tbl_product.category_id = category.cat_id -- Use LEFT JOIN to get category name
                            GROUP BY tbl_product.prod_id, tbl_product.product_name, category.cat_name, tbl_product.product_code, tbl_product.product_price, tbl_product.product_discount, tbl_product.product_color, tbl_product.gender, tbl_product.created_at ORDER BY tbl_product.created_at DESC";


                            $product_query_run = mysqli_query($conn, $product_query);

                            while ($product_row = mysqli_fetch_assoc($product_query_run)) {
                            ?>
                                <tr>
                                    <td><?= $product_row['prod_id']; ?></td>
                                    <td>
                                        <img src="<?= $product_row['image_path'] ?>" class="img-fluid rounded-2" style="height:50px; width:50px;">
                                    </td>
                                    <td><?= $product_row['product_name']; ?></td>
                                    <td><?= $product_row['category_name']; ?></td>
                                    <td>₹ <?= $product_row['product_price']; ?></td>
                                    <td>₹ <?= $product_row['product_discount']; ?></td>

                                    <td>
                                        <?php
                                        $size_quantity_query = "SELECT CONCAT(tbl_size.size_name, ' (', COALESCE(product_size_quantity.quantity, 0), ')') AS size_quantity
                                                FROM product_size_quantity
                                                LEFT JOIN tbl_size ON product_size_quantity.size_id = tbl_size.size_id
                                                WHERE product_size_quantity.product_id = " . $product_row['prod_id'];
                                        $size_quantity_result = mysqli_query($conn, $size_quantity_query);

                                        while ($size_quantity_row = mysqli_fetch_assoc($size_quantity_result)) {
                                            echo $size_quantity_row['size_quantity'];
                                            echo ', ';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $product_row['gender']; ?></td>                                   
                                    <td><a href="edit_product.php?id=<?= $product_row['prod_id'] ?>" class="text-dark"><i class="bi bi-pen-fill"></i></a></td>
                                    <td><a href="view_product.php?id=<?= $product_row['prod_id'] ?>" class="text-dark"><i class="bi bi-eye-fill"></i></a></td>
                                    <td><a href="save_product.php?id=<?= $product_row['prod_id'] ?>" class="text-dark"><i class="bi bi-trash-fill"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>