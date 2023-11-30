<?php
$id = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
?>
<!DOCTYPE html>
<html lang="zxx">

</html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="assets/images/tshirt/arive.png" type="image"/>
    <link rel="icon" href="assets/images/tshirt/arive.png" type="image"/>
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

<style>
    input[type="radio"] {
        display: none;
    }

    label {
        padding: 1em;
        display: inline-block;
        border: 1px solid grey;
        cursor: pointer;
    }

    .blank-label {
        display: none;
    }

    input[type="radio"]:checked+label {
        background: skyblue;
        color: #fff;
    }
</style>

<body>
    <div class="product_data">
        <?php
        $select_product = mysqli_query($conn, "SELECT tbl_product.*, tbl_image.*
                    FROM tbl_product
                    INNER JOIN tbl_image ON tbl_product.prod_id = tbl_image.product_id
                    WHERE tbl_product.prod_id = $id;");
        if ($select_product) {
            $select_product_row = mysqli_fetch_assoc($select_product);
            if ($select_product_row) {
                $product_id = $select_product_row['prod_id'];
                // echo $product_id;
        ?>


                <div class="breadcrumb-area">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-12 text-center">
                                <h2 class="breadcrumb-title">Single Product Details</h2>
                                <ul class="breadcrumb-list">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active"><?= $select_product_row['product_name'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-details-area pt-100px pb-100px px-4">
                    <!-- <div class="container"> -->
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                                <div class="swiper-container zoom-top">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $select_images = mysqli_query($conn, "SELECT * FROM tbl_image WHERE product_id = $product_id");
                                        while ($image_row = mysqli_fetch_assoc($select_images)) {
                                        ?>
                                            <div class="swiper-slide zoom-image-hover">
                                                <img class="img-responsive m-auto" src="./control-panel/<?= $image_row['image_path'] ?>" alt="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="swiper-container mt-20px zoom-thumbs ">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $select_images = mysqli_query($conn, "SELECT * FROM tbl_image WHERE product_id = $product_id");
                                        while ($image_row = mysqli_fetch_assoc($select_images)) {
                                        ?>
                                            <div class="swiper-slide">
                                                <img class="img-responsive m-auto" src="./control-panel/<?= $image_row['image_path'] ?>" alt="" height="160px">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12 view-phone" data-aos="fade-up" data-aos-delay="200">
                                <div class="product-details-content quickview-content ml-25px">
                                    <h2 class="prod_name"><?= $select_product_row['product_name'] ?></h2>
                                    <div class="pricing-meta mt-3 mb-3">
                                        <ul class="d-flex">
                                            <li class="new-price text-primary"><b>Price:</b> &nbsp;&#8377;<?= $select_product_row['product_price'] ?></li>
                                            <li class="old-price"><del>&#8377;<?= $select_product_row['product_discount'] ?></del></li>
                                        </ul>
                                    </div>

                                    <div class="stock mt-10px">
                                        <span class="avallabillty">Availability: <span class="in-stock text-primary"> <i class="fa fa-check text-primary"></i> In Stock</span></span>
                                    </div>
                                    <div class="stock mt-30px">
                                        <span class="avallabillty">Choose Style: <span class="in-stock text-primary">
                                                <?php
                                                $category_id = $select_product_row['category_id'];
                                                $select_category = mysqli_query($conn, "SELECT cat_name FROM category WHERE cat_id = $category_id");
                                                $category_row = mysqli_fetch_assoc($select_category);

                                                echo $category_row['cat_name'];
                                                ?>
                                            </span></span>
                                    </div>
                                    <div class="stock mt-30px">
                                        <span class="avallabillty">Gender- <?= $select_product_row['gender'] ?> </span>
                                    </div>

                                    <div class="stock mt-30px mt-3">
                                        <div id="flash-message" class="alert alert-warning" style="display: none;font-size:30px;"></div>
                                        <span class="avallabillty"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Size:
                                            <?php
                                            $select_size = mysqli_query($conn, "SELECT psq.size_id, s.size_name
                                                FROM product_size_quantity psq
                                                INNER JOIN tbl_size s ON psq.size_id = s.size_id
                                                WHERE psq.product_id = '$product_id'");
                                            while ($select_size_row = mysqli_fetch_assoc($select_size)) {
                                                $prod_size_id=$select_size_row['size_id'];
                                            ?>                                                 
                                                <input class="form-check-input" type="radio" name="size" require class="product_size" id="<?= $prod_size_id ?>" value="<?= $select_size_row['size_name'] ?>">
                                                <label class="form-check-label" for="<?= $prod_size_id ?>">
                                                <?= $select_size_row['size_name'] ?>
                                                </label>
                                            <?php } ?>
                                        </span>
                                    </div>

                                    <div class="stock mt-30px">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-1 p-0">
                                                    <div class="row pt-2">
                                                        <span class="avallabillty">Color:</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 color">
                                                    <?php
                                                    $color_id = $select_product_row['product_color'];
                                                    $select_color = mysqli_query($conn, "SELECT color_name FROM tbl_color WHERE color_id = $color_id");
                                                    $color_row = mysqli_fetch_assoc($select_color);

                                                    $hex_code = $color_row['color_name'];
                                                    ?>
                                                    <input type="radio" name="color" id="red" value="<?= $hex_code ?>" />
                                                    <label for="red" class="color" style="background-color: <?= $hex_code ?>;"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sort_description">
                                        <p class="mt-10px mb-0 "><strong>Description :</strong><br><?= $select_product_row['product_desc'] ?> </p>
                                    </div>
                                    <div class="pro-details-quality">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-2 p-1">
                                                    <div class="cart-plus-minus">
                                                        <div class="dec qtybutton"><button class="text-white decrement-btn">-</button></div>
                                                        <input class="cart-plus-minus-box input-qty" disabled type="text" name="qtybutton" value="1" />
                                                        <div class="inc qtybutton"><button class="text-white increment-btn">+</button></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5 p-1">
                                                    <div class="pro-details-cart">
                                                        <button type="submit"  class="btn btn-primary add-cart AddToCartbtn" value="<?php echo $select_product_row['prod_id'] ?>" style="background-color:skyblue;"> Add To Cart</button>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-5 p-1">
                                                    <div class="pro-details-cart">
                                                        <a class="btn btn-primary add-cart" style="background-color:skyblue;"> Buy it now</a>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-img">
                                        <a href="#"><img src="assets/images//icons/payment.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>

                <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
                    <!--<div class="container">-->
                        <div class="description-review-wrapper">
                            <div class="description-review-topbar nav">
                                <a class="active btn btn-primary" data-bs-toggle="tab" href="#des-details1" style="background-color:skyblue;">Description</a>
                            </div>
                            <div class="tab-content description-review-bottom">                                
                                <div id="des-details1" class="tab-pane active">
                                    <div class="product-description-wrapper">
                                        <p>
                                            <?= $select_product_row['product_desc'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                </div>
        <?php
            }
        }
        ?>
    </div>

    <!-- Related product Area Start -->
    <!-- <div class="related-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center line-height-1">
                        <h2 class="title">Related Products</h2>
                        <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
                <div class="new-product-wrapper swiper-wrapper">
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/9.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/9.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                            </div>
                            <div class="content">
                                <h5 class="title"><a href="single-product.php">Hand-Made Garlic Mortar
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class="add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                To Cart</button>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/10.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/10.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                            </div>
                            <div class="content">

                                <h5 class="title"><a href="single-product.php">Handmade Ceramic Pottery
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                    <span class="old">&#8377;45.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                To Cart</button>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/11.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/11.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>

                            </div>
                            <div class="content">

                                <h5 class="title"><a href="single-product.php">Hand Painted Bowls
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class="add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                To Cart</button>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/12.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/1.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-5%</span>
                                </span>

                            </div>
                            <div class="content">

                                <h5 class="title"><a href="single-product.php">Antique Wooden Farm
                                        Large
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                    <span class="old">&#8377;40.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class="add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                To Cart</button>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/6.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/6.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                </span>

                            </div>
                            <div class="content">

                                <h5 class="title"><a href="single-product.php">Handmade Jute Basket
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class="add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                To Cart</button>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.php" class="image">
                                    <img src="assets/images/product-image/7.jpg" alt="Product" />
                                    <img class="hover-image" src="assets/images/product-image/7.jpg" alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>

                            </div>
                            <div class="content">

                                <h5 class="title"><a href="single-product.php">Knitting yarn & crochet
                                        hook
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">&#8377;38.50</span>
                                </span>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div> -->

    <?php
    include 'footer.php';
    ?>

</body>

</php>