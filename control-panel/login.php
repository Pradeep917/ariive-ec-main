<?php 
include 'config.php';
$msg="";
if(isset($_POST['submit']))
{   
    $username=get_safe_value($conn, $_POST['login']);
    $user_password=get_safe_value($conn, $_POST['password']);
    $query="select * from `admin_login` where user_name='$username' and user_psw='$user_password'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count > 0)
    {
        $_SESSION['ADMIN_ACCESS']='yes';
        $_SESSION['ADMIN_USER_NAME']='$username';  
        $_SESSION['message']='Now You are Login !';       
        header('location:dashboard.php');
        die();        
    }else
    {
        $msg="Please Enter Currect Login Details";       
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Welcome To Ariive Control-panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="assets/logo/arive_logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body {
                    background: #007bff;
                    background: linear-gradient(to right, #0062E6, #33AEFF);
                    }

                    .btn-login {
                    font-size: 0.9rem;
                    letter-spacing: 0.05rem;
                    padding: 0.75rem 1rem;
                    }

                    .btn-google {
                    color: white !important;
                    background-color: #ea4335;
                    }

                    .btn-facebook {
                    color: white !important;
                    background-color: #3b5998;
                    }
        </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-1 p-sm-5">
                        <h5 class="card-title text-center mb-5"><img src="assets/logo/arive_logo.png" class="img-fluid" style="height:100px;"></h5>
                        <form method="POST" action="">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" placeholder="Enter Your User Name" name="login" required>
                                <label>Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required minlength="6"  maxlength="16">
                                <label>Password</label>
                            </div>
                            <div class="form-check">
                                <button class="btn btn-primary form-control text-uppercase fw-bold" type="submit" name="submit">Sign
                                    in</button>
                            </div>                            
                        </form>
                        <div class="form-check">
                            <!-- <a href="forget_password.php" class="href"><button class="btn btn-success form-control text-uppercase fw-bold mt-2">Forgat Password</button></a> -->
                            </div>
                        <div class="error"style="font-weight:600; color:red; text-align:center;font-size:19px;">
                            <?php 
                            echo $msg;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>