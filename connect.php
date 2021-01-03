<?php
// Create connection
$conn = new mysqli('localhost', 'raest', 'raest', 'raest_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
