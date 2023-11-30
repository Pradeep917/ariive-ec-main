<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$merchantId = 'ARIIVEONLINE';
$apiKey = "3fee47f0-70d1-4155-acdf-606f545ba8e3";
$redirectUrl = 'https://ariive.co.in/callback.php';
$callbackUrl = 'https://ariive.co.in/order_process.php';

// Set transaction details
$order_id = uniqid();
$name = $_POST['u_fname'] . ' ' . $_POST['u_lname'];
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
    "mobsage" => $description,
    "email" => $email,
    "shortName" => $name,
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

$url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; //<PRODUCTION URL>

// $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>

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
