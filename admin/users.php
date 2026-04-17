<?php
include("../config/database.php");

$result = mysqli_query($connect, "SELECT * FROM users");
?>

<h2>Users 👤</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div style="border:1px solid #000; margin:10px; padding:10px;">
    <p><?php echo $row['name']; ?> (<?php echo $row['role']; ?>)</p>

    <a href="block_user.php?id=<?php echo $row['id']; ?>">🚫 Block</a>
</div>

<?php } ?>