<?php
include("../config/config.php");
include("../config/database.php");

// ✅ GET DATA FIRST
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$role = $_POST['role'];

// 🔒 VALIDATION
if(empty($name) || empty($email) || empty($password)){
    die("All fields required");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Invalid email format");
}

if(strlen($password) < 6){
    die("Password must be at least 6 characters");
}

// 🔐 HASH PASSWORD
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 🔍 CHECK IF EMAIL EXISTS
$check = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){
    die("Email already exists ❌");
}

// ✅ INSERT USER FIRST
mysqli_query($connect, "INSERT INTO users (name, email, password, role)
VALUES ('$name', '$email', '$hashed_password', '$role')");

// ==============================
// 📧 NOW SEND EMAIL (AFTER INSERT)
// ==============================

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'soni.singh28032004@gmail.com';
    $mail->Password = '2k26is_mine';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('soni.singh28032004@gmail.com', 'Foodie Support');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Welcome to Foodie 🎉';
    $mail->Body = "
    <h3>Hello $name 👋</h3>
    <p>Your account has been created successfully!</p>
    <p>You can now login and start ordering 🍔</p>
    ";

    $mail->send();

} catch (Exception $e) {
    echo "Mail Error: {$mail->ErrorInfo}";
}

// ✅ FINAL REDIRECT
if($mail->send()){
    header("Location: " . BASE_URL . "auth/login.php");
    echo "Registration successful ✅<br>";

    exit();
} else {
    echo "Email sending failed ❌";
}