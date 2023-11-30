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
                    <h2 class="breadcrumb-title">Return Policy</h2>
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Return Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="privacy_policy_main_area pb-100px pt-100px px-5">
            <div class="container-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="privacy_content section_2" data-aos="fade-up" data-aos-delay="400">
                            <h2>RETURN POLICY</h2>
                            <h3>We are ARIIVE</h3>
                            <p>Thank you for your purchase. We hope you are happy with your purchase. However, if you are not completely satisfied with your purchase for any reason, you may return it to us for a full refund or an exchange. Please see below for more information on our return policy.
                                    RETURNS</p>
                            <h4>You can contact us by email at</h4>
                            <p></p>or by mail to -<a href="mailto:support@ariive.co.in">support@ariive.co.in</a></p>
                            <h4>RETURNS</h4>
                            <p>All returns must be postmarked within one (1) days of the purchase date. All returned items must be in new and unused condition, with all original tags and labels attached.</p><br>
                            <h4>RETURN PROCESS</h4>
                            <p>To return an item, please email customer service at <a href="mailto:support@ariive.co.in">support@ariive.co.in</a> to obtain a Return Merchandise Authorisation (RMA) number. After receiving a RMA number, place the item securely in its original packaging and Item tag, then mail your return to the following address:</p>
                            <p>Ariive<br>
                                Attn: Returns<br>
                                RMA #
                                C Block 202 Bahukhandi Awas
                                Near Women's Helpline Chauraha
                                Lucknow, 226001 226001</p><br><br>
                            <h2>REFUNDS</h2>    
                            <p>After receiving your return and inspecting the condition of your item, we will process your return or exchange. Please allow at least seven (7) days from the receipt of your item to process your return or exchange. We will notify you by email when your return has been processed.</p>
                            <h4>EXCEPTIONS</h4>
                            <p>The following items cannot be returned or exchanged:</p>
                            <ul>
                                <li> Items without tags</li>
                                <li>Items that felt wrong</li>
                            </ul>
                            <p>For defective or damaged products, please contact us at the contact details below to arrange a refund or exchange.<br>
                                Please Note</p>
                                <ul>
                                    <li> NO RETURNS FOR COD</li>
                                    <li>The items bought through COD will only be exchanged</li>
                                </ul>
                                <h4>QUESTIONS</h4>
                                <p>If you have any questions concerning our return policy, please contact us at:</p>
                                <strong>Call:- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><a href="tel:+91 8178326544"> +918178326544</a><br>
                                <strong>Email-: &nbsp;&nbsp;&nbsp;&nbsp;</strong><a href="mailto:support@ariive.co.in"> support@ariive.co.in</a><br><br>
                                
                                <h3>SHIPPING & DELIVERY POLICY</h3>
                                <p>Last updated October 31, 2023</p>
                                <p>Please carefully review our Shipping & Delivery Policy when purchasing our products. This policy will apply to any order you place with us.
                                WHAT ARE MY SHIPPING & DELIVERY OPTIONS?</p>
                                <p>We offer various shipping options. In some cases a third-party supplier may be managing our inventory and will be responsible for shipping your products.
                                Free Shipping<br>
                                We offer free standard shipping on prepaid orders.</p>
                                <h3>Expedited Shipping Fees</h3>
                                <p>We also offer expedited shipping at the following rates:</p>
                                <p>If you select an expedited shipping option, we will follow up after you have placed the order with any additional shipping information.
                                All times and dates given for delivery of the products are given in good faith but are estimates only.</p>
                                
                                <h3>DO YOU DELIVER INTERNATIONALLY?</h3>
                               <p> We do not offer international shipping.</p><br>
                               <b> HOW CAN YOU CONTACT US ABOUT THIS POLICY?</b>
                                <p>If you have any further questions or comments, you may contact us by:</p>
                                <ul>
                                    <li><strong>Call:- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><a href="tel:+91 8178326544"> +918178326544</a><br></li>
                                    <li><strong>Email-: &nbsp;&nbsp;&nbsp;&nbsp;</strong><a href="mailto:support@ariive.co.in"> support@ariive.co.in</a><br><br></li>
                                </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>