<?php
// Database configuration
$db_servername = 'localhost';
$db_username = 'kalafe';
$db_password = 'danikalafe';
$db_database = 'weblog';

$conn = new mysqli($db_servername, $db_username, $db_password, $db_database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// echo "Coxnnected successfully";
?>