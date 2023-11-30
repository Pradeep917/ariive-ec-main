<?php 
include 'config.php';
$order_id=$_POST['order_id'];
$order_status=$_POST['order_status'];

$order_update=mysqli_query($conn, "UPDATE `tbl_order_item` SET `order_status`='$order_status' WHERE order_id='$order_id'");
if($order_update)
{
    $_SESSION['message']='Order Status Has Been Updated !';
    header('location:customer_order_list.php');
}else
{
    $_SESSION['message']='Order Status Not Updated !';
    header('location:manage_order.php');
}
?>