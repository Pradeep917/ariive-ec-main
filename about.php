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
                <h2 class="breadcrumb-title">About Us</h2>

                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" style="color:skyblue;">About Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="service-area mt-3 px-5">
    <!-- <div class="container"> -->
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-lg-5">               
                <img src="assets/images/slider-image/image1.png" alt="" class="">
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="service-right-content mb-5">
                    <h2 class="title">Our Stories</h2>
                    <p class="para-1">Welcome to Ariive, Where Style Meets Comfort!</p>
                    <p class="para-2">At Ariive, we're passionate about providing you with a curated selection of high-quality clothing that not only looks great but feels great too. Our mission is to offer a seamless shopping experience, allowing you to express your unique style with confidence.
                    </p>
                    <div class="mision-vision">
                        <div class="mision">
                            <span class="heading">Our Mission</span>
                            <p class="mision-desc">We believe that fashion should be accessible to everyone, regardless of age, size, or budget. That's why we strive to offer a diverse range of clothing options that cater to a wide variety of tastes and preferences.</p>
                        </div>                        
                    </div>
                    <p class="para-2">
                        <h4>The Ariive Experience</h4>
                        Quality You Can Trust: We handpick each item in our collection, ensuring that it meets our strict quality standards. From the stitching to the fabric, every detail is scrutinized to guarantee you're receiving a garment that's built to last.<br>
                        Fashion for Every Occasion:  Whether you're dressing for a casual day out, a formal event, or anything in between, we have the perfect outfit waiting for you. Our versatile selection is designed to accommodate your lifestyle, no matter the setting.<br>
                        Dedicated to Your Satisfaction: Your satisfaction is our top priority. We take pride in offering exceptional customer service and are always here to assist you with any questions or concerns you may have.
                        <h4>Our Collections </h4>
                        Casual Chic: Discover a range of comfortable yet stylish everyday wear that effortlessly combines fashion and function.<br>
                        Classic Basics:  Elevate your everyday wardrobe with our selection of timeless, minimalist t-shirts and sweatshirts. These pieces are perfect for creating effortless, casual looks.
                    </p>
                </div>
            </div>
        </div>
    <!-- </div> -->
</div>
<?php
include 'footer.php';
?>
</body>

</html>