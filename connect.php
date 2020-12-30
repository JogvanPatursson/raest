<?php
// Create connection
$conn = new mysqli('localhost', 'root', 'raest', 'raest_db');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>