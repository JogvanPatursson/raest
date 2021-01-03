<?php
include('connect.php');

// Initialize variables from POST
$id=$_GET['id'];

// Prepare SQL DELETE statement
mysqli_query($conn,"delete from transactions where trans_id='$id'");

// Return to inventory_transactions.php
header('location:inventory_transactions.php');
?>
