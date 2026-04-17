<?php
session_start();
include("../config/database.php");

$order_id = $_POST['order_id'];
$status = $_POST['status'];

mysqli_query($connect, 
    "UPDATE orders SET status='$status' WHERE id='$order_id'");

header("Location: orders.php");
exit();