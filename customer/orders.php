<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$result = mysqli_query($connect, "SELECT * FROM orders WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<!-- HEADER -->
<div class="flex justify-between items-center px-10 py-5 bg-white shadow-md">
    <h2 class="text-2xl font-bold text-yellow-500">📦 My Orders</h2>

    <a href="index.php" class="text-gray-700 hover:text-yellow-500">
        ← Back to Home
    </a>
</div>

<!-- ORDERS SECTION -->
<div class="px-10 py-8 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="bg-white rounded-2xl shadow-md p-5 hover:shadow-xl transition">

    <div class="flex justify-between items-center mb-3">
        <h3 class="font-semibold text-lg">Order #<?php echo $row['id']; ?></h3>

        <!-- STATUS BADGE -->
        <?php 
        $status = strtolower($row['status']);
        $color = "bg-gray-400";

        if($status == "pending") $color = "bg-yellow-400";
        if($status == "completed") $color = "bg-green-500";
        if($status == "cancelled") $color = "bg-red-500";
        ?>

        <span class="text-white text-sm px-3 py-1 rounded-full <?php echo $color; ?>">
            <?php echo ucfirst($row['status']); ?>
        </span>
    </div>

    <p class="text-gray-600 mb-2">
        <strong>Total:</strong> ₹<?php echo $row['total']; ?>
    </p>

    <p class="text-gray-600 mb-4">
        <strong>Address:</strong><br>
        <?php echo $row['address']; ?>
    </p>

    <div class="flex justify-between items-center">
        <span class="text-sm text-gray-400">
            🕒 Order placed
        </span>

        <button class="text-yellow-500 hover:underline text-sm">
            View Details
        </button>
    </div>

</div>

<?php } ?>

</div>

</body>
</html>