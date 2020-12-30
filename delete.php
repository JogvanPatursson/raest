<?php
include('connect.php');
$id=$_GET['id'];

mysqli_query($conn,"delete from transactions where transaction_id='$id'");
header('location:inventory_transactions.php');
?>