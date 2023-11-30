<?php
include 'nav.php';
$data = "select * from `customer_enquery` ORDER BY `cus_id` ASC";
$result = mysqli_query($conn, $data);
?>
<div class="wrapper flex-column bg-light">
    <div class="body">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between header-btn">
                        <h4 class="card-title mb-0">Customer Enquiry Details</h4>
                        <!-- <h4 class="card-title add-btn mb-0"><a href="add_category.php" class="">Add Category</a><i class="bi bi-plus"></i></h4>                         -->
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
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Time</th>            
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
                                        <td><?php echo $row['c_name']; ?></td>
                                        <td><?php echo $row['c_email']; ?></td>
                                        <td><?php echo $row['c_number']; ?></td>
                                        <td><?php echo $row['c_subject']; ?></td>
                                        <td><?php echo $row['c_message']; ?></td>
                                        <td><?php echo $row['create_at']; ?></td>
                                        <td><a href="delete_customer.php?id=<?= $row['cus_id'] ?>" class="text-dark"><i class="bi bi-trash-fill"></i></a></td>

                                    </tr>
                                <?php
                                    $counter++; // Increment the counter for each row
                                }
                            } else {
                                ?>
                                <tr class="product-status fw-bold">
                                    <td colspan="7">Details Not Found</td>
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