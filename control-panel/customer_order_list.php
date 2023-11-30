<?php 
include 'nav.php';
?>
<style>
.status {}

.status.OrderPlaced {
    color: #0016F1 ;
    font-weight: bold;
}
.status.OrderPacking {
    color: orange;
    font-weight: bold;
}

.status.OrderShipped {
    color: #B918AD ;
    font-weight: bold;
}

.status.OrderDelivered {
    color: green;
    font-weight: bold;
}

.status.ReturnConfirm {
    color: blue;
    font-weight: bold;
}
.status.ReturnPending {
    color: #070307;
    font-weight: bold;
}
.status.ReturnSuccess {
    color: green;
    font-weight: bold;
}
.status.ReturnCanceled {
    color: red;
    font-weight: bold;
}

</style>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Customer Order List</h4>
                        </div>
                        <!-- <div>
                            <h4 class="card-title add-btn mb-0"><a href="color_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div> -->
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">    
                    <?php
                                $count = 0;
                                $select_order = mysqli_query($conn, "SELECT o.product_size, o.product_qty, o.product_price, o.user_id, o.order_status,
                                o.payment_method, o.tracking_id, o.caddress_id, o.order_id, o.created_at,p.product_name,i.image_path
                                FROM tbl_order_item o
                                JOIN tbl_product p ON o.product_id = p.prod_id
                                JOIN tbl_image i ON o.product_id = i.product_id ORDER BY o.order_id DESC");
                                if (mysqli_num_rows($select_order) > 0) {
                                ?>                    
                        <thead>
                            <tr>
                                <th style="color: red; font-weight:bold;">C. Address Id</th>
                                <th>Order Id</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                                $counter = 1; // Initialize a counter for serial numbers
                                while ($select_order_row = mysqli_fetch_assoc($select_order)) {
                            ?>
                            <tr>
                                <td style="background:#3C4B64; font-weight:bold;color:white;"><?= $select_order_row['caddress_id'] ?></td>
                                <td><?= $select_order_row['tracking_id'] ?></td>
                                <td><img src="<?= $select_order_row['image_path'] ?>" alt="" class="rounded-1" height="50px" width="50px"></td>
                                <td><?= $select_order_row['product_name'] ?></td>
                                <td><?= $select_order_row['product_qty'] ?></td>
                                <td><?= $select_order_row['product_size'] ?></td>
                                <td><?= $select_order_row['product_price'] ?></td>
                                <td>
                                    <span class="status <?= str_replace(' ', '', $select_order_row['order_status']) ?>">
                                        <?= $select_order_row['order_status'] ?>
                                    </span>
                                </td>
                                <td><?= $select_order_row['created_at'] ?></td>
                                 <td><a href="manage_order.php?id=<?= $select_order_row['order_id'] ?>"
                                        class="view text-dark"><i class="bi bi-pen-fill"></i></a></td>
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