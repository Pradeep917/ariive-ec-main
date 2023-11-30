<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('phonepe_lib/vendor/autoload.php');


// Your PhonePe API endpoint
$apiEndpoint = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay'; // Replace with the actual endpoint

// Your API credentials
$merchantId = 'YOUR_MERCHANT_ID';
$apiKey = 'YOUR_API_KEY';


try {

     $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', $apiEndpoint, [
      'headers' => [
        'Content-Type' => 'application/json',
        'accept' => 'application/json',
      ],

        'data' => [
          "merchantId"=> "PGTESTPAYUAT",
          "merchantTransactionId"=> "MT7850590068188104",
          "merchantUserId"=> "MUID123",
          "amount"=> 10000,
          "redirectUrl"=> "https://webhook.site/redirect-url",
          "redirectMode"=> "REDIRECT",
          "callbackUrl"=> "https://webhook.site/callback-url",
          "mobileNumber"=> "9999999999",
          "paymentInstrument"=> [
            "type"=> "PAY_PAGE"
          ],
          
        ],
        'auth' => [
            $merchantId, // Username/Merchant ID
            $apiKey,     // Password/API Key
            // You might need to modify this depending on the API requirements
               ]
         ]);




  
    // Get the response body as a string
    $body = $response->getBody()->getContents();

    // Handle the API response (e.g., parse JSON, process data)
    // Example:
    $responseData = json_decode($body, true);
    var_dump($responseData); // Process the response as needed

} catch (RequestException $e) {
    // Handle request errors (e.g., connection issue, 4xx/5xx status codes)
    echo "Request failed: " . $e->getMessage();
}
