<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'retailer'){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>Welcome Retailer: <?php echo $user['name']; ?></h2>

<hr>

<ul>
    <li><a href="add_food.php">➕ Add Food Item</a></li>
    <a href="orders.php">📦 Manage Orders</a>
    <li><a href="orders.php">📦 Orders</a></li>
    <li><a href="logout.php">🚪 Logout</a></li>
</ul>