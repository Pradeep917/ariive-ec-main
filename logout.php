<?php 
// include './control-panel/config.php';
// unset($_SESSION['user_id']);
// unset($_SESSION['user_name']);
// session_destroy();
// header('location:index.php');
// $_SESSION['message'] = 'Now You Are Log Out !';


include './control-panel/config.php';
include 'login_with_google.php';
unset($_SESSION['auth']);
unset($_SESSION['auth_user']);
$google_client->revokeToken();
session_destroy();
$_SESSION['message'] = 'Now You Are Logged Out !';
header('location:index.php');
?>