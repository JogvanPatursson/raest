<?php
include('connect.php');

// Initialize variables from POST
$user_id=$_POST['user_id'];
$item_type=mb_convert_case($_POST['item_type'], MB_CASE_TITLE);
$trans_type=$_POST['transaction_type'];
$trans_date=$_POST['transaction_date'];

// Prepare SQL INSERT statement
mysqli_query($conn,"insert into transactions (trans_type, trans_date, user_id, item_type) values ('$trans_type', '$trans_date', '$user_id', '$item_type')");

// Return to inventory_transactions.php
header('location:inventory_transactions.php');
?>
