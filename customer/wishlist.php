<?php
session_start();
include("../config/database.php");

$wishlist = $_SESSION['wishlist'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Wishlist</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<!-- HEADER -->
<div class="flex justify-between items-center px-10 py-5 bg-white shadow-md">
    <h2 class="text-2xl font-bold text-pink-500">💗 My Wishlist</h2>

    <a href="index.php" class="text-gray-700 hover:text-pink-500">
        ← Back to Home
    </a>
</div>

<!-- EMPTY STATE -->
<?php if(empty($wishlist)){ ?>
    <div class="text-center mt-20">
        <h3 class="text-xl text-gray-600">Your wishlist is empty 💔</h3>
        <a href="home.php" class="mt-4 inline-block bg-yellow-400 px-6 py-2 rounded-full text-white">
            Explore Food
        </a>
    </div>
<?php } ?>

<!-- WISHLIST GRID -->
<div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-10 py-8">

<?php
foreach($wishlist as $id => $v){

    $res = mysqli_query($connect, "SELECT * FROM foods WHERE id='$id'");
    $item = mysqli_fetch_assoc($res);
?>

<div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">

    <img src="../uploads/<?php echo $item['image']; ?>"
         class="h-44 w-full object-cover">

    <div class="p-4">

        <h3 class="font-semibold text-lg"><?php echo $item['name']; ?></h3>

        <p class="text-pink-500 font-bold text-lg mt-1">
            ₹<?php echo $item['price']; ?>
        </p>

        <div class="flex gap-2 mt-4">

            <!-- ORDER -->
            <form action="checkout.php" method="POST" class="w-1/2">
                <input type="hidden" name="food_id" value="<?php echo $item['id']; ?>">
                <input type="hidden" name="price" value="<?php echo $item['price']; ?>">

                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-full w-full text-sm">
                    Order
                </button>
            </form>

            <!-- REMOVE -->
            <form action="remove_wishlist.php" method="POST" class="w-1/2">
                <input type="hidden" name="food_id" value="<?php echo $item['id']; ?>">

                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-full w-full text-sm">
                    Remove
                </button>
            </form>

        </div>

    </div>

</div>

<?php } ?>

</div>

</body>
</html>