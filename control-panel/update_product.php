<?php 
include 'config.php';

if (isset($_POST['update_product'])) {
    $product_id = get_safe_value($conn, $_POST['product_id']);
    $category_id = get_safe_value($conn, $_POST['category_name']);
    $gender = get_safe_value($conn, $_POST['gender_type']);
    $product_name = get_safe_value($conn, $_POST['product_name']);
    $product_code = get_safe_value($conn, $_POST['product_code']);
    $product_color = get_safe_value($conn, $_POST['product_color']);
    $product_price = get_safe_value($conn, $_POST['product_price']);
    $product_discount = get_safe_value($conn, $_POST['product_discount']);
    $product_desc = get_safe_value($conn, $_POST['product_desc']);

    // Update product details in tbl_product table
    $update_product_query = "UPDATE tbl_product 
                            SET category_id = '$category_id', gender = '$gender', product_name = '$product_name', 
                            product_code = '$product_code', product_color = '$product_color', 
                            product_price = '$product_price', product_discount = '$product_discount', product_desc = '$product_desc' 
                            WHERE prod_id = '$product_id'";
    $update_product_result = mysqli_query($conn, $update_product_query);
   
    if ($update_product_result) {        
        if (isset($_POST['product_id'])) {           
            $product_id = $_POST['product_id'];            
            if (!empty($_POST['product_size']) && !empty($_POST['product_qty'])) {
                $product_size = $_POST['product_size'];
                $product_qty = $_POST['product_qty'];
                $sizeqty_ids = $_POST['sizeqty_id'];                 
                foreach ($product_size as $key => $size_id) {
                    $quantity = $product_qty[$key];
                    
                    if (isset($sizeqty_ids[$key])) {                        
                        $sizeqty_id = $sizeqty_ids[$key];                   
                        
                        $check_size_query = "SELECT sizeqty_id FROM product_size_quantity WHERE size_id = '$size_id' AND product_id = '$product_id' AND sizeqty_id != '$sizeqty_id'";
                        $size_exists_result = mysqli_query($conn, $check_size_query);
                        
                        if (mysqli_num_rows($size_exists_result) > 0) {                           
                            echo "Alert: Size $size_id already exists for this product.<br>";
                            // $_SESSION['meaaseg']='Size Already In Database';
                            
                        } else {                           
                            $update_size_quantity_query = "UPDATE product_size_quantity 
                                SET size_id = '$size_id', quantity = '$quantity'
                                WHERE sizeqty_id = '$sizeqty_id'";
                        }
                    } else {                       
                        $check_size_query = "SELECT sizeqty_id FROM product_size_quantity WHERE size_id = '$size_id' AND product_id = '$product_id'";
                        $size_exists_result = mysqli_query($conn, $check_size_query);
                        
                        if (mysqli_num_rows($size_exists_result) > 0) {                           
                            // echo "Alert: Size $size_id already exists for this product.<br>";
                            // $_SESSION['message']='Size already exists for this product.';
                        } else {                            
                            $update_size_quantity_query = "INSERT INTO product_size_quantity (product_id, size_id, quantity)
                                VALUES ('$product_id', '$size_id', '$quantity')";
                        }
                    }                    
                    $update_result = mysqli_query($conn, $update_size_quantity_query);                    
                    if (!$update_result) {
                        echo "Error updating/inserting size and quantity: " . mysqli_error($conn) . "<br>";
                    }
                }
            }
        }
            // Handle image updates
           if (isset($_POST['existing_images'])) {
            $existingImages = $_POST['existing_images'];
            $updatedImages = $_FILES['updated_images'];
            foreach ($existingImages as $index => $existingImagePath) {
                if (!empty($updatedImages['name'][$index])) {
                    $newImageTmpName = $updatedImages['tmp_name'][$index];
                    $newImageName = uniqid() . '_' . basename($updatedImages['name'][$index]);
                    $uploadDirectory = 'prod_img/';
                    $newImagePath = $uploadDirectory . $newImageName;

                    if (move_uploaded_file($newImageTmpName, $newImagePath)) {
                        $updateImageQuery = "UPDATE tbl_image SET image_path = '$newImagePath' WHERE image_path = '$existingImagePath' AND product_id = '$product_id'";
                        mysqli_query($conn, $updateImageQuery);
                    } else {
                        $_SESSION['message'] = 'Update Failed!';
                        header('location: product_list.php');
                        exit(); // Exit to avoid further processing
                    }
                }
            }
           }
        }

        // Handle new images only if they are uploaded
        if (isset($_FILES['update_new'])) {
            $newImages = $_FILES['update_new'];
            foreach ($newImages['tmp_name'] as $index => $tmpName) {
                if (!empty($newImages['name'][$index])) {
                    $tempFileName = $newImages['tmp_name'][$index];
                    $uploadDirectory = 'prod_img/';
                    $newImageName = uniqid() . '_' . basename($newImages['name'][$index]);
                    $newImagePath = $uploadDirectory . $newImageName;

                    if (move_uploaded_file($tempFileName, $newImagePath)) {
                        $insertImageQuery = "INSERT INTO tbl_image (product_id, image_path) VALUES ('$product_id', '$newImagePath')";
                        mysqli_query($conn, $insertImageQuery);
                    } else {
                        
                    }
                }
            }
        }  
        $_SESSION['message'] = 'Product Details Updated!';
        header("Location: product_list.php");
        exit();
    } else {
        $_SESSION['message'] = 'Update failed. Please try again!';
    }
?>