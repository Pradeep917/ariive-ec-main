<!DOCTYPE html>
<html lang="zxx">
</html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="" />
    <meta name="robots" content="index, follow" />
    <?php include 'header.php'; ?>
    <?php
    $select_query = mysqli_query($conn, "SELECT * FROM web_setting");
    while ($select_query_row = mysqli_fetch_assoc($select_query)) {
    ?>
        <title><?= $select_query_row['title'] ?></title>
        <meta name="Title" content="<?= $select_query_row['meta_title'] ?>" />
        <meta name="Description" content="<?= $select_query_row['meta_description'] ?>" />
    <?php } ?>
</head>
<?php
include 'navbar.php';
$order_id = $_GET['order_id'];
?>

<body>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Order Return</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="my-account.php" style="color:skyblue;">My Account</a></li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <?php
    
    $order_get = mysqli_query($conn, "SELECT o.order_id,o.product_size, o.product_qty, o.product_price, o.user_id, o.order_status,
    o.payment_method, o.tracking_id, o.created_at,p.product_name,o.product_id,i.image_path
    FROM tbl_order_item o
    JOIN tbl_product p ON o.product_id = p.prod_id
    JOIN tbl_image i ON o.product_id = i.product_id
    WHERE order_id=$order_id;");
    while ($order_get_row = mysqli_fetch_assoc($order_get)) {
    ?>
        <div class="pt-100px pb-100px px-5">
            <form action="save_return.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 mt-2 col-lg-3">
                        <label for="">Order Id</label>
                        <input type="text" class="form-control" name="order_id" readonly value="<?= $order_get_row['tracking_id'] ?>" />
                    </div>
                    <div class="col-sm-6 mt-2 col-lg-3">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="Product_name" value="<?= $order_get_row['product_name'] ?>" readonly />
                        <input type="hidden" class="form-control" name="product_id" value="<?= $order_get_row['product_id'] ?>" readonly />
                    </div>
                    <div class="col-sm-6 mt-2 col-lg-2">
                        <label for="">Product Quantity</label>
                        <input type="text" class="form-control" name="product_qty" value="<?= $order_get_row['product_qty'] ?>" readonly />
                    </div>
                    <div class="col-sm-6 mt-2 col-lg-2">
                        <label for="">Product Size</label>
                        <input type="text" class="form-control" name="product_size" value="<?= $order_get_row['product_size'] ?>" readonly />
                    </div>
                    <div class="col-sm-6 mt-2 col-lg-2">
                        <label for="">Product Price</label>
                        <input type="text" class="form-control" name="product_price" value="<?= $order_get_row['product_price'] ?>" readonly />
                    </div>
                    <div class="col-sm-3 mt-2 col-lg-2">
                        <label for="">Product Image</label><br>
                        <img src="./control-panel/<?= $order_get_row['image_path'] ?>" name="product_image" alt="" class="rounded-1" height="50px" width="50px">
                    </div>
                    <div class="col-sm-3 mt-2 col-lg-2">
                        <label for="">Return Status</label>
                        <select name="order_status" class="form-select" required>
                            <option value="" class="form-control">Order Type</option>
                            <option value="Return">Return</option>
                            <option value="Exchange">Exchange</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mt-2 col-lg-8">
                        <label for="">Description</label>
                        <textarea name="return_message" class="form-control" cols="30" rows="3" placeholder="Enter Your Message" required></textarea>
                    </div>
                    <div class="col-sm-12 mt-2 col-lg-6">                       
                        <button type="submit" name="submit" class="form-control bg-success text-white fw-bold">Submit</button>                        
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
    include 'footer.php';
    ?>
</body>

</html>