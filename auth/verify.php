<?php
echo "VERIFY HIT";
include("../config/database.php");

if(!isset($_GET['token'])){
    die("No token provided ❌");
}

$token = $_GET['token'];

// 🔍 FIND USER
$stmt = mysqli_prepare($connect, "SELECT id FROM users WHERE verify_token=?");
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if($user){
    // ✅ UPDATE USER
    $stmt2 = mysqli_prepare($connect, 
        "UPDATE users SET is_verified=1, verify_token=NULL WHERE id=?");
    mysqli_stmt_bind_param($stmt2, "i", $user['id']);
    mysqli_stmt_execute($stmt2);

    echo "Email verified successfully ✅<br>";
    echo "<a href='login.php'>Login Now</a>";
} else {
    echo "Invalid or expired token ❌";
}