<?php
session_start();
include("../config/database.php");

if($_SESSION['user']['role'] != 'retailer'){
    die("Access denied ❌");
}

$retailer_id = $_SESSION['user']['id'];

// Get orders for this retailer
$result = mysqli_query($connect, "
    SELECT orders.*, foods.name 
    FROM orders 
    JOIN foods ON orders.food_id = foods.id
    WHERE foods.retailer_id = '$retailer_id'
");
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>Orders Received 📦</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div style="border:1px solid #000; padding:10px; margin:10px;">
    
    <h3><?php echo $row['name']; ?></h3>
    <p>Total: ₹<?php echo $row['total']; ?></p>
    <p>Address: <?php echo $row['address']; ?></p>
    <p>Status: <b><?php echo $row['status']; ?></b></p>

    <!-- Update status -->
    <form action="update_order.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

        <select name="status">
            <option value="placed">Placed</option>
            <option value="preparing">Preparing</option>
            <option value="out_for_delivery">Out for Delivery</option>
            <option value="delivered">Delivered</option>
        </select>

        <button type="submit">Update</button>
    </form>

</div>

<?php } ?>