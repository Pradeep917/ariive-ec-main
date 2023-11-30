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
                    <h2 class="breadcrumb-title">Register New User</h2>
                   
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" style="color:skyblue;">Register</li>
                    </ul>
                    
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
                            <h4>Fill The Basic Details To Login </h4>
                        </div>
                        <div class="tab-content">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="save_login.php" method="post">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" name="user-name" placeholder="Username" required/>
                                            </div>
                                            <div class="col-sm-6">
                                                 <input name="user-email" placeholder="Email" type="email" required/>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="user-password" minlength="8" maxlength="20" placeholder="Password" title="Create Your Password" required/>                                                    
                                            </div>
                                            <div class="col-sm-6">
                                                <input name="user-number" placeholder="Number" type="text" required minlength="10" maxlength="10"/>                                                    
                                            </div>
                                            <div class="col-sm-6">
                                                <select name="security" class="form-select">
                                                    <option value="">Choose Security</option>
                                                    <option value="Name">What is Your Pet Name </option>
                                                    <option value="Place">What IS Your Birth Place</option>
                                                    <option value="DOB">What is Your DOB</option>
                                                    <option value="Friend">Who is Your Best Friend</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="security_ans" placeholder="Enter Name">
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="button-box">
                                                    <button type="submit" name="register" class="form-control"><span>Register</span></button>
                                                </div>
                                            </div>
                                        </div>                                            
                                    </form>
                                </div>
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