<?php
include('connect.php');

$id=$_GET['id'];

$user_id=$_POST['user_id'];
$item_type=$_POST['item_type'];
$trans_type=$_POST['transaction_type'];
$trans_date=$_POST['transaction_date'];

mysqli_query($conn,"update transactions set transaction_type='$trans_type', transaction_date='$trans_date', user_id='$user_id', item_type='$item_type' where transaction_id='$id'");
header('location:inventory_transactions.php');

?>