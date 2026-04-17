<?php
session_start();
include("../config/database.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'customer'){
    header("Location: ../auth/login.php");
    exit();
}

$search = $_GET['search'] ?? '';

if($search){
    $result = mysqli_query($connect, 
        "SELECT * FROM foods WHERE name LIKE '%$search%'");
} else {
    $result = mysqli_query($connect, "SELECT * FROM foods");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Foodie</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50 font-sans">

<!-- NAVBAR -->
<header class="sticky top-0 z-50 flex justify-between items-center px-10 py-4 bg-white shadow-md">

  <h1 class="text-2xl font-bold text-yellow-500">🍔 Foodie</h1>

  <form method="GET" class="w-1/3">
      <input type="text" name="search" placeholder="Search food..."
             class="w-full px-4 py-2 rounded-full border focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </form>

  <div class="flex items-center gap-6 text-gray-700 font-medium">
    <a href="#" class="hover:text-yellow-500">Home</a>
    <a href="orders.php" class="hover:text-yellow-500">📦 Orders</a>
    <a href="wishlist.php" class="hover:text-yellow-500">💗 Wishlist</a>
    <a href="profile.php" class="hover:text-yellow-500">Profile</a>
  </div>

</header>

<!-- HERO SECTION -->
<section class="px-10 mt-8">
  <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-3xl p-10 text-white flex justify-between items-center shadow-lg">

    <div>
      <h2 class="text-5xl font-extrabold leading-tight">
        Delicious Food<br>Delivered Fast 🚀
      </h2>
      <p class="mt-4 text-lg opacity-90">
        Explore the best meals from top restaurants
      </p>
    </div>

    <img src="https://cdn-icons-png.flaticon.com/512/5787/5787016.png"
         class="w-40 hidden md:block">
  </div>
</section>

<!-- FOOD SECTION TITLE -->
<div class="px-10 mt-10">
  <h2 class="text-2xl font-bold text-gray-800">Popular Dishes 🍽️</h2>
</div>

<!-- FOOD CARDS -->
<section class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-10 mt-6 mb-10">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">

  <img src="../uploads/<?php echo $row['image']; ?>"
       class="h-44 w-full object-cover">

  <div class="p-4">

    <h3 class="font-semibold text-lg"><?php echo $row['name']; ?></h3>

    <p class="text-yellow-500 font-bold text-lg mt-1">
      ₹<?php echo $row['price']; ?>
    </p>

    <!-- WISHLIST BUTTON -->
<form action="add_to_wishlist.php" method="POST">
    <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">

    <button class="mt-2 w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full transition">
        ❤️ Add to Wishlist
    </button>
</form>

<!-- ORDER BUTTON -->
<form action="checkout.php" method="POST">
    <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">

    <button class="mt-2 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-full w-full transition">
        Order Now
    </button>
</form>

  </div>

</div>

<?php } ?>

</section>

</body>
</html>