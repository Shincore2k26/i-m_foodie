<?php
include("../config/database.php");

$id = $_GET['id'];

mysqli_query($connect, "UPDATE users SET status='blocked' WHERE id='$id'");

header("Location: users.php");