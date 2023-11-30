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
<?php include 'navbar.php'; ?>
<body>    
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Login With User</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" style="color:skyblue;">Login</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
 
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                                <h1>User login</h1>
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="save_login.php" method="post">
                                            <input type="text" class="form-control" name="user-email" placeholder="Your Email" />
                                            <input type="password"  class="form-control" name="user-password" placeholder="Password" />
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox" required/>
                                                    <a class="flote-none" href="javascript:void(0)">Remember me</a>
                                                    <a href="forgot_psw.php">Forgot Password?</a>
                                                </div>
                                                <button type="submit" class="form-control" name="login"><span>Login</span></button>
                                            </div>
                                        </form>
                                        <button class="login-with_gmail form-control mt-3">
                                            <?php 
                                            // include 'login_with_google.php';
                                            ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="register-button mt-4">
                                <a href="register_new_user.php" class="text-dark fw-bold bg-success text-white px-5 p-2 rounded-2 float-end">Register New User</a>
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
</body>

</html>