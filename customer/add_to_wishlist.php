<?php
session_start();

$id = $_POST['food_id'];

if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}

$_SESSION['wishlist'][$id] = true;

header("Location: home.php");