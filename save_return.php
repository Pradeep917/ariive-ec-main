<?php
include './control-panel/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $product_name = $_POST['Product_name'];
    $product_id = $_POST['product_id']; 
    $product_qty = $_POST['product_qty'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $order_status = $_POST['order_status'];
    $return_message = $_POST['return_message'];
  
    $checkQuery = "SELECT * FROM return_product WHERE order_id = '$order_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['message']='Order return already sent for this !';
        header('location:my-account.php');
    } else {
    $query = "INSERT INTO return_product (order_id, Product_name, product_qty, product_size, product_price, product_id, order_status, return_message) 
              VALUES ('$order_id', '$product_name', '$product_qty', '$product_size', '$product_price', '$product_id', '$order_status', '$return_message')";

    $result = mysqli_query($conn, $query);

    if ($result) {        
        $_SESSION['message']='Order Return Request Sent !';
        header('location:my-account.php');
    } else {
        $_SESSION['message']='Server Error Try Again !';
        header('location:order_return.php');
    }
    }
}
