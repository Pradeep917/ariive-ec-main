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



<body>

    <div class="breadcrumb-area">

        <div class="container">

            <div class="row align-items-center justify-content-center">

                <div class="col-12 text-center">

                    <h2 class="breadcrumb-title">Checkout</h2>

                    <!-- breadcrumb-list start -->

                    <ul class="breadcrumb-list">

                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                        <li class="breadcrumb-item active" style="color:skyblue;">Checkout</li>

                    </ul>

                    <!-- breadcrumb-list end -->

                </div>

            </div>

        </div>

    </div>





    <div class="checkout-area pt-100px pb-100px mx-5">

        <!--<div class="container">-->
            <!-- <form action="order_process.php" method="post"> -->

            <form id="orderForm" action="order_process.php" method="post">

                <div class="row">

                    <div class="col-lg-6">

                        <h3>Billing Details .....</h3>

                        <div class="row">

                            <?php 

                                $caddress_id = null;  

                                $id = "SELECT `caddress_id` FROM `tbl_order_item` WHERE user_id='$user_id'";

                                $get_id = mysqli_query($conn, $id);

                            

                                while ($idrow = mysqli_fetch_assoc($get_id)) {

                                    $caddress_id = $idrow['caddress_id'];  

                                }

                            ?>

                            <?php

                            $select_address = mysqli_query($conn, "SELECT `customer_id`,`c_fname`, `c_lname`, `c_email`, `c_phone`, `c_state`, `c_city`, `c_landmark`, `c_pincode`, `c_address`, `c_message` FROM `customer_address` WHERE customer_id='$caddress_id'");

                            if ($select_address && mysqli_num_rows($select_address) > 0) {

                                $select_address_row = mysqli_fetch_assoc($select_address);

                            ?>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">First Name <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="hidden" class="form-control" name="customer_id" value="<?= $select_address_row['customer_id'] ?>">

                                        <input type="text" class="form-control" required name="u_fname" placeholder="Your First Name" value="<?= $select_address_row['c_fname'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Last Name</label>

                                        <input type="text" class="form-control" name="u_lname" placeholder="Your Last Name" value="<?= $select_address_row['c_lname'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Email I'd <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="email" class="form-control" required name="u_email" placeholder="Your Email....." value="<?= $select_address_row['c_email'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Mobile Number <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" minlength="10" required maxlength="10" class="form-control" name="u_number" placeholder="Your Mobile Number" value="<?= $select_address_row['c_phone'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">State <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" required name="u_state" placeholder="Your State Name" value="<?= $select_address_row['c_state'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">City <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" required name="u_city" placeholder="Your City Name" value="<?= $select_address_row['c_city'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Landmark</label>

                                        <input type="text" class="form-control" name="u_landmark" placeholder="Landmark Near By" value="<?= $select_address_row['c_landmark'] ?>">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Pincode <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" required name="u_pincode" placeholder="Enter Your Pincode" value="<?= $select_address_row['c_pincode'] ?>">

                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-group mt-1">

                                        <label for="">Address <span style="font-size:20px;color:red;">*</span></label>

                                        <textarea name="u_address" required class="form-control" rows="2" placeholder="Enter Your Address ..........."><?= $select_address_row['c_address'] ?></textarea>

                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-group mt-1">

                                        <label for="">Message</label>

                                        <textarea name="u_message" class="form-control" rows="2" placeholder="Enter Your Message (Optional) ..........."></textarea>

                                    </div>

                                </div>

                            <?php } else {

                            ?>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">First Name <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" name="u_fname" required placeholder="Your First Name" >

                                        <input type="hidden" class="form-control" name="customer_id" value="0">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Last Name</label>

                                        <input type="text" class="form-control" name="u_lname" placeholder="Your Last Name">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Email I'd <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="email" class="form-control" name="u_email" required placeholder="Your Email.....">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Mobile Number <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" minlength="10" maxlength="10" class="form-control" required name="u_number" placeholder="Your Mobile Number">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">State <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" name="u_state" required placeholder="Your State Name">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">City <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" name="u_city" required placeholder="Your City Name">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Landmark</label>

                                        <input type="text" class="form-control" name="u_landmark" placeholder="Landmark Near By">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group mt-1">

                                        <label for="">Pincode <span style="font-size:20px;color:red;">*</span></label>

                                        <input type="text" class="form-control" name="u_pincode" required placeholder="Enter Your Pincode">

                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-group mt-1">

                                        <label for="">Adress <span style="font-size:20px;color:red;">*</span></label>

                                        <textarea name="u_address" class="form-control" rows="2" required placeholder="Enter Your Address ..........."></textarea>

                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-group mt-1">

                                        <label for="">Message</label>

                                        <textarea name="u_message" class="form-control" rows="2" placeholder="Enter Your Message (Optional) ..........."></textarea>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>



                    <div class="col-lg-6 mt-md-30px mt-lm-30px ">

                        <div class="your-order-area">

                            <h3>Your Item Details....</h3>

                            <div class="your-order-wrap gray-bg-4">

                                <div class="your-order-product-info">

                                    <div class="your-order-top">

                                        <ul>

                                            <li>Image</li>

                                            <li>Product</li>

                                            <li>Total</li>

                                        </ul>

                                    </div>

                                    <div class="your-order-middle">

                                        <ul>

                                            <?php

                                            $total_price = 0;

                                            $grand_total = 0;

                                            $master_grand = 0;

                                            $cart_item = mysqli_query($conn, "SELECT c.*, p.product_name, p.product_price,

                                                               (SELECT MAX(i.image_path) FROM `tbl_image` i WHERE i.product_id = p.prod_id) AS image_path

                                                        FROM `tbl_cart` c

                                                        JOIN `tbl_product` p ON c.product_id = p.prod_id

                                                        WHERE c.user_id = '$user_id';");



                                            while ($cart_item_row = mysqli_fetch_assoc($cart_item)) {

                                                $product_qty = $cart_item_row['product_qty'];

                                                $product_price = $cart_item_row['product_price'];

                                                $total_price = $product_qty * $product_price;

                                                $subgrand_total = number_format($total_price, 2);

                                                $grand_total += $total_price;

                                                $master_grand = number_format($grand_total, 2);

                                                $product_id = $cart_item_row['product_id'];

                                                $product_qty = $cart_item_row['product_qty'];

                                                $product_size = $cart_item_row['product_size'];

                                            ?>

                                                <li>

                                                    <input type="hidden" name="product_id" value="<?= $product_id; ?>">

                                                    <input type="hidden" name="product_qty" value="<?= $product_qty; ?>">

                                                    <input type="hidden" name="product_size" value="<?= $product_size; ?>">

                                                    <input type="hidden" name="product_price" value="<?= $master_grand; ?>">

                                                    <span><img src="./control-panel/<?= $cart_item_row['image_path'] ?>" alt="" class="rounded-1" height="50px" width="50px"></span>

                                                    <span class="order-middle-left w-50"><?= $cart_item_row['product_name'] ?> X <?= $cart_item_row['product_qty'] ?></span>

                                                    <span class="order-price fw-bold text-nowrap">&#8377; <?= $cart_item_row['product_price'] ?></span>

                                                </li>

                                                <hr>

                                            <?php

                                            }

                                            ?>

                                        </ul>

                                    </div>

                                    <div class="your-order-total">

                                        <ul>

                                            <li class="order-total">Grand Total</li>

                                            <li class="fw-bold text-nowrap">&#8377;<?= $master_grand; ?></li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                            <!--<div class="Place-order mt-4">-->

                            <!--    <input type="hidden" name="codmethod" value="COD">-->

                            <!--    <button type="submit" class="btn-hover form-control bg-success text-white fw-bold" name="order_placed">Place Order | COD</button>-->

                            <!--    <button type="submit" class="btn-hover form-control bg-success text-white fw-bold" name="order_placed">Place Order | Phone pe</button>-->

                            <!--</div>-->
                            
                            <div class="accordion" id="accordionExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                  <button class="accordion-button btn-hover form-control bg-success text-white fw-bold text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   Place Order
                                  </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <div class="form-check">
                                       <button type="submit" class="btn-hover form-control bg-success text-white fw-bold" name="order_placed_cod" value="COD">Place Order | COD</button>
                                    </div>
                                    <div class="form-check">
                                      <button type="submit" class="btn-hover form-control bg-success text-white fw-bold" name="order_placed_online" value="Online">Place Order | Online</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>

                    </div>

                </div>

            </form>

        <!--</div>-->

    </div>

    <?php

    include 'footer.php';

    ?>
<script>
    function submitOrderForm() {
        // Assuming the form has the id "orderForm"
        document.getElementById("orderForm").submit();
    }
</script>

</body>



</html>