
<div class="footer-area px-5 mt-5">
    <div class="footer-container">
        <div class="footer-top">
            <!--<div class="container">-->
                <div class="row">
                    <div class="col-4 col-lg-3 col-4 mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">Menu</h4>
                            <div class="footer-links">
                                <div class="footer-row">
                                    <ul class="align-items-center">
                                        <li class="li"><a class="single-link" href="index.php">Home</a></li>
                                        <li class="li"><a class="single-link" href="about.php">About us</a></li>
                                        <li class="li"><a class="single-link" href="shop.php">Shop Now</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-3 mb-md-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">Information</h4>
                            <div class="footer-links">
                                <div class="footer-row">
                                    <ul class="align-items-center">
                                        <li class="li"><a class="single-link" href="contact.php">Contact Us</a></li>
                                        <li class="li"><a class="single-link" href="terms-condition.php">Terms & Conditions</a></li>
                                        <li class="li"><a class="single-link" href="return-policy.php">Return Policy</a></li>
                                    </ul>
                                </div>                                
                            </div>
                        </div>
                    </div>                    
                    <div class="col-md-8 col-lg-6 col-sm-8 pl-120px line-shape">
                        <div class="single-wedge ">
                            <h4 class="footer-herading">Contact Us</h4>
                            <div class="footer-links">
                                <p class="mail">If you have any question.please <br> contact us at -<a href="mailto:Support@ariive.co.in" style="color:#fff;">Support@ariive.co.in</a> </p>
                                <p class="address m-0 d-flex"><span><i class="pe-7s-map-marker" style="color:skyblue;"></i></span><span>J-2303 Ace City Noida Extension, Gautam Buddha Nagar 201306 U.P.</span> </p>
                                <p class="phone m-0"><i class="pe-7s-phone" style="color:skyblue;"></i><span><a href="tel:8178326544">+91 8178326544</a> 
                                <!-- <br> <a href="tel:8178326544">+91 8178326544</a></span> -->
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="social-icon d-flex">                                
                        <ul class="d-flex mt-1">
                            <li>                               
                                <a href="https://www.facebook.com/profile.php?id=61551255532171&mibextid=LQQJ4d" class="mx-2"><img src="assets/images/icon/Facebook.png" alt="facebook" height="50px" width="50px"></a>
                            </li>                          
                            <li>                                
                                <a href="https://www.youtube.com/@Ariive007" class="mx-2"><img src="assets/images/icon/you.png" alt="facebook" height="52px" width="52px"></a>
                            </li>
                            <li>                                
                                <a href="https://instagram.com/ariive._?igshid=OGQ5ZDc2ODk2ZA%3D%3D&utm_source=qr" class="mx-2"><img src="assets/images/icon/instagram.webp" alt="facebook" height="50px" width="50px"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            <!--</div>-->
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="line-shape-top">
                    <div class="row flex-md-row-reverse align-items-center">
                        <div class="col-md-6 text-center text-md-end">
                            <div class="payment-mth">
                                Managed By <a class="company-name text-white" target="_blank" href="https://www.risebeyond.in/"><strong>Risebeyond.in</strong></a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center text-md-start">
                            <p class="copy-text"> 
                                <?php 
                                $select_setting=mysqli_query($conn, "select copyright from web_setting");
                                while($select_setting_row=mysqli_fetch_assoc($select_setting))
                                {
                                ?>

                                © <?php echo date('Y')?> <strong><?= $select_setting_row['copyright']?></a>.
                                <?php } ?>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal Start -->
<div class="modal popup-search-style" id="searchActive">
    <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <div class="modal-overlay">
        <div class="modal-dialog p-0" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Search Your Product</h2>
                    <form class="navbar-form position-relative" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search here...">                            
                        </div>
                        <span>
                            <?php 
                            $select_cat=mysqli_query($conn, "SELECT * FROM category;");
                            while($select_cat_row=mysqli_fetch_assoc($select_cat))
                            {      
                                ?>
                                <p><a href="shop.php" class="text-dark"><?= $select_cat_row['cat_name']?></a></p>                      
                            <?php } ?>
                        </span>
                        <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vendor JS -->
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<script src="assets/js/manage_cart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Main Js -->
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<script>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right'); // Set the position first
        alertify.success('<?= $_SESSION['message']; ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>
