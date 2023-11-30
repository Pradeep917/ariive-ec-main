<?php
include 'nav.php';
$data = "select * from `tbl_size` ORDER BY `size_id` ASC";
$result = mysqli_query($conn, $data);
?>
<div class="wrapper flex-column bg-light">
    <div class="body">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between header-btn">
                        <h4 class="card-title mb-0">Product Size List</h4>
                        <h4 class="card-title add-btn mb-0"><a href="add_size.php" class="">Add Size</a><i class="bi bi-plus"></i></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Size</th>                               
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
                                        <td><?php echo $row['size_name']; ?></td>                                       
                                        <td><a href="edit_size.php?id=<?= $row['size_id'] ?>" class="text-dark"><i class="bi bi-pen-fill"></i></a></td>
                                        <td><a href="save_size.php?id=<?= $row['size_id'] ?>" class="text-dark"><i class="bi bi-trash-fill"></i></a></td>
                                    </tr>
                                <?php
                                    $counter++; // Increment the counter for each row
                                }
                            } else {
                                ?>
                                <tr class="product-status fw-bold">
                                    <td colspan="5">No Size Found</td>
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