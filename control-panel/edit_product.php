<?php
include 'nav.php';
$id = $_GET['id'];
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Edit Product</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="product_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    $product_query = "SELECT tbl_product.*, MAX(tbl_image.image_path) AS image_path
                        FROM tbl_product INNER JOIN tbl_image ON tbl_product.prod_id = tbl_image.product_id
                        WHERE prod_id='$id'";
                    $product_query_run = mysqli_query($conn, $product_query);
                    while ($product_row = mysqli_fetch_assoc($product_query_run)) {
                        $prod_table_cat_id = $product_row['category_id'];
                        $prod_table_color_id = $product_row['product_color'];
                        // echo  $prod_table_color_id;
                    ?>
                        <form action="update_product.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Category Name <span class="error-imp">*</span></label>
                                        <input type="hidden" name="product_id" value="<?= $product_row['prod_id'] ?>">
                                        <select name="category_name" class="form-select" required>
                                            <option value="">Choose Category</option>
                                            <?php
                                            $select_cat = mysqli_query($conn, "SELECT * FROM category");
                                            if (mysqli_num_rows($select_cat) > 0) {
                                                foreach ($select_cat as $category) {
                                                    $tbl_category_id = $category['cat_id'];  // cat id from category table                                                         
                                                    $product_id = ($tbl_category_id == $prod_table_cat_id) ? 'selected' : '';
                                            ?>
                                                    <option value="<?= $tbl_category_id; ?>" <?= $product_id; ?>><?= $category['cat_name'] ?></option>
                                            <?php
                                                }
                                                echo 'No Category Found';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Gender <span class="error-imp">*</span></label>
                                        <select class="form-select" name="gender_type" required>
                                            <option value="Male" <?php if ($product_row['gender'] == 'Male') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Male</option>
                                            <option value="Female" <?php if ($product_row['gender'] == 'Female') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Female</option>
                                            <option value="Unisex" <?php if ($product_row['gender'] == 'Unisex') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Unisex</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Product Name <span class="error-imp">*</span></label>
                                        <input type="text" class="form-control" title="Please Enter Product Name" name="product_name" value="<?= $product_row['product_name'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Product Code <span class="error-imp">*</span></label>
                                        <input type="text" class="form-control" title="Please Enter Product Code" name="product_code" value="<?= $product_row['product_code'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Product Price <span class="error-imp">*</span></label>
                                        <input type="text" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" minlength="1" maxlength="10" name="product_price" title="Please Enter Product Price" value="<?= $product_row['product_price'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <div class="form-group">
                                        <label for="">Product Discount</label>
                                        <input type="text" class="form-control" name="product_discount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" minlength="1" maxlength="10" title="Please Enter Product Discount" value="<?= $product_row['product_discount'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <div class="form-group">
                                        <div id="sizeQuantityContainer">
                                            <div class="size-quantity">
                                                <div class="row">
                                                    <?php
                                                    $select_size_qty = mysqli_query($conn, "SELECT psq.*, ts.size_name FROM product_size_quantity psq
                                                        LEFT JOIN tbl_size ts ON psq.size_id = ts.size_id
                                                        WHERE psq.product_id='$id'");
                                                    if (mysqli_num_rows($select_size_qty) > 0) {
                                                        while ($size_qty_row = mysqli_fetch_assoc($select_size_qty)) {
                                                            $size_qty_row_id = $size_qty_row['size_id'];
                                                            $size_qty_row_product_id = $size_qty_row['product_id'];
                                                            $size_name = $size_qty_row['size_name'];
                                                    ?>
                                                            <div class="col-sm-6">
                                                                <label for="">Product Quantity</label>
                                                                <input type="text" class="form-control" name="product_qty[]" value="<?= $size_qty_row['quantity'] ?>">
                                                                <input type="hidden" class="form-control" name="sizeqty_id[]" value="<?= $size_qty_row['sizeqty_id'] ?>">
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="">Product Size</label>
                                                                <select name="product_size[]" class="form-select" title="Enter Product Size" required>
                                                                    <option value="">Choose Size</option>
                                                                    <?php
                                                                    $select_size = mysqli_query($conn, "SELECT size_id FROM product_size_quantity WHERE product_id='$id'");

                                                                    if (mysqli_num_rows($select_size) > 0) {
                                                                        while ($size_row = mysqli_fetch_assoc($select_size)) {
                                                                            $size_id = $size_row['size_id'];
                                                                            $select_size_name = mysqli_query($conn, "SELECT size_name FROM tbl_size WHERE size_id='$size_id'");
                                                                            while ($select_size_name_row = mysqli_fetch_assoc($select_size_name)) {
                                                                                $size_name = $select_size_name_row['size_name']; // Fetch the size_name from tbl_size
                                                                            }
                                                                    ?>
                                                                            <option value="<?= $size_id ?>" <?php if ($size_name == $size_qty_row['size_name']) echo 'selected'; ?>>
                                                                                <?= $size_name ?>
                                                                            </option>
                                                                    <?php
                                                                        }
                                                                    } else {
                                                                        echo 'No Size Found';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="form-control w-100 text-nowrap fw-bold bg-success mt-2" id="addSizeQuantity">Add More Quantity & Size</button>
                                    </div>
                                </div>
                                <div class="col-sm-3 mt-5">
                                    <div class="form-group">
                                        <label for="">Product Color <span class="error-imp">*</span></label>
                                        <div class="manage-color d-flex">
                                            <select name="product_color" class="form-select mx-1" required>
                                                <option value="">Select a color</option>
                                                <?php
                                                $data = "SELECT * FROM `tbl_color`";
                                                $result = mysqli_query($conn, $data);

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $hexColorCode = $row['color_name'];
                                                        $color_id = $row['color_id'];
                                                        $selected = ($color_id == $prod_table_color_id) ? 'selected' : '';
                                                ?>
                                                        <option value="<?= $color_id; ?>" <?= $selected; ?> style="background-color: <?= $hexColorCode ?>; color: white;">
                                                            <?= $row['color_name'] ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 mt-5">
                                    <div class="form-group">
                                        <label for="">Product Images</label>
                                        <div class="update-img mt-2">
                                            <div class="row">
                                                <?php
                                                $select_image = mysqli_query($conn, "SELECT * FROM tbl_image WHERE product_id='$id'");
                                                if (mysqli_num_rows($select_image) > 0) {
                                                    foreach ($select_image as $image) {
                                                        $tbl_image_id = $image['img_id'];
                                                ?>
                                                        <div class="col-sm-4 manage-img">
                                                            <a target="_blank" href="<?= $image['image_path'] ?>" class=""><img src="<?= $image['image_path'] ?>" alt="<?= $image['image_path'] ?>" class="img-fluid"></a>
                                                            <input type="hidden" name="existing_images[]" class="form-file" value="<?= $image['image_path'] ?>">
                                                            <input type="file" name="updated_images[]" class="form-file  mt-1 w-10">
                                                            <button data-img-id="<?= $image['img_id'] ?>" class="delete-image btn btn-danger text-white fw-bold mt-1"><i class="bi bi-trash-fill"></i> Delete</button>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-4">
                                                    <label for="">Add Another Image</label>
                                                    <div id="imageInputs" class="w-10">
                                                        <input type="file" name="update_new[]" accept="image/*" class="form-file" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="">Product Description</label><br>
                                        <textarea name="product_desc" id="form-control" title="Please Enter Product Description" cols="160" rows="8" placeholder="Enter Product Description"><?= $product_row['product_desc'] ?></textarea>

                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="form-group">
                                        <button type="submit" name="update_product" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">UPDATE PRODUCT
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addImageButton = document.getElementById("addImage");
        const imageInputsContainer = document.getElementById("imageInputs");
        addImageButton.addEventListener("click", function() {
            const newInput = document.createElement("input");
            newInput.type = "file";
            newInput.name = "Product_Images[]";
            newInput.accept = "image/*";
            newInput.required = false;
            imageInputsContainer.appendChild(newInput);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#addSizeQuantity").click(function() {
            var sizeQuantityHtml = '<div class="size-quantity">' +
                '<div class="row">' +
                '<div class="col-sm-6 mt-2">' +
                '<input type="text" class="form-control" name="product_qty[]" placeholder="Enter Product Quantity">' +
                '</div>' +
                '<div class="col-sm-6 mt-2">' +
                '<div class="manage-size">' +
                '<select name="product_size[]" class="form-select" title="Enter Product Size">' +
                '<option value="">Choose Size</option>' +
                '<?php
                    $select_size = mysqli_query($conn, "SELECT * FROM tbl_size");
                    if (mysqli_num_rows($select_size) > 0) {
                        while ($size_row = mysqli_fetch_assoc($select_size)) {
                    ?>' +
                '<option value="<?= $size_row['size_id']; ?>"><?= $size_row['size_name']; ?></option>' +
                '<?php
                        }
                    } else {
                        echo 'No Size Found';
                    }
                    ?>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            $("#sizeQuantityContainer").append(sizeQuantityHtml);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".delete-image").click(function(e) {
            e.preventDefault();

            var imageId = $(this).data("img-id");

            Swal.fire({
                title: 'Confirm Deletion',
                text: 'Are you sure you want to delete this image?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "delete_prodimg.php",
                        data: {
                            img_id: imageId
                        },
                        success: function(response) {
                            if (response === "success") {
                                $(e.target).closest(".manage-img").remove();
                                Swal.fire('Deleted!', 'The image has been deleted.', 'success');
                            } else {
                                Swal.fire('Error!', 'Failed to delete the image. Please try again.', 'error');
                            }
                        }
                    });
                }
            });
        });
    });
</script>