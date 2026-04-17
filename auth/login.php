
<?php include("../config/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Foodie 🍔</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/style.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-card">

        <h2>Welcome Back 👋</h2>
        <p>Login to continue ordering your favorite food</p>

        <form action="<?php echo BASE_URL; ?>auth/login_process.php" method="POST">
            
            <input type="email" name="email" placeholder="Email Address" required>
            
            <input type="password" name="password" placeholder="Password" required>
            <div class="password-field">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <span onclick="togglePassword()">👁️</span>
</div>
            <button type="submit">Login</button>

        </form>

        <p class="switch-auth">
            Don’t have an account?
            <a href="<?php echo BASE_URL; ?>auth/register.php">Create Account</a>
        </p>

    </div>
</div>

</body>
</html>
<a href="<?php echo BASE_URL; ?>auth/register.php">Create Account</a>
<script>
function togglePassword(){
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>