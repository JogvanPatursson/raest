<?php
include('connect.php');

$user_id=$_POST['user_id'];
$item_type=$_POST['item_type'];
$trans_type=$_POST['transaction_type'];
$trans_date=$_POST['transaction_date'];

mysqli_query($conn,"insert into transactions (transaction_type, transaction_date, user_id, item_type) values ('$trans_type', '$trans_date', '$user_id', '$item_type')");
header('location:inventory_transactions.php');
?>
