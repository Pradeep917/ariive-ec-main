<?php 
include 'config.php';
if(isset($_POST['submit']))
{
    $color_name     = $_POST['color_name'];

    $check_sql = "SELECT * FROM `tbl_color` WHERE color_name = '$color_name'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Color name already exists, show an alert message
        $_SESSION['message'] = 'Color already exists in the database.';
        header('location: color_list.php');
    }else
    {
        $sql="INSERT INTO `tbl_color`(color_name) VALUES ('$color_name')";
        if(mysqli_query($conn,$sql))
        {
            $_SESSION['message']='Color Added';
            header('location:color_list.php');

        }else
        {    
            $_SESSION['message']='Server Error Try Again!';
            header('location:color_list.php');
        }
    }
}

elseif(isset($_POST['update_color'])) {
    $color_id = $_POST['color_id'];
    $color_name = $_POST['color_name'];

    // Check if the color name already exists in the database except for the current row
    $check_sql = "SELECT * FROM `tbl_color` WHERE color_name = '$color_name' AND color_id != '$color_id'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Color name already exists for another row, show an alert message
        $_SESSION['message'] = 'Color already exists in the database.';
        header('location: color_list.php');
    } else {
        // Update the color name for the current row
        $color_update = mysqli_query($conn, "UPDATE `tbl_color` SET `color_name`='$color_name' WHERE color_id='$color_id'");
        
        if ($color_update) {
            $_SESSION['message'] = 'Color Updated';
            header('location: color_list.php');
        } else {
            $_SESSION['message'] = 'Color Update failed';
            header('location: color_list.php');
        }
    }
}

else
{
    $color_id  = $_GET['id'];
    $sql="DELETE FROM `tbl_color` WHERE color_id='$color_id'";
    if($conn->query($sql)===true)
    {
        $_SESSION['message']='Record have been deleted successfully !';
        header('location:color_list.php');
    }
    else
    {       
        $_SESSION['message']='Your details has been failed ! Try Again';
        header('location:color_list.php');
    }
}
?>