<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$location = trim($_POST['location']);

// VALIDATION
if(empty($name)){
    die("Name is required ❌");
}

// UPDATE (SECURE)
$stmt = mysqli_prepare($connect, 
    "UPDATE users SET name=?, phone=?, location=? WHERE id=?");

mysqli_stmt_bind_param($stmt, "sssi", $name, $phone, $location, $user_id);
mysqli_stmt_execute($stmt);

// UPDATE SESSION ALSO
$_SESSION['user']['name'] = $name;

// REDIRECT
header("Location: profile.php");
exit();