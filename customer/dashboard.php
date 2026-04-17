<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}
include("../config/database.php");

$result = mysqli_query($connect, "SELECT * FROM foods");
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>Food Menu</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div>
        <h3><?php echo $row['name']; ?></h3>
        <p>₹<?php echo $row['price']; ?></p>

        <form action="cart.php" method="POST">
            <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Add to Cart</button>
            <a href="../auth/logout.php">Logout</a>
        </form>
    </div>
<?php } ?>