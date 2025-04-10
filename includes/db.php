<?php
// includes/db.php

$host = 'localhost';
$user = 'root';
$password = 'gojo@satoru'; 
$database = 'quiz_app';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
