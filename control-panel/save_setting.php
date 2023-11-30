<?php 
include 'config.php';
if (isset($_POST['setting_update'])) {      

    $setting_id = $_POST['setting_id']; 
    $title = $_POST['title']; 
    $meta_title = $_POST['meta_title']; 
    $meta_description = $_POST['meta_description'];
    $copyright = $_POST['copyright']; 
   
    if ($_FILES['update_image']['size'] > 0) {
       
        $temp_file = $_FILES['update_image']['tmp_name']; 
        $file_name = $_FILES['update_image']['name']; 
        $file_destination = "images/" . $file_name;
       
        $existing_image = $_POST['exiting_image']; 
        if (file_exists($existing_image)) {
            unlink($existing_image);
        }
        
        if (move_uploaded_file($temp_file, $file_destination)) {            
            $update_image_query = "UPDATE web_setting SET web_logo = '$file_destination' WHERE setting_id = $setting_id";
            mysqli_query($conn, $update_image_query);
        } else {            
            echo "Error: Unable to move the uploaded file.";
        }
    }   
    $update_settings_query = "UPDATE web_setting SET title = '$title', meta_title = '$meta_title', meta_description = '$meta_description', copyright = '$copyright' WHERE setting_id = $setting_id";

    if (mysqli_query($conn, $update_settings_query)) {      
        $_SESSION['message'] = 'Settings updated successfully!';
        header('location: website_setttin.php');
    } else {        
        $_SESSION['message'] = 'Failed to update settings. Please try again.';
        header('location: website_setttin.php');
    }   
    mysqli_close($conn);
}
?>




