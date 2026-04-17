<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// GET USER DATA
$stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-md p-5 space-y-6">

<h2 class="text-lg font-semibold">Edit Profile ✏️</h2>

<form action="update_profile.php" method="POST" class="space-y-4">

  <input type="text" name="name"
    value="<?php echo $user['name']; ?>"
    placeholder="Full Name"
    class="w-full border p-2 rounded-lg" required>

  <input type="email" name="email"
    value="<?php echo $user['email']; ?>"
    class="w-full border p-2 rounded-lg" readonly>

  <input type="text" name="phone"
    value="<?php echo $user['phone'] ?? ''; ?>"
    placeholder="Phone"
    class="w-full border p-2 rounded-lg">

  <input type="text" name="location"
    value="<?php echo $user['location'] ?? ''; ?>"
    placeholder="Location"
    class="w-full border p-2 rounded-lg">

  <button type="submit"
    class="w-full bg-yellow-400 py-2 rounded-lg font-semibold">
    Save Changes
  </button>

</form>

<a href="profile.php" class="block text-center text-sm text-gray-500">
  ← Back to Profile
</a>

</div>

</body>
</html>