<?php
include './control-panel/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist_id'])) {
    $wishlistId = $_POST['wishlist_id'];

    // Perform the deletion in the database
    $deleteSql = "DELETE FROM tbl_wishlist WHERE wishlist_id = $wishlistId";
    // Execute the query

    // Assuming your database connection variable is $conn
    if (mysqli_query($conn, $deleteSql)) {
        echo 'success'; // Return 'success' on successful deletion
    } else {
        echo 'error'; // Return 'error' if there was an issue with deletion
    }
}
?>