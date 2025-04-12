<?php
// Database configuration
$servername = 'localhost';
$username = 'kalafe';
$password = 'danikalafe';
$database = 'weblog';

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_err){
    die("Connection failed: " . $conn->connect_err);
}

// echo "Connected successfully";
?>