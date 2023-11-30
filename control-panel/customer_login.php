<?php
include 'nav.php';
$data = "select * from `user_login_details` ORDER BY `user_id` ASC";
$result = mysqli_query($conn, $data);
?>
<div class="wrapper flex-column bg-light">
    <div class="body">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between header-btn">
                        <h4 class="card-title mb-0">Customer Login Details</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Password</th>
                                <th>Time</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1; // Initialize a counter for serial numbers
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['user_email']; ?></td>
                                        <td><?php echo $row['user_phone']; ?></td>
                                        <td><?php echo $row['user_password']; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td><a href="?id=<?= $row['user_id'] ?>" class="text-dark"><i class="bi bi-pen-fill"></i></a></td>
                                        <td><a href="?id=<?= $row['user_id'] ?>" class="text-dark"><i class="bi bi-trash-fill"></i></a></td>
                                    </tr>
                                <?php
                                    $counter++; // Increment the counter for each row
                                }
                            } else {
                                ?>
                                <tr class="product-status fw-bold">
                                    <td colspan="7">Details Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>