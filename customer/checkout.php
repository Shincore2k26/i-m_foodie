<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit();
}

$food_id = $_POST['food_id'];
$price = $_POST['price'];

// Fetch food details
$res = mysqli_query($connect, "SELECT * FROM foods WHERE id='$food_id'");
$food = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<!-- HEADER -->
<div class="flex justify-between items-center px-10 py-5 bg-white shadow-md">
    <h2 class="text-2xl font-bold text-yellow-500">🧾 Checkout</h2>

    <a href="index.php" class="text-gray-700 hover:text-yellow-500">
        ← Back
    </a>
</div>

<!-- MAIN -->
<div class="grid md:grid-cols-2 gap-10 px-10 py-10">

    <!-- LEFT: FOOD DETAILS -->
    <div class="bg-white rounded-2xl shadow-md p-6">

        <img src="../uploads/<?php echo $food['image']; ?>"
             class="rounded-xl mb-4 h-52 w-full object-cover">

        <h3 class="text-xl font-bold"><?php echo $food['name']; ?></h3>

        <p class="text-yellow-500 text-lg font-semibold mt-2">
            ₹<?php echo $food['price']; ?>
        </p>

        <p class="text-gray-500 mt-2">
            Delicious food prepared with fresh ingredients 🍽️
        </p>

    </div>

    <!-- RIGHT: FORM -->
    <div class="bg-white rounded-2xl shadow-md p-6">

        <h3 class="text-lg font-semibold mb-4">Delivery Details</h3>

        <form action="place_order.php" method="POST">

            <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
            <input type="hidden" name="total" value="<?php echo $price; ?>">

            <label class="block text-gray-600 mb-2">Delivery Address</label>

            <textarea name="address" required
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Enter your full address..."></textarea>

            <button type="submit"
                class="mt-6 w-full bg-yellow-400 hover:bg-yellow-500 text-white py-3 rounded-full font-semibold transition">
                Place Order ✅
            </button>

        </form>

    </div>

</div>

</body>
</html>