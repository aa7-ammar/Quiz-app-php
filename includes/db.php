<?php
// includes/db.php

$host = 'sql209.infinityfree.com';
$user = 'if0_38717227';
$password = '5ucLXFooW1jG5'; 
$database = 'if0_38717227_quiz';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
