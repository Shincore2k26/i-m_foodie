<?php
session_start();
include("../config/database.php");

$user_id = $_SESSION['user']['id'];
$food_id = $_GET['id'];

mysqli_query($connect, 
    "DELETE FROM cart WHERE user_id='$user_id' AND food_id='$food_id'");

header("Location: cart.php");