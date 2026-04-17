<?php include("../config/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register | Foodie 🍔</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/style.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-card">

        <h2>Create Account 🍕</h2>
        <p>Join Foodie and start ordering delicious meals</p>

        <form onsubmit="return validateForm()" action="<?php echo BASE_URL; ?>auth/register_process.php" method="POST">

            <input type="text" name="name" placeholder="Full Name" required>

            <input type="email" name="email" placeholder="Email Address" required>

            <input type="password" name="password" placeholder="Password" required>

            <select name="role">
                <option value="customer">👤 Customer</option>
                <option value="retailer">🏪 Retailer</option>
            </select>

            <button type="submit">Register</button>

        </form>

        <p class="switch-auth">
            Already have an account?
            <a href="<?php echo BASE_URL; ?>auth/login.php">Login</a>
        </p>

    </div>
</div>

<script>
function validateForm(){
    let email = document.querySelector("input[name='email']").value;
    let password = document.querySelector("input[name='password']").value;

    if(password.length < 6){
        alert("Password must be at least 6 characters");
        return false;
    }

    if(!email.includes("@")){
        alert("Invalid email");
        return false;
    }

    return true;
}
</script>

</body>
</html>