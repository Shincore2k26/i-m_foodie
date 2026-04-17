
<?php
session_start();
include("../config/database.php");

$name = $_POST['name'];
$price = $_POST['price'];
$retailer_id = $_SESSION['user']['id'];

// 📸 IMAGE
$image_name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

// 🔐 VALIDATION (ADD HERE ✅)
$allowed = ['jpg', 'jpeg', 'png','webp'];
$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

if(!in_array($ext, $allowed)){
    die("Only JPG, JPEG, PNG ,WEBP files allowed");
}

// (Optional but GOOD) Rename file to avoid duplicates
$new_name = time() . "_" . $image_name;

$upload_path = "../uploads/" . $new_name;

// Move file
move_uploaded_file($tmp_name, $upload_path);

// INSERT
mysqli_query($connect, "INSERT INTO foods (name, price, image, retailer_id) 
VALUES ('$name', '$price', '$new_name', '$retailer_id')");

header("Location: dashboard.php");
exit();