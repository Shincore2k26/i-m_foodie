<?php
session_start();
include("../config/database.php");

$email = trim($_POST['email']);
$password = $_POST['password'];

// 🔒 VALIDATION
if(empty($email) || empty($password)){
    die("All fields required ❌");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Invalid email format ❌");
}

// ✅ PREPARED STATEMENT
$stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE email=?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

// 🔒 CHECK USER
if($user){

    // 🔐 PASSWORD CHECK
    if(password_verify($password, $user['password'])){

        // 🔐 SESSION SECURITY
        session_regenerate_id(true);

        $_SESSION['user'] = $user;

        // 🎯 ROLE REDIRECT
        if($user['role'] == 'customer'){
            header("Location: ../customer/home.php");
        }
        elseif($user['role'] == 'retailer'){
            header("Location: ../retailer/dashboard.php");
        }
        else{
            header("Location: ../admin/dashboard.php");
        }
        exit();

    } else {
        die("Wrong Password ❌");
    }

} else {
    die("User not found ❌");
}