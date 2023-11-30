<?php
include 'config.php';
if (isset($_POST['img_id'])) {
    $imageId = $_POST['img_id'];    

    // Construct the SQL query to delete the image by ID
    $sql = "DELETE FROM tbl_image WHERE img_id = '$imageId'";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        echo "success"; // Image deleted successfully
    } else {
        echo "error"; // Image deletion failed
    }
} else {
    echo "error"; // If parameters are not set properly
}

mysqli_close($conn);
?>