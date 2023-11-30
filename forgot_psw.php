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
 
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">                            
                            <h4>Forgot Password</h4>                                                  
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="save_login.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                    <label for="">Choose Security</label>
                                                        <select name="update_security" class="form-select" style="height: 50px;">
                                                            <option value="">Choose Security</option>
                                                            <option value="Name">What is Your Pet Name </option>
                                                            <option value="Place">What IS Your Birth Place</option>
                                                            <option value="DOB">What is Your DOB</option>
                                                            <option value="Friend">Who is Your Best Friend</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Enter Your Security Answer</label>
                                                        <input type="text" name="security_answer" placeholder="Enter Security Answer">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Enter Your New Password</label>
                                                        <input type="text" name="update_password" title="Create Alphabet Numeric and Special Characters strong password" placeholder="Enter New Password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                       <button type="submit" name="verify_password" class="form-control bg-dark text-white fw-bold"> Change Password</button>
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
    </div>  
<?php
include 'footer.php';
?>
</body>

</html>