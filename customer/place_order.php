<?php
session_start();
include("../config/database.php");

$user_id = $_SESSION['user']['id'];
$food_id = $_POST['food_id'];
$total = $_POST['total'];
$address = $_POST['address'];

$status = "placed";

mysqli_query($connect, "INSERT INTO orders (user_id, food_id, total, address, status)
VALUES ('$user_id', '$food_id', '$total', '$address', '$status')");

header("Location: orders.php");
exit();