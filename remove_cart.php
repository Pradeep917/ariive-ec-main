<?php
include './control-panel/config.php';
// if (isset($_POST['productID'])) {
//     $productID = $_POST['productID'];
//     if (isset($_SESSION['auth_user']['user_id'])) {
//         $user_id = $_SESSION['auth_user']['user_id'];
//         $sql = "SELECT user_id FROM tbl_cart WHERE product_id = $productID";
//         $result = mysqli_query($conn, $sql);
//         if ($result) {
//             $row = mysqli_fetch_assoc($result);
//             if ($row['user_id'] == $user_id) {
//                 $delete_sql = "DELETE FROM tbl_cart WHERE product_id = $productID AND user_id = $user_id";
//                 if (mysqli_query($conn, $delete_sql)) {
//                     echo 'success'; 
//                 } else {
//                     echo 'error';
//                 }
//             } else {
//                 echo 'error'; 
//             }
//         } else {
//             echo 'error';
//         }      
//     } else {
//         echo 'error'; 
//     }
// }

    // Now i am adding the new code becouse fetching the issu to deleting item from the cart

if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];

    if (isset($_SESSION['auth_user']['user_id'])) {
        $user_id = $_SESSION['auth_user']['user_id'];

        // Use prepared statement to prevent SQL injection
        $sql = "DELETE FROM tbl_cart WHERE product_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $productID, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                echo 'success';
            } else {
                echo 'error';
            }

            mysqli_stmt_close($stmt);
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}

?>
