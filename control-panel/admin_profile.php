<?php
include 'nav.php';
$data = "select * from `admin_login`";
// $id=$_GET['$login_id'];
$result = mysqli_query($conn, $data);
?>

<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Category List</h4>
                        </div>
                        <div>
                            <h4 class="card-title mb-0"><a href="edit_password.php" class="btn btn-secondary fw-bold font-14 rounded-1 px-3 py-1"><i class="bi bi-arrow-90deg-left"></i>Change Pasword</a></h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="container my-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="white-space:nowrap;">
                                            <th>Sr.No.</th>
                                            <th>User Name</th>
                                            <th>User Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <td><?php echo $row['login_id'] ?></td>
                                                <td><?php echo $row['user_name'] ?></td>
                                                <td><?php echo $row['user_psw'] ?></td>

                                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <?php
                    if (isset($_POST['update'])) {
                        $user_name = mysqli_real_escape_string($conn, $_POST['ad_login']);
                        $user_name = mysqli_real_escape_string($conn, $_POST['ad_password']);
                        $update = "UPDATE `admin_login` SET `user_name`='$user_name',`user_psw`='$user_name' where login_id='1'";
                        if (mysqli_query($conn, $update)) {
                    ?>
            <script>
                window.location='admin_profile.php';
            </script>
            <?php
                        } else {
                            echo 'faild';
                        }
                    }
            ?> -->