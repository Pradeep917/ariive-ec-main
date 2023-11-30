<?php 
include './control-panel/config.php';
function get_safe_value($conn,$str)
{
    if($str!='')
    {
        return mysqli_real_escape_string($conn,$str);
    }
}
if(isset($_POST['submit']))
{
    $name = get_safe_value($conn, $_POST['Name']);    
    $email = get_safe_value($conn, $_POST['Email']);
    $number = get_safe_value($conn, $_POST['Number']);
    $subject = get_safe_value($conn, $_POST['Subject']);
    $message = get_safe_value($conn, $_POST['Message']);
    $insert_enq=mysqli_query($conn, "INSERT INTO `customer_enquery`(`c_name`, `c_email`, `c_number`, `c_subject`, `c_message`) VALUES ('$name','$email','$number','$subject','$message')");    
    if($insert_enq)
    {
        $_SESSION['message']='Thankyou For Enquiry Our Team Contact You Soon !';
        header('location: contact.php');
    }else
    {
        $_SESSION['message']='Server Error Try Again !';
        header('location: contact.php');
    }
}
?>