<!DOCTYPE html>
<html lang="zxx">
</html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <link rel="icon" href="assets/images/tshirt/arive.png" type="icon/arive.png"/>
    <?php include 'header.php';?>
    <?php
    $select_query = mysqli_query($conn, "SELECT * FROM web_setting");
    while ($select_query_row = mysqli_fetch_assoc($select_query)) {
        ?>
        <title><?= $select_query_row['title'] ?></title>
        <meta name="Title" content="<?= $select_query_row['meta_title'] ?>" />
        <meta name="Description" content="<?= $select_query_row['meta_description'] ?>" />
    <?php } ?>
    <!-- <link rel="icon" href="assets/images/tshirt/arive.png" type="image"/> -->
    
</head>
<?php include 'navbar.php'; ?>
<body>
    <div class="section">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <div class="swiper-wrapper">
                <div class="hero-slide-item slider-height swiper-slide d-flex bg-color1" style="height:460px;">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center sm-center-view">
                                <div class="hero-slide-content slider-animated-1">
                                    <h2 class="title-1">Best Ariive <br class="d-sm-none"> T-Shirt</h2>
                                    <span class="price">
                                        <span class="old"> <del>&#8377;949.00</del></span>
                                        <span class="new text-primary">- &#8377;789.00</span>
                                    </span>
                                    <a href="shop.php" class="btn btn-primary m-auto text-uppercase" style="background-color:skyblue;">View
                                        Collection</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center position-relative">
                                <div class="show-case">
                                    <div class="hero-slide-image">
                                        <img src="assets/images/tshirt/banner2.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-slide-item slider-height swiper-slide d-flex bg-color1" style="height:460px;">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 align-self-center sm-center-view">
                                <div class="hero-slide-content slider-animated-1">
                                    <h2 class="title-1">Ariive Collection <br class="d-sm-none"></h2>
                                    <span class="price">
                                        <span class="old"> <del>&#8377;949.00</del></span>
                                        <span class="new text-primary">- &#8377;789.00</span>
                                    </span>
                                    <a href="shop.php" class="btn btn-primary m-auto text-uppercase" style="background-color:skyblue;">View
                                        Collection</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center position-relative">
                                <div class="show-case">
                                    <div class="hero-slide-image">
                                        <img src="assets/images/tshirt/banner1.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <div class="banner-area pt-100px pb-100px mx-5">
        <!-- <div class="container"> -->
            <div class="row">
                <div class="single-col d-md-none d-lg-block">
                    <div class="single-banner">
                        <img src="assets/images/tshirt/3_0.jpg" alt="Product" />
                        <div class="banner-content">
                            <span class="category text-white">Best Seller</span>
                            <span class="title text-white">New Collection</span>
                            <a href="shop.php" class="shop-link btn btn-primary text-uppercase" style="background-color:skyblue;">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="single-col center-col">
                    <div class="single-banner">
                        <img src="assets/images/tshirt/zbannergifip.gif" alt="image">
                        <div class="banner-content ">
                            <!--<span class="category ">Best Seller</span>-->
                            <!--<span class="title text-danger">Trending</span>-->
                            <a href="shop.php" class="shop-link btn btn-primary text-white text-uppercase" style="background-color:skyblue;">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="single-col d-md-none d-lg-block">
                    <div class="single-banner">
                        <img src="assets/images/tshirt/4_0.jpg" alt="" class="img-fluid" />
                        <div class="banner-content">
                            <span class="category text-white">Best Seller</span>
                            <span class="title text-white">Ariive Brands<br></span>
                            <a href="shop.php" class="shop-link btn btn-primary text-uppercase" style="background-color:skyblue;">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>
    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center m-0">
                        <h2 class="title">Latest Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area mx-5">
        <!-- <div class="container mb-5"> -->
            <div class="row">
                <div class="col">
                    <!-- <div class="tab-content mt-60px"> -->
                        <div class="tab-pane fade show active" id="tab-jewelry">
                            <div class="row">
                                <?php
                                $select_product = mysqli_query($conn, "SELECT tbl_product.prod_id, tbl_product.product_name, tbl_product.product_price, tbl_product.product_discount, MAX(tbl_image.image_path) AS image_path
                                        FROM tbl_product
                                        LEFT JOIN tbl_image ON tbl_product.prod_id = tbl_image.product_id
                                        GROUP BY tbl_product.prod_id");

                                while ($select_product_row = mysqli_fetch_assoc($select_product)) {
                                    $product_name = $select_product_row['product_name'];
                                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);
                                ?>
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px product_card mt-3 mb-3">
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="product-details.php?id=<?= $select_product_row['prod_id'] ?>&<?= $product_name_slug ?>" class="image">
                                                    <img src="./control-panel/<?= $select_product_row['image_path'] ?>" alt="<?= $select_product_row['image_path'] ?>" />
                                                    <img class="hover-image" src="./control-panel/<?= $select_product_row['image_path'] ?>" alt="<?= $select_product_row['image_path'] ?>" />
                                                </a>
                                                <div class="actions">
                                                    <a href="add_to_wishlist.php?product_id=<?= $select_product_row['prod_id'] ?>"
                                                        class="action wishlist" title="Add to Wishlist">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="ellipsis p-3 text_box"><strong><a href="product-details.php?id=<?= $select_product_row['prod_id'] ?>" class="text-dark text-mobile"><?= $product_name ?></a></strong></div>
                                                <span class="price">
                                                    <span class="new">&#8377;<?= $select_product_row['product_price'] ?></span>
                                                    <span class="old">&#8377;<?= $select_product_row['product_discount'] ?></span>
                                                </span>
                                            </div>
                                            <a href="product-details.php?id=<?= $select_product_row['prod_id'] ?>" title="View Product Details" class="add-to-cart btn btn-primary" style="background-color:#000;">View Product</a>
                                           
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- Footer Area Start -->
    <?php
    include 'footer.php';
    ?>
</body>

