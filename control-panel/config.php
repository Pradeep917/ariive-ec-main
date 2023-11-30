<?php
session_start();
include 'function.php';
$servername ="localhost";
$username ="root";
$dbpassword ="";
$dbname ="ariivetest";

// Create connection
$conn = mysqli_connect($servername, $username,$dbpassword, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>