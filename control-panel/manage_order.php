<?php
include 'nav.php';
$order_id=$_GET['id'];
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Update Order Status</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="customer_order_list.php"
                                    class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php                                
                        $select_order = mysqli_query($conn, "SELECT o.product_size, o.product_qty, o.product_price, o.user_id, o.order_status,
                        o.payment_method, o.tracking_id, o.caddress_id, o.order_id,o.created_at,p.product_name,i.image_path
                        FROM tbl_order_item o
                        JOIN tbl_product p ON o.product_id = p.prod_id
                        JOIN tbl_image i ON o.product_id = i.product_id WHERE  o.order_id='$order_id'");
                        if (mysqli_num_rows($select_order) > 0) {
                    ?>
                    <form action="manage_order_save.php" method="post">
                        <div class="row">
                            <?php 
                                 while ($select_order_row = mysqli_fetch_assoc($select_order)) {
                            ?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Tracking Id</label>
                                    <input type="hidden" name="order_id" class="form-control"
                                        value="<?= $select_order_row['order_id']?>">
                                    <input type="text" class="form-control"
                                        value="<?= $select_order_row['tracking_id']?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control"
                                        value="<?= $select_order_row['product_name']?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Update Order Status</label>
                                    <select name="order_status" class="form-select">
                                        <option value="Order Placed">Order Placed</option>
                                        <option value="Order Packing">Order Packing</option>
                                        <option value="Order Shipped">Order Shipped</option>
                                        <option value="Order Delivered">Order Delivered</option>
                                        <option value="Return Confirm">Return Confirm</option>
                                        <option value="Return Pending">Return Pending</option>
                                        <option value="Return Success">Return Success</option>
                                        <option value="Return Canceled">Return Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="form-group">
                                    <button type="submit" name="submit"
                                        class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Update Order
                                        Status</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </form>
                    <?php } else
                    {
                        ?>
                    <div class="card justify-content-center">
                        <?php echo 'Order Id is Missing Try Again !'?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>