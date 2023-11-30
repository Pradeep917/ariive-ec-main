<header>
    <div class="header-main sticky-nav" style="height:120px;">
        <div class="container position-relative" style="margin-top:-10px;">
            <div class="row">
                <div class="col-auto align-self-center">
                    <?php
                    $select_query = mysqli_query($conn, "SELECT web_logo FROM web_setting");
                    while ($select_query_row = mysqli_fetch_assoc($select_query)) {
                    ?>
                        <div class="header-logo">
                            <a class="navbar-brand" href="index.php">
                                <img src="./control-panel/<?= $select_query_row['web_logo'] ?>" alt="<?= $select_query_row['web_logo'] ?>" width="" height="100px">
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="col align-self-center d-none d-lg-block">
                    <div class="main-menu">
                        <ul>
                            <li class="dropdown"><a href="index.php">Home</a>
                            </li>
                            <li><a href="about.php">About</a></li>
                            <li class="dropdown position-static"><a href="shop.php">Collection<i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu" style="margin-top:-10px;">
                                    <?php
                                    $category_query = mysqli_query($conn, "SELECT * FROM category");
                                    while ($category_query_row = mysqli_fetch_assoc($category_query)) {
                                    ?>
                                        <li><a href="shop.php"><?= $category_query_row['cat_name'] ?></a></li>

                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-lg-auto align-self-center pl-0">
                    <div class="header-actions">
                        <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                            <i class="pe-7s-search" style="color:#000; border-radius:2px; padding:2px;"></i>
                        </a>
                        <div class="header-bottom-set dropdown">
                            <?php
                            if (isset($_SESSION['auth'])) {
                                $login_id = $_SESSION['auth_user']['user_id'];
                                $select_login = mysqli_query($conn, "SELECT * FROM user_login_details WHERE user_id = $login_id");
                                while ($select_login_row = mysqli_fetch_assoc($select_login)) {
                                    $username = $select_login_row['user_name'];
                            ?>
                                    <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown">
                                        <span style="font-size:20px;font-weight:bold;"><?= $username ?></span> &nbsp;<i class="pe-7s-users" style="color:black; padding-left:10px;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right mt-5">
                                        <li><a class="dropdown-item" href="my-account.php">My account</a></li>
                                        <!-- <li><a class="dropdown-item" href="checkout.php">Checkout</a></li> -->
                                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                    </ul>
                                <?php
                                }
                            } else {
                                // User is not logged in
                                ?>
                                <a href="login.php" class="header-action-btn"><i class="pe-7s-users" style="color:#000; border-radius:2px; padding-left:10px;"></i></a>
                            <?php
                            }
                            ?>
                        </div>

                        <?php
                        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {                            
                            $user_id = $_SESSION['auth_user']['user_id'];                           
                            $sql = "SELECT COUNT(*) AS total_items FROM tbl_cart WHERE user_id = $user_id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $total_items = $row['total_items'];
                        ?>
                            <a href="#offcanvas-cart" class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                                <i class="pe-7s-shopbag" style="color:#000; border-radius:2px; padding:2px;"></i>
                                <span class="header-action-num" style="background-color:black;"><?php echo $total_items; ?></span>
                            </a>
                            <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                            <i class="pe-7s-like"></i>
                        </a>
                        <?php
                        }
                        ?>

                        <a href="#offcanvas-mobile-menu" class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                            <i class="pe-7s-menu" style="color:#000; border-radius:2px; padding-left:10px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="offcanvas-overlay"></div>

<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
    <div class="inner">
        <div class="head">
            <span class="title">Wishlist</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                <?php 
                    $sql = "SELECT w.wishlist_id, w.user_id, w.product_id, p.product_name, p.product_price, 
                   (SELECT image_path FROM tbl_image i WHERE i.product_id = w.product_id LIMIT 1) AS image_path
                   FROM tbl_wishlist w
                   LEFT JOIN tbl_product p ON w.product_id = p.prod_id";
                    $result=mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        ?>
                <?php 
                        while ($row_wishlist = $result->fetch_assoc()) {                
                        ?>
                <li>
                    <a href="product-details.php?id=<?= $row_wishlist['product_id'] ?>" class="image"><img
                            src="./control-panel/<?= $row_wishlist['image_path']?>" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="product-details.php?id=<?= $row_wishlist['product_id'] ?>"
                            class="title" style="font-size:40px;"><?= $row_wishlist['product_name']?></a>
                        <span class="quantity-price">1 X <span class="amount"><?= $row_wishlist['product_price']?></span></span>

                        <button class="removed m-2 p-2 fw-bold border btn btn-outline-dark delete-item" data-wishlist-id="<?= $row_wishlist['wishlist_id'] ?>"
                             style="font-size:30px;">x</button>
                    </div>
                </li>
                <?php } 
                    }else
                    {                        
                        ?>
                <div class="card p-4 fw-bold">
                    <?php echo "Wishlist is empty ..... !";?>
                </div>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>

<div id="offcanvas-cart" class="offcanvas offcanvas-cart">
    <div class="inner">
        <div class="head">
            <span class="title" style="font-size:30px;">Cart</span>
            <button class="offcanvas-close">X</button>
        </div>
        <div class="body customScroll">
                    <?php
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
                                        while ($select_cart_row = mysqli_fetch_assoc($select_cart)) {
                                        
                                ?>
                        <ul class="minicart-product-list">
                            <li>
                                <a href="product-details.php?id=<?= $select_cart_row['product_id'] ?>" class="image"><img src="./control-panel/<?= $select_cart_row['image_path'] ?>" class="rounded-2" alt="Cart product Image"></a>
                                <div class="content">
                                    <a href="product-details.php?id=<?= $select_cart_row['product_id'] ?>" class="title" style="text-align:left !important; font-size:40px;"><?= $select_cart_row['product_name'] ?></a>
                                    <span class="quantity-price" style="font-size:25px;"><?= $select_cart_row['product_qty'] ?> X <span class="amount" style="font-size:25px;">&#8377;<?= $select_cart_row['product_price'] ?></span></span>
                                    <!-- <button class="remove m-5 p-2 fw-bold border btn btn-outline-dark">×</button> -->
                                    <button class="remove m-5 p-2 fw-bold border btn btn-outline-dark" data-product-id="<?= $select_cart_row['product_id'] ?>" style="font-size:30px;">X</button>
                                </div>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                    <div class="foot">
                        <div class="buttons mt-30px">
                            <a href="cart.php" class="btn btn-primary btn-hover-primary mb-30px">view cart</a>
                            <a href="checkout.php" class="btn btn-outline-primary current-btn" style="background-color:skyblue;">checkout</a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="card-body mt-3">
                        <h3 class="card align-items-center p-2">No Item Available</h3>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="card-body mt-3">
                    <h3 class="card align-items-center p-2 text-capitalize">Please log in to view your cart items... !</h3>
                    <button class="form-control"><a href="login.php" class="fw-bold">Go To Login</a></button>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>



<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <button class="offcanvas-close mt-2 mb-3"></button>
    <div class="inner customScroll mt-5">
        <div class="offcanvas-menu mb-4">
            <ul>
                <li><a href="index.php"><span class="menu-text">Home</span></a>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="shop.php"><span class="menu-text">Collection</span></a>
                    <ul class="sub-menu">
                        <?php
                        $category_query = mysqli_query($conn, "SELECT * FROM category");
                        while ($category_query_row = mysqli_fetch_assoc($category_query)) {
                        ?>
                            <li><a href="shop.php"><?= $category_query_row['cat_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
        <div class="offcanvas-social mt-auto mb-5 mx-4">
            <ul>
                <li>
                    <a href="https://www.facebook.com/profile.php?id=61551255532171&mibextid=LQQJ4d"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="https://www.youtube.com/@Ariive007"><i class="fa fa-youtube"></i></a>
                </li>
                <li>
                    <a href="https://instagram.com/ariive._?igshid=OGQ5ZDc2ODk2ZA%3D%3D&utm_source=qr"><i class="fa fa-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".delete-item").on('click', function(e) {
        e.preventDefault();
        var wishlistId = $(this).data('wishlist-id');
        var currentItem = $(this);

        $.ajax({
            type: 'POST',
            url: 'delete_wishlist_item.php',
            data: {
                wishlist_id: wishlistId
            },
            success: function(response) {
                if (response === 'success') {
                    currentItem.closest('li').remove();
                    alertify.success('Item removed successfully.');
                } else {
                    alertify.success('Failed to remove the item.');

                }
            },
            error: function() {
                alertify.success('An error occurred while processing the request.');

            }
        });
    });
});
</script>

