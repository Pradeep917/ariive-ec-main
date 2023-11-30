<?php
include 'config.php';
if (isset($_SESSION['ADMIN_ACCESS']) && $_SESSION['ADMIN_ACCESS'] != '') {
} else {
    header('location:login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php 
    $select_query=mysqli_query($conn,"SELECT * FROM web_setting");
    while($select_query_row=mysqli_fetch_assoc($select_query)){
    ?>
    <title><?= $select_query_row['title']?></title>
    <link rel="icon" type="image/x-icon" href="<?= $select_query_row['web_logo']?>">
    <?php }?>
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="css/examples.css" rel="stylesheet">
    <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js" class="href">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <style>
        body {
            overflow-x: hidden;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
             <?php 
                 $select_query=mysqli_query($conn,"SELECT * FROM web_setting");
                while($select_query_row=mysqli_fetch_assoc($select_query)){
            ?>
            <img src="<?= $select_query_row['web_logo']?>" alt="<?= $select_query_row['web_logo']?>" style="width:100%; height:130px; border-radius:10px; padding:5px;">
            <?php } ?>
        </div>
        <ul class="sidebar-nav mt-3 mb-5" data-coreui="navigation" data-simplebar="">
            <li><a class="nav-link" href="dashboard.php">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> Dashboard</a></li>
            <li style="margin-left:5%; font-weight:600;">Menu</li>
            <li><a class="nav-link justify-content-between" href="category_list.php">Manage Category<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="size_list.php">Manage Size<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="color_list.php">Manage Color<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="product_list.php">Manage Product<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="website_setttin.php">Website Setting<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="customer_login.php">Customer Login Details<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="customer_order_list.php">Customer Order Details<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="customer_address_list.php">Customer Address Details<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="customer_order_return_list.php">Customer Order Return<i class="bi bi-arrow-right"></i></a></li>
            <li><a class="nav-link justify-content-between" href="custome_list.php">Customer Enquiry<i class="bi bi-arrow-right"></i></a></li>
        </ul>
        <!-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> -->
    </div>
    <div class="wrapper d-flex flex-column  bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="assets/brand/coreui.svg#full"></use>
                    </svg></a>
                <ul class="header-nav d-none d-md-flex">
                    <li><a class="nav-link" href="dashboard.php">Dashboard</a></li>

                </ul>
                <ul class="header-nav ms-auto">
                </ul>
                <ul class="header-nav ms-3 mx-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php 
                                    $select_query=mysqli_query($conn,"SELECT * FROM web_setting");
                                    while($select_query_row=mysqli_fetch_assoc($select_query)){
                                ?>
                            <div class="avatar web-avtar fw-bold mx-3"><img class="avatar-img" src="<?= $select_query_row['web_logo'] ?>">Account</div>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold mx-2">Account</div>
                                <div class="dropdown-header bg-light py-2">
                                    <div class="fw-semibold">Settings</div>
                                </div>
                                <a class="dropdown-item" href="admin_profile.php">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>Profile</a>

                                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                        </use>
                                    </svg>Logout</a>
                            </div>
                    </li>
                </ul>
            </div>
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Home</span>
                        </li>
                        <li class="breadcrumb-item active"><span>Dashboard</span></li>
                    </ol>
                </nav>
            </div>
        </header>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/chart.js/js/chart.min.js"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['message'])) {
        ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['message']; ?>');
        <?php
            unset($_SESSION['message']);
        }
        ?>
    </script>

</body>

</html>