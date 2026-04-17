<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>Add Food Item</h2>

<form action="add_food_process.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required><br><br>    
    <input type="text" name="name" placeholder="Food Name" required><br><br>
    
    <input type="number" name="price" placeholder="Price" required><br><br>

    <button type="submit">Add Food</button>

</form>