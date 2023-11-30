<!DOCTYPE html>
<html lang="zxx">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
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
<?php include 'navbar.php'; ?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Cart</h2>
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area pt-4 pb-100px px-4">
    <!--<div class="container">-->
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-content table-responsive cart-table-content">
                    <?php
                    $total_price = 0;
                    $grand_total = 0;
                    $master_grand = 0;
                    $cart_is_empty = true; 
                    if (isset($_SESSION['auth_user']) && isset($_SESSION['auth_user']['user_id'])) {
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $select_cart_query = "SELECT c.product_id, p.product_name, p.product_price, i.image_path, c.product_qty, c.product_size
                        FROM tbl_cart c
                        JOIN tbl_product p ON c.product_id = p.prod_id
                        JOIN (
                            SELECT product_id, MAX(image_path) AS image_path
                            FROM tbl_image
                            GROUP BY product_id
                        ) i ON c.product_id = i.product_id
                        WHERE c.user_id = $user_id";
                        $select_cart = mysqli_query($conn, $select_cart_query);
                        if (mysqli_num_rows($select_cart) > 0) {
                            $cart_is_empty = false; // Cart is not empty                           
                    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Size</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 while ($select_cart_row = mysqli_fetch_assoc($select_cart)) {
                                    $produc_qty = $select_cart_row['product_qty'];
                                    $product_price = $select_cart_row['product_price'];
                                    $total_price = $produc_qty * $product_price;
                                    $sub_total = number_format($total_price, 2);
                                    $grand_total += $total_price;
                                    $master_grand = number_format($grand_total, 2);
                                    $product_id = $select_cart_row['product_id'];
                                ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="product-details.php?id=<?= $select_cart_row['product_id'] ?>"><img class="img-responsive ml-15px" src="./control-panel/<?= $select_cart_row['image_path'] ?>" class="rounded-4" alt="Cart product Image"></a>
                                    </td>
                                    <td></td>
                                    <td class="product-name"><a href="product-details.php?id=<?= $select_cart_row['product_id'] ?>"><?= $select_cart_row['product_name'] ?></a></td>
                                    <td class="product-price-cart"><span class="amount">&#8377;<?= $select_cart_row['product_price'] ?></span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input readonly class="cart-plus-minus-box" type="text" name="qtybutton" value="<?= $select_cart_row['product_qty'] ?>" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><?= $select_cart_row['product_size'] ?></td>
                                    <td class="product-subtotal">&#8377;<?= $sub_total; ?></td>
                                    <td class="product-remove">
                                        <a href="product-details.php?id=<?= $select_cart_row['product_id'] ?>"><i class="fa fa-pencil"></i></a>
                                        <button class="remove-from-cart remove" data-product-id="<?= $select_cart_row['product_id'] ?>">X</button>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    <?php
                            
                        }
                    }
                    ?>
                </div>

                <?php if ($cart_is_empty) { ?>
                    <div class="card-body mt-3">
                        <h3 class="card align-items-center p-2">No items in the cart</h3>
                    </div>
                <?php } ?>

                <div class="row float-end">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper" style="font-size:25px !important;">
                            <div class="cart-shiping-update">
                                <?php if (!$cart_is_empty) { ?>
                                    <span>Grand Total: <strong>&#8377; <?= $master_grand; ?></strong></span><br>
                                    <a href="checkout.php" style="font-size:25px !important; background:#000; color:#fff;">Continue Shopping</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
</div>
<!-- Cart Area End -->

<?php
include 'footer.php';
?>
</body>

</html>