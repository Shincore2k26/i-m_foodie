<?php
session_start();
include("../config/database.php");

// ✅ CHECK LOGIN
if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
$user_id = $user['id'];

// ✅ GET FRESH USER DATA
$stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// ✅ GET USER ORDERS
$orders = mysqli_query($connect, 
    "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-md p-5 space-y-6">

<!-- PROFILE HEADER -->
<div class="flex items-center space-x-4">
  <img src="https://i.pravatar.cc/100" class="w-16 h-16 rounded-full">

  <div>
    <h2 class="text-lg font-semibold"><?php echo $user['name']; ?></h2>
    <p class="text-sm text-gray-500"><?php echo $user['email']; ?></p>
  </div>
</div>

<!-- EDIT BUTTON -->
<a href="edit_profile.php" 
   class="block text-center border rounded-lg py-2 text-sm font-medium hover:bg-gray-50">
   Edit Profile
</a>

<!-- ACCOUNT INFO -->
<div class="bg-gray-50 rounded-xl p-5 space-y-4 text-sm">

  <div class="flex justify-between border-b pb-2">
    <span class="text-gray-500">Full Name</span>
    <span class="font-medium"><?php echo $user['name']; ?></span>
  </div>

  <div class="flex justify-between border-b pb-2">
    <span class="text-gray-500">Email</span>
    <span class="font-medium"><?php echo $user['email']; ?></span>
  </div>

  <div class="flex justify-between border-b pb-2">
    <span class="text-gray-500">Phone</span>
    <span class="font-medium">
      <?php echo $user['phone'] ?? 'Not added'; ?>
    </span>
  </div>

  <div class="flex justify-between border-b pb-2">
    <span class="text-gray-500">Location</span>
    <span class="font-medium">
      <?php echo $user['location'] ?? 'Not added'; ?>
    </span>
  </div>

  <div class="flex justify-between">
    <span class="text-gray-500">Member Since</span>
    <span class="font-medium">
      <?php echo date("d M Y", strtotime($user['create_at'])); ?>
    </span>
  </div>

</div>

<!-- ORDERS -->
<div>
  <div class="flex justify-between items-center mb-2">
    <h3 class="font-semibold">Recent Orders</h3>
    <a href="orders.php" class="text-blue-500 text-sm">View All</a>
  </div>

  <div class="space-y-3 text-sm">

  <?php while($row = mysqli_fetch_assoc($orders)){ ?>

    <div class="p-3 bg-gray-50 rounded-lg flex justify-between">
      <div>
        <p class="font-medium">Order #<?php echo $row['id']; ?></p>
        <p class="text-gray-500 text-xs">
          <?php echo date("d M Y", strtotime($row['created_at'] ?? 'now')); ?>
        </p>
      </div>

      <span class="
        <?php
          if($row['status']=='delivered') echo 'text-green-600';
          elseif($row['status']=='preparing') echo 'text-yellow-600';
          else echo 'text-blue-600';
        ?>
        font-medium">
        <?php echo ucfirst($row['status']); ?>
      </span>
    </div>

  <?php } ?>

  </div>
</div>

<!-- SETTINGS -->
<div class="space-y-2 text-sm">
  <button class="w-full text-left p-3 bg-gray-50 rounded-lg">
    Account Settings
  </button>
  <button class="w-full text-left p-3 bg-gray-50 rounded-lg">
    Privacy & Security
  </button>
</div>

<!-- LOGOUT -->
<a href="../auth/logout.php"
   class="block text-center py-2 rounded-lg border border-red-500 text-red-500 hover:bg-red-50">
   Logout
</a>

</div>

</body>
</html>