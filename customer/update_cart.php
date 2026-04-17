<?php
session_start();
include("../config/database.php");

$user_id = $_SESSION['user']['id'];
$food_id = $_GET['id'];
$action = $_GET['action'];

if($action == 'inc'){
    mysqli_query($connect, 
        "UPDATE cart SET quantity = quantity + 1 
         WHERE user_id='$user_id' AND food_id='$food_id'");
}

if($action == 'dec'){
    mysqli_query($connect, 
        "UPDATE cart SET quantity = quantity - 1 
         WHERE user_id='$user_id' AND food_id='$food_id' AND quantity > 1");
}

header("Location: cart.php");