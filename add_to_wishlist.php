<?php
include './control-panel/config.php';
$product_id=$_GET['product_id'];
if (isset($_SESSION['auth_user'])) {
    if (isset($_GET['product_id'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $product_id = $_GET['product_id']; // Get the product ID from the URL
        
        // Check if the item already exists in the wishlist for the user
        $check_query = "SELECT * FROM tbl_wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['message'] = 'Item is already in your wishlist';
            header('Location: product-details.php?id=' . $product_id); // Redirect back to the product details page
            exit();
        } else {
            // If the item is not in the wishlist, add it
            $insert_query = "INSERT INTO tbl_wishlist (user_id, product_id, created_at) VALUES ('$user_id', '$product_id', NOW())";
            $insert_result = mysqli_query($conn, $insert_query);
            
            if ($insert_result) {
                $_SESSION['message'] = 'Product added to wishlist!';
            } else {
                $_SESSION['message'] = 'Failed to add the product to your wishlist.';
            }
            
            header('Location: product-details.php?id=' . $product_id); // Redirect back to the product details page
           
            exit();
        }
    }
} else {
    $_SESSION['message'] = 'Login To Continue';
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>