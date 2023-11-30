<?php 
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// $x-header =  SHA256("/v3/transaction/{merchantId}/{transactionId}/status" +
// saltKey) + "###" + saltIndex

$base64response = $_POST; // Replace this with your actual base64response
print_r($base64response);echo '</br>';
$saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
$saltIndex = 1;

// Step 1: Concatenate base64response with salt key
$concatenatedString = '$base64response' . $saltKey;

// Step 2: Calculate SHA256 hash
$hashedString = hash('sha256', $concatenatedString);

// Step 3: Concatenate with ### and salt index
$checksum = $hashedString . '###' . $saltIndex;
echo $checksum;

if('72017a38c53ebaf559694e8ac7aea34db59dcbc9ab0e6eeca7db9d5ecabee2f4' == $concatenatedString)
{
    echo 'true';
}else
{
    echo ' false';
}
?>

