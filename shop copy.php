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
                    <h2 class="breadcrumb-title">Shop</h2>                  
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Ariive T-Shirt</li>
                    </ul>                    
                </div>
            </div>
        </div>
    </div>
   
    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                    <div class="desktop-tab">
                        <div class="shop-top-bar float-right">                            
                            <div class="row float-right">
                                <div class="col-sm-4">
                                    <div class="select-shoing-wrap d-flex">
                                        <div class="shot-product">
                                            <p class="text-nowrap">Sort By:</p>
                                        </div>
                                        <select class="form-select">
                                            <option data-display="Default">Default</option>
                                            <option value="1"> Name, A to Z</option>
                                            <option value="2"> Name, Z to A</option>
                                            <option value="3"> Price, low to high</option>
                                            <option value="4"> Price, high to low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile shop bar -->
                    <div class="shop-top-bar mobile-tab">
                        <!-- Left Side End -->
                        <div class="shop-tab nav d-flex justify-content-between">
                            <div class="shop-tab nav">
                                <a class="active" href="#shop-grid" data-bs-toggle="tab">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                </a>
                                <a href="#shop-list" data-bs-toggle="tab">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!-- Right Side Start -->
                            <div class="select-shoing-wrap d-flex align-items-center">
                                <div class="shot-product">
                                    <p>Sort By:</p>
                                </div>
                                <div class="shop-select">
                                    <select class="shop-sort">
                                        <option data-display="Default">Default</option>
                                        <option value="1"> Name, A to Z</option>
                                        <option value="2"> Name, Z to A</option>
                                        <option value="3"> Price, low to high</option>
                                        <option value="4"> Price, high to low</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <!-- Right Side End -->
                        <!-- Right Side Start -->
                        <div class="select-shoing-wrap d-flex align-items-center justify-content-between">
                            <div class="select-shoing-wrap d-flex align-items-center">
                                <div class="shot-product">
                                    <p>Show:</p>
                                </div>
                                <div class="shop-select show">
                                    <select class="shop-sort">
                                        <option data-display="12">12</option>
                                        <option value="1"> 12</option>
                                        <option value="2"> 10</option>
                                        <option value="3"> 25</option>
                                        <option value="4"> 20</option>
                                    </select>

                                </div>
                            </div>
                            <!-- Right Side End -->
                            <!-- Left Side start -->
                            <p class="compare-product">Product Compare <span>(0) </span></p>
                        </div>
                    </div>
                    <!-- Mobile shop bar -->
                    <div class="shop-bottom-area">
                        <div class="row">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="shop-grid">
                                        <div class="row mb-n-30px" id="product-list-container">
                                            <?php
                                            $select_product = mysqli_query($conn, "SELECT tbl_product.prod_id, tbl_product.product_name, tbl_product.product_price, tbl_product.product_discount, MAX(tbl_image.image_path) AS image_path
                                            FROM tbl_product
                                            LEFT JOIN tbl_image ON tbl_product.prod_id = tbl_image.product_id
                                            GROUP BY tbl_product.prod_id");

                                            while ($select_product_row = mysqli_fetch_assoc($select_product)) {
                                                $product_name = $select_product_row['product_name'];
                                                $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);
                                            ?>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">
                                                    <!-- Single Prodect -->
                                                    <div class="product">
                                                        <div class="thumb">
                                                            <a href="product-details.php?id=<?= $select_product_row['prod_id'] ?>&<?= $product_name_slug ?>" class="image">
                                                                <img src="./control-panel/<?= $select_product_row['image_path'] ?>" alt="<?= $select_product_row['image_path'] ?>" />
                                                                <img class="hover-image" src="./control-panel/<?= $select_product_row['image_path'] ?>" alt="<?= $select_product_row['image_path'] ?>" />
                                                            </a>
                                                            <!-- <span class="badges">
                                                                <span class="sale">-10%</span>
                                                                <span class="new">New</span>
                                                            </span> -->

                                                        </div>
                                                        <div class="content">
                                                            <h5 class="title"><a href="product-details.php?id=<?= $select_product_row['prod_id'] ?>&<?= $product_name_slug ?>"><?= $product_name ?>
                                                                </a>
                                                            </h5>
                                                            <span class="price">
                                                                <span class="new">&#8377;<?= $select_product_row['product_price'] ?></span>
                                                                <span class="old">&#8377;<?= $select_product_row['product_discount'] ?></span>
                                                            </span>
                                                        </div>
                                                        <button title="Add To Cart" class="add-to-cart btn btn-primary" style="background-color:skyblue;">Add
                                                            To Cart</button>
                                                    </div>
                                                    <!-- Single Prodect -->
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                       
                        <!-- <div class="pro-pagination-style text-center text-lg-end" data-aos="fade-up" data-aos-delay="200">
                            <div class="pages">
                                <ul>
                                    <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                    <li class="li"><a class="page-link" href="#">1</a></li>
                                    <li class="li"><a class="page-link active" href="#">2</a></li>
                                    <li class="li"><a class="page-link" href="#">3</a></li>
                                    <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div class="shop-sidebar-wrap">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Categories</h4>
                            <?php
                            $select_cat=mysqli_query($conn, "SELECT * FROM category;");
                            if(mysqli_num_rows($select_cat)>0)
                            {                           
                            ?>
                            <div class="sidebar-widget-category">
                                <?php 
                                while($select_cat_row=mysqli_fetch_assoc($select_cat))
                                {
                                ?>
                                <ul>                                    
                                    <!-- <li><a href="#" class=""><i class="fa fa-angle-right"></i> <?= $select_cat_row['cat_name']?>
                                            <span>(12)</span> </a></li> -->
                                    <li><a href="#" class="category-link" data-category-id="<?= $select_cat_row['cat_id'] ?>"><i class="fa fa-angle-right"></i> <?= $select_cat_row['cat_name'] ?><span>(12)</span></a></li>

                                </ul>
                                <?php } ?>
                            </div>
                            <?php }else
                            {
                                ?>
                                <div class="card fw-bold">
                                    <?php  echo 'No Fategory Found';?>
                                </div>
                                <?php 
                            }                            
                            ?>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Color</h4>
                            <div class="sidebar-widget-color">
                                <ul>
                                    <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> All
                                            <span>(65)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> Gold <span>(14)</span>
                                        </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> Golden <span>(21)</span>
                                        </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> White <span>(16)</span>
                                        </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> Black <span>(12)</span>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Size</h4>
                            <div class="sidebar-widget-size">
                                <ul>
                                    <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> All
                                            <span>(6)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> S <span>(12)</span> </a>
                                    </li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> M <span>(21)</span> </a>
                                    </li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> L <span>(16)</span> </a>
                                    </li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> XL <span>(22)</span> </a>
                                    </li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> XXL <span>(22)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget mt-8">
                            <h4 class="sidebar-title">Price Filter</h4>
                            <div class="price-filter">
                                <div class="price-slider-amount">
                                    <input type="text" id="amount" class="p-0 h-auto lh-1" name="price" placeholder="Add Your Price" />
                                </div>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script>
$(document).ready(function() {
    $(".category-link").click(function(e) {
        e.preventDefault();
        var categoryId = $(this).data("category-id");
        // Make an AJAX request to get products based on the selected category
        $.ajax({
            type: "POST", // You can use GET or POST based on your server-side code
            url: "filter-products.php", // Create this PHP file to handle the request
            data: { categoryId: categoryId },
            success: function(data) {
                // Update the product list container with the new product data
                $("#product-list-container").html(data);
            }
        });
    });
});
</script>
</body>

</html>