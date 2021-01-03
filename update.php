<?php
include('connect.php');

// Initialize variables from POST
$id=$_GET['id'];
$user_id=$_POST['user_id'];
$item_type=mb_convert_case($_POST['item_type'], MB_CASE_TITLE);
$trans_type=$_POST['transaction_type'];
$trans_date=$_POST['transaction_date'];

// Prepare SQL DELETE statement
mysqli_query($conn,"update transactions set trans_type='$trans_type', trans_date='$trans_date', user_id='$user_id', item_type='$item_type' where trans_id='$id'");

// Return to inventory_transactions.php
header('location:inventory_transactions.php');

?>
