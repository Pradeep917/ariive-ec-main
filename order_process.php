<?php
include './control-panel/config.php';
// function get_safe_value($conn,$str)
// {
//     if($str!='')
//     {
//         return mysqli_real_escape_string($conn,$str);
//     }
// }
$checkout_details = array();

if (isset($_POST['order_placed_cod'])) {
    $customer_id = get_safe_value($conn, $_POST['customer_id']);
    $payment_method = get_safe_value($conn, $_POST['order_placed_cod']);
    $u_fname = get_safe_value($conn, $_POST['u_fname']);
    $u_lname = get_safe_value($conn, $_POST['u_lname']);
    $u_email = get_safe_value($conn, $_POST['u_email']);
    $u_number = get_safe_value($conn, $_POST['u_number']);
    $u_state = get_safe_value($conn, $_POST['u_state']);
    $u_city = get_safe_value($conn, $_POST['u_city']);
    $u_landmark = get_safe_value($conn, $_POST['u_landmark']);
    $u_pincode = get_safe_value($conn, $_POST['u_pincode']);
    $u_address = get_safe_value($conn, $_POST['u_address']);
    $u_message = get_safe_value($conn, $_POST['u_message']);
    
    $phone = 123123;
    $tracking_no = "Ariive" . rand(1111, 9999) . substr($phone, 2);

    if ($customer_id > 0 )  {
        $sql = "UPDATE `customer_address` SET `c_fname`='$u_fname',`c_lname`='$u_lname',`c_email`='$u_email',`c_phone`='$u_number',`c_state`='$u_state',`c_city`='$u_city',`c_landmark`='$u_landmark',`c_pincode`='$u_pincode',`c_address`='$u_address',`c_message`='$u_message' WHERE customer_id='$customer_id'";
        $result = mysqli_query($conn, $sql);

    } elseif($customer_id == 0) {
        $sql = "INSERT INTO customer_address (`c_fname`, `c_lname`, `c_email`, `c_phone`, `c_state`, `c_city`, `c_landmark`, `c_pincode`, `c_address`, `c_message`)
        VALUES ('$u_fname','$u_lname','$u_email','$u_number','$u_state', '$u_city', '$u_landmark', '$u_pincode', '$u_address','$u_message')";
        $resultsql= mysqli_query($conn, $sql); 
        $customer_id = mysqli_insert_id($conn); 
    }

    $login_id = $_SESSION['auth_user']['user_id'];

    // Fetch details of items in the cart
    $cart_item = mysqli_query($conn, "SELECT c.*, p.prod_id, p.product_price FROM `tbl_cart` c JOIN `tbl_product` p ON c.product_id = p.prod_id WHERE c.user_id = '$login_id'");

    while ($cart_item_row = mysqli_fetch_assoc($cart_item)) {
        // Details for the current item
        $product_id = $cart_item_row['prod_id'];
        $product_qty = $cart_item_row['product_qty'];
        $product_size = $cart_item_row['product_size'];

        // Calculate the total price for the current item
        $product_price = $cart_item_row['product_price'];
        $total_price = $product_qty * $product_price;

        // Insert order details for the current item
        $create_order = mysqli_query($conn, "INSERT INTO `tbl_order_item`(`caddress_id`, `product_id`, `product_size`, `product_qty`, `product_price`, `user_id`, `payment_id`, `order_status`, `payment_method`, `tracking_id`) VALUES ('$customer_id','$product_id','$product_size','$product_qty','$total_price','$login_id','','Order Placed','$payment_method','$tracking_no')");
        
        if ($create_order) {
            $update_quantity = mysqli_query($conn, "UPDATE `product_size_quantity` SET `quantity` = `quantity` - '$product_qty' WHERE `product_id` = '$product_id'");
            $clear_cart = mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE user_id='$login_id'");
            $_SESSION['message'] = "Your order has been placed successfully!";
            header("Location: order_success.php");
            exit();
        } else {
            $_SESSION['message'] = "Sorry, your order could not be placed.";
            header("Location: order_success.php");
            exit();
        }
    }
}
elseif (isset($_POST['order_placed_online'])) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
       
        $merchantId = 'PGTESTPAYUAT';
        $apiKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399";
        $redirectUrl = 'http://localhost/ariive_ecom/callback.php';
        $callbackUrl = 'http://localhost/ariive_ecom/order_process.php';
        
        // Set transaction details
        $order_id = uniqid();
        $name = $_POST['u_fname'];
        $lname= $_POST['u_lname'];
        $email = $_POST['u_email'];
        $mobile = $_POST['u_number'];
        $amount = 100; // amount in INR        
        $description = 'Payment for Product/Service';
        
        
        $paymentData = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => uniqid(18),
            "merchantUserId" => "MUID123",
            'amount' => $amount,
            'redirectUrl' => $redirectUrl,
            'redirectMode' => "POST",
            'callbackUrl' => $callbackUrl,
            "mercileNumber" => $mobile,
            "meshantOrderId" => $order_id,
            
            "paymentInstrument" => array(
                "type" => "PAY_PAGE",
            )
        );
        
        
        $encode = json_encode($paymentData);
        $encoded = base64_encode($encode);
        
        $key_index = 1; 
        $string = $encoded . "/pg/v1/pay".$apiKey;
        $sha256 = hash("sha256", $string);
        $final_x_header = $sha256 . '###'.$key_index;
        
        //$url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; //<PRODUCTION URL>
        
         $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>
        
        $headers = array(
            "Content-Type: application/json",
            "accept: application/json",
            "X-VERIFY: " . $final_x_header,
        );
        
        $data = json_encode(['request' => $encoded]);
        
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $resp = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($resp);
        
        
        header('Location:' . $response->data->instrumentResponse->redirectInfo->url);
        // header('location : https://ariive.co.in/callback.php');

} else {
    // Handle the case where neither button was clicked
    // You might want to redirect to an error page or handle it accordingly
    echo "Invalid form submission.";
}


?>

