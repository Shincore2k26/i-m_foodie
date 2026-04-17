<?php
include("../config/database.php");

$result = mysqli_query($connect, "SELECT * FROM orders");
?>

<h2>All Orders 📦</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div style="border:1px solid #000; padding:10px;">
    <p>User: <?php echo $row['user_id']; ?></p>
    <p>Total: ₹<?php echo $row['total']; ?></p>
    <p>Status: <?php echo $row['status']; ?></p>
</div>

<?php } ?>