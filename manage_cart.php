<?php
include './control-panel/config.php';
if (isset($_POST['scope'])) {
    $scope = $_POST['scope'];
    if (isset($_SESSION['auth_user'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $product_id = $_POST['prod_id'];
        $product_qty = $_POST['quantity'];
        $product_size = $_POST['size_id'];

        // Check if the product is already in the cart
        $prod_existing = "SELECT * FROM `tbl_cart` WHERE product_id='$product_id' AND user_id='$user_id'";
        $prod_result = mysqli_query($conn, $prod_existing);

        if (mysqli_num_rows($prod_result) > 0) {
            // Product is already in the cart, update the quantity and size
            $update_size = "UPDATE `tbl_cart` SET `product_qty`='$product_qty',`product_size`='$product_size' WHERE product_id='$product_id' AND user_id='$user_id'";
            if (mysqli_query($conn, $update_size)) {
                echo "600"; // Product updated in cart
                
            } else {
                echo "500"; // Something went wrong during update
            }
        } else {
            // Product is not in the cart, add it
            $query = "INSERT INTO `tbl_cart` (user_id, product_id, product_qty, product_size) VALUES ('$user_id', '$product_id', '$product_qty', '$product_size')";
            if (mysqli_query($conn, $query)) {
                echo "201"; // Product added to cart
                
            } else {
                echo "500"; // Something went wrong during insertion
            }
        }
    } else {
        echo "401"; // User not logged in
    }
} else {
    echo "500"; // Default response for invalid scope
}

?>
