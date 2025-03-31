<?php
// InfinityFree database credentials
$host = "sql313.infinityfree.com";  
$username = "if0_38641798"; 
$password = "2wi0XKZJkkiO"; 
$dbname = "if0_38641798";

$con = mysqli_connect($host, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
