<?php
include("../config/database.php");

$users = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM users"));
$orders = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders"));

$revenue = mysqli_fetch_assoc(mysqli_query($connect, 
    "SELECT SUM(total) as total FROM orders"))['total'];
?>

<h2>Analytics 📊</h2>

<p>Total Users: <?php echo $users; ?></p>
<p>Total Orders: <?php echo $orders; ?></p>
<p>Total Revenue: ₹<?php echo $revenue; ?></p>