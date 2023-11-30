<?php 
session_start();
unset($_SESSION['ADMIN_ACCESS']);
unset($_SESSION['ADMIN_USER_NAME']);
header('location:login.php');
die();
?>