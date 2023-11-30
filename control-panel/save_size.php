<?php 
include 'config.php';
if(isset($_POST['submit']))
{
    $size_name     = $_POST['size_name'];
    $sql="INSERT INTO `tbl_size`(size_name) VALUES ('$size_name')";
    if(mysqli_query($conn,$sql))
    {
        $_SESSION['message']='Size Added';
        header('location:size_list.php');

    }else
    {    
        $_SESSION['message']='Server Error Try Again!';
        header('location:size_list.php');
    }
}
elseif(isset($_POST['update_size']))
{
    $size_id       = $_POST['size_id'];
    $size_name     = $_POST['size_name'];
    $size_update=mysqli_query($conn,"UPDATE `tbl_size` SET `size_name`='$size_name' WHERE size_id='$size_id'");
    if($size_update)
    {
        $_SESSION['message']='Size Updated';
        header('location:size_list.php');
    }else
    {
        $_SESSION['message']='Size Updated failed';
        header('location:size_list.php');
    }
}
else
{
    $size_id  = $_GET['id'];
    $sql="DELETE FROM `tbl_size` WHERE size_id='$size_id'";
    if($conn->query($sql)===true)
    {
        $_SESSION['message']='Record have been deleted successfully !';
        header('location:size_list.php');
    }
    else
    {       
        $_SESSION['message']='Your details has been failed ! Try Again';
        header('location:size_list.php');
    }
}
?>