<?php
include 'nav.php';
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Add New Product</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="product_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="save_product.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Category Name <span class="error-imp">*</span></label>
                                    <select name="category_name" class="form-select" title="Please Choose Category" required>
                                        <option value="">Choose Category</option>
                                        <?php
                                        $select_cat = mysqli_query($conn, "SELECT * FROM category");
                                        if (mysqli_num_rows($select_cat) > 0) {
                                            while ($category_row = mysqli_fetch_assoc($select_cat)) {
                                        ?>
                                                <option value="<?= $category_row['cat_id']; ?>">
                                                    <?= $category_row['cat_name']; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo 'No Category Found';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Gender <span class="error-imp">*</span></label>
                                    <select class="form-select" name="gender_type" title="Please Choose Gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Product Name <span class="error-imp">*</span></label>
                                    <input type="text" class="form-control" title="Please Enter Product Name" name="product_name" placeholder="Enter Product Name" required>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Product Code <span class="error-imp">*</span></label>
                                    <input type="text" class="form-control" title="Please Enter Product Code" name="product_code" placeholder="Enter Product Code" required>
                                </div>
                            </div>


                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Offer Price <span class="error-imp">*</span></label>
                                    <input type="text" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" minlength="1" maxlength="10" name="product_price" title="Please Enter Product Price" placeholder="Enter Product Price" required>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">MRP Amount</label>
                                    <input type="text" class="form-control" name="product_discount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" minlength="1" maxlength="10" title="Please Enter Product Discount" placeholder="Enter Product Discount" required>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <div id="sizeQuantityContainer">
                                        <div class="size-quantity">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="">Product Quantity</label>
                                                    <input type="text" class="form-control" name="product_qty[]" placeholder="Enter Enter Quantity" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Product Size</label>
                                                    <select name="product_size[]" class="form-select" title="Enter Product Size" required>
                                                        <option value="">Choose Size</option>
                                                        <?php
                                                        $select_size = mysqli_query($conn, "SELECT * FROM tbl_size");
                                                        if (mysqli_num_rows($select_size) > 0) {
                                                            while ($size_row = mysqli_fetch_assoc($select_size)) {
                                                        ?>
                                                                <option value="<?= $size_row['size_id']; ?>">
                                                                    <?= $size_row['size_name']; ?></option>

                                                        <?php
                                                            }
                                                        } else {
                                                            echo 'No Size Found';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="form-control w-100 text-nowrap fw-bold bg-success mt-2" id="addSizeQuantity">Add More Quantity & Size</button>
                                </div>
                            </div>
                            <div class="col-sm-3 mt-3">
                                <div class="form-group">
                                    <label for="">Product Color <span class="error-imp">*</span></label>
                                    <div class="manage-color d-flex">
                                        <select name="product_color" class="form-select mx-1" title="Please Enter Product Color" required>
                                            <option value="">Select a color</option>
                                            <?php
                                            $data = "SELECT * FROM `tbl_color` ORDER BY `color_id` ASC";
                                            $result = mysqli_query($conn, $data);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $hexColorCode = $row['color_name'];
                                                    $color_id = $row['color_id'];
                                            ?>
                                                    <option value="<?= $color_id ?>" style="background-color: <?= $hexColorCode ?>; color: white;">
                                                        <?= $row['color_name'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 mt-3">
                                <div class="form-group">
                                    <label for="">Add Image <span class="error-imp">*</span></label>
                                    <div id="imageInputs">
                                        <input type="file" name="Product_Images[]" accept="image/*" title="Please Choose Product Image" multiple class="form-control" required>
                                    </div>
                                    <button type="button" class="form-control w-50 text-nowrap fw-bold bg-success mt-2" id="addImage">Add More</button>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <label for="">Product Description</label><br>
                                    <textarea name="product_desc" class="form-control" title="Please Enter Product Description" cols="140" rows="5" placeholder="Enter Product Description"></textarea>

                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">ADD PRODUCT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
        // Function to add more size and quantity fields
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