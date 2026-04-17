<?php
session_start();
include("../config/database.php");

$user_id = $_SESSION['user']['id'];
$food_id = $_POST['food_id'];

// Check if already in cart
$check = mysqli_query($connect, 
    "SELECT * FROM cart WHERE user_id='$user_id' AND food_id='$food_id'");

if(mysqli_num_rows($check) > 0){
    // Increase quantity
    mysqli_query($connect, 
        "UPDATE cart SET quantity = quantity + 1 
         WHERE user_id='$user_id' AND food_id='$food_id'");
} else {
    // Insert new
    mysqli_query($connect, 
        "INSERT INTO cart (user_id, food_id, quantity) 
         VALUES ('$user_id', '$food_id', 1)");
}

header("Location: home.php");
exit();