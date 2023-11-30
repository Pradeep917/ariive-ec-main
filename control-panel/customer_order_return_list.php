<?php
include 'nav.php';
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Customer Order List</h4>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <?php
                        $count = 0;
                        $select_order = mysqli_query($conn, "SELECT
                                rp.`return_id`,
                                rp.`order_id`,
                                rp.`Product_name`,
                                rp.`product_id`,
                                rp.`product_qty`,
                                rp.`product_size`,
                                rp.`product_price`,
                                rp.`order_status`,
                                rp.`return_message`,
                                rp.`created_at`,
                                ti.`image_path`
                            FROM
                                `return_product` rp
                            JOIN
                                `tbl_image` ti ON rp.`product_id` = ti.`product_id`;");
                        if (mysqli_num_rows($select_order) > 0) {
                        ?>
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Sr. No.</th>
                                    <th>Order Id</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Order Status</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $counter = 1; // Initialize a counter for serial numbers
                                while ($select_order_row = mysqli_fetch_assoc($select_order)) {
                                ?>
                                    <tr>
                                        <td><?= $select_order_row['return_id'] ?></td>
                                        <td><?= $select_order_row['order_id'] ?></td>
                                        <td><img src="<?= $select_order_row['image_path'] ?>" alt="" class="rounded-1" height="50px" width="50px"></td>
                                        <td><?= $select_order_row['Product_name'] ?></td>
                                        <td><?= $select_order_row['product_qty'] ?></td>
                                        <td><?= $select_order_row['product_size'] ?></td>
                                        <td><?= $select_order_row['product_price'] ?></td>
                                        <td><?= $select_order_row['order_status'] ?></td>
                                        <td><?= $select_order_row['return_message'] ?></td>
                                        <td><?= $select_order_row['created_at'] ?></td>
                                    </tr>
                                <?php
                                    $counter++; // Increment the counter for each row
                                }
                                ?>
                            </tbody>
                        <?php
                        } else {
                        ?>
                            <tr class="product-status fw-bold">
                                <td colspan="7">Details Not Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>