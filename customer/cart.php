<?php
session_start();
include("../config/database.php");

$user_id = $_SESSION['user']['id'];

$result = mysqli_query($connect, "
    SELECT foods.*, cart.quantity 
    FROM cart 
    JOIN foods ON cart.food_id = foods.id
    WHERE cart.user_id = '$user_id'
");

$total = 0;
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>🛒 Your Cart</h2>

<?php while($row = mysqli_fetch_assoc($result)){ 
    $item_total = $row['price'] * $row['quantity'];
    $total += $item_total;
?>

<div style="border:1px solid #000; margin:10px; padding:10px;">
    <h3><?php echo $row['name']; ?></h3>
    <p>Price: ₹<?php echo $row['price']; ?></p>
    <p>Quantity: <?php echo $row['quantity']; ?></p>
    <p>Total: ₹<?php echo $item_total; ?></p>

    <!-- ➕ Increase -->
    <a href="update_cart.php?id=<?php echo $row['id']; ?>&action=inc">➕</a>

    <!-- ➖ Decrease -->
    <a href="update_cart.php?id=<?php echo $row['id']; ?>&action=dec">➖</a>

    <!-- ❌ Remove -->
    <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">Remove</a>
</div>

<?php } ?>

<h3>Grand Total: ₹<?php echo $total; ?></h3>