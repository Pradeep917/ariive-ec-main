<?php 
include 'config.php';
$cus_id  = $_GET['id'];
    $sql="DELETE FROM `customer_enquery` WHERE cus_id='$cus_id'";
    if($conn->query($sql)===true)
    {
        $_SESSION['message']='Record have been deleted successfully !';
        header('location:custome_list.php');
    }
    else
    {       
        $_SESSION['message']='Your details has been failed ! Try Again';
        header('location:custome_list.php');
    }
?>