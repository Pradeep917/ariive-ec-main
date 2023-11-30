<?php 
include 'config.php';
if(isset($_POST['submit']))
{
    $cat_name     = $_POST['cat_name'];
    $check_sql = "SELECT * FROM `category` WHERE cat_name = '$cat_name'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {       
        $_SESSION['message'] = 'Category already exists in the database.';
        header('location: category_list.php');
    }else
    {
        $sql="INSERT INTO `category`(cat_name) VALUES ('$cat_name')";
        if(mysqli_query($conn,$sql))
        {
            $_SESSION['message']='Category Added';
            header('location:category_list.php');

        }else
        {    
            $_SESSION['message']='Server Error !';
            header('location:category_list.php');
        }
    }
}
elseif(isset($_POST['cat_update'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    // Check if the category name already exists in the database except for the current row
    $check_sql = "SELECT * FROM `category` WHERE cat_name = '$cat_name' AND cat_id != '$cat_id'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // Category name already exists for another row, show an alert message
        $_SESSION['message'] = 'Category name already exists in the database.';
        header('location: category_list.php');
    } else {
        // Update the category name for the current row
        $category_update = mysqli_query($conn, "UPDATE `category` SET `cat_name`='$cat_name' WHERE cat_id='$cat_id'");
        
        if ($category_update) {
            $_SESSION['message'] = 'Category Updated';
            header('location: category_list.php');
        } else {
            $_SESSION['message'] = 'Category Update failed';
            header('location: category_list.php');
        }
    }
}
else
{
    $category_id  = $_GET['id'];
    $sql="DELETE FROM `category` WHERE cat_id='$category_id'";
    if($conn->query($sql)===true)
    {
        $_SESSION['message']='Record have been deleted successfully !';
        header('location:category_list.php');
    }
    else
    {
     
        $_SESSION['message']='Your details has been failed ! Try Again';
        header('location:category_list.php');
    }
}
?>