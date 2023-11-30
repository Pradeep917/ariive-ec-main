<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id       = get_safe_value($conn, $_POST['category_name']);
    $gender            = get_safe_value($conn, $_POST['gender_type']);
    $product_name      = get_safe_value($conn, $_POST['product_name']);
    $product_code      = get_safe_value($conn, $_POST['product_code']);
    $product_color     = get_safe_value($conn, $_POST['product_color']);
    $product_price     = get_safe_value($conn, $_POST['product_price']);
    $product_discount  = get_safe_value($conn, $_POST['product_discount']);
    $product_desc      = get_safe_value($conn, $_POST['product_desc']);

    $insert_product_query = "INSERT INTO tbl_product (category_id, gender, product_name, product_code, 	product_color, product_price, product_discount, product_desc)
                            VALUES ('$category_id', '$gender', '$product_name', '$product_code', '$product_color', '$product_price', '$product_discount', '$product_desc')";

    if (mysqli_query($conn, $insert_product_query)) {
        $product_id = mysqli_insert_id($conn); 
        if (!empty($_POST['product_size']) && !empty($_POST['product_qty'])) {
            $product_size = $_POST['product_size'];
            $product_qty = $_POST['product_qty'];

            foreach ($product_size as $key => $size_id) {
                $quantity = $product_qty[$key];
                $insert_size_quantity_query = "INSERT INTO product_size_quantity (product_id, size_id, quantity)
                                            VALUES ('$product_id', '$size_id', '$quantity')";
                mysqli_query($conn, $insert_size_quantity_query);
            }
        }
        $image_folder = 'prod_img/';
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        foreach ($_FILES['Product_Images']['tmp_name'] as $key => $tmp_name) {
            $image_name = $_FILES['Product_Images']['name'][$key];
            $image_temp = $_FILES['Product_Images']['tmp_name'][$key];

            $file_info = pathinfo($image_name);
            $file_extension = strtolower($file_info['extension']);

            if (in_array($file_extension, $allowed_extensions)) {
                $new_image_name = $product_id . '_' . $key . '.' . $file_extension;
                $destination = $image_folder . $new_image_name;

                move_uploaded_file($image_temp, $destination);
                $insert_image_query = "INSERT INTO tbl_image (product_id, image_path)
                                    VALUES ('$product_id', '$destination')";
                mysqli_query($conn, $insert_image_query);
            }
        }       
        $_SESSION['message'] = 'Product Inserted !';
        header('Location: product_list.php');
        exit();
    } else {       
        echo 'Error: ' . mysqli_error($conn);
    }   
    mysqli_close($conn);
}else{
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $sql_product_size_quantity = "DELETE FROM product_size_quantity WHERE product_id = '$product_id'";    
        $sql_product = "DELETE FROM tbl_product WHERE prod_id = '$product_id'";
        $sql_images = "DELETE FROM tbl_image WHERE product_id = '$product_id'";    
        if (mysqli_query($conn, $sql_product_size_quantity) && mysqli_query($conn, $sql_product) && mysqli_query($conn, $sql_images)) {
            $_SESSION['message'] = 'Product have been deleted successfully!';
            header('location: product_list.php');
        } else {
            // Deletion failed
            $_SESSION['message'] = 'Deletion failed! Please try again.';
            header('location: product_list.php');
        }
    } else {
        
        $_SESSION['message'] = 'Invalid parameter. Please try again.';
        header('location: product_list.php');
    }    
    mysqli_close($conn);    
}
