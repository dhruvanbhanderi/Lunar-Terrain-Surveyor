<?php
session_start();
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mini";
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $cvv = $_POST['cvv'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $username = $user['username'];

            $cart_items = [];
            $cart_sql = "SELECT watch_name, price FROM cart WHERE user_id = " . $_SESSION['user_id'];
            $cart_result = $conn->query($cart_sql);

            if ($cart_result->num_rows > 0) {
                while ($row = $cart_result->fetch_assoc()) {
                    $cart_items[] = $row;
                }
            }

            if (!empty($cart_items)) {
                $thank_you_message = "Thank you, $username, for purchasing: ";
                foreach ($cart_items as $item) {
                    $thank_you_message .= "<br>- " . $item['watch_name'];
                }
            } else {
                $thank_you_message = "Your cart is empty.";
            }
        } else {
            $login_error = "Invalid password. Please try again.";
        }
    } else {
        $login_error = "Username not found. Redirecting to Signup.";
        header("Location: signup.html");
        exit;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Anand Watches</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { color: #333; overflow-x: hidden; }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.7;
        }
        header { background-color: #333; color: #fff; padding: 20px 0; text-align: center; }
        header h1 { font-size: 2.5em; margin: 0; }
        .nav-container { display: flex; justify-content: space-between; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .nav-container nav { display: flex; gap: 20px; }
        .nav-container nav a { color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav-container nav a:hover { background-color: #575757; }
        .container { display: flex; justify-content: center; align-items: center; min-height: 80vh; }
        .checkout-box { background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 8px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .checkout-box h2 { margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { font-weight: bold; display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
        .error-message { color: red; margin-bottom: 15px; }
        .form-group button { width: 100%; padding: 10px; background-color: #4CAF50; color: #fff; font-size: 1em; font-weight: bold; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s; }
        .form-group button:hover { background-color: #45a049; }
        .thank-you-message { font-size: 1.5em; color: #4CAF50; margin-top: 20px; }
        footer { background-color: #333; color: #fff; text-align: center; padding: 20px 0; }
        footer p { font-size: 1em; }
    </style>
</head>
<body>

<?php if (isset($thank_you_message)): ?>
<video class="video-background" autoplay loop muted>
    <source src="BEST Watch You’ve NEVER Heard Of (Armin Strom).mp4" type="video/mp4">
</video>
<?php else: ?>
<video class="video-background" autoplay loop muted>
    <source src="10 STUNNING Chronograph Watches For ANY Budget!.mp4" type="video/mp4">
</video>
<?php endif; ?>

<header>
    <div class="nav-container">
        <h1>Anand Watches</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="about.html">About Us</a>
            <a href="contact.html">Contact Us</a>
            <a href="categories.html">Categories</a>
            <a href="signin.html">Sign In</a>
        </nav>
    </div>
</header>

<div class="container">
    <div class="checkout-box">
        <?php if (isset($thank_you_message)): ?>
            <h2>Order Confirmation</h2>
            <p class="thank-you-message"><?php echo $thank_you_message; ?></p>
        <?php else: ?>
            <h2>Checkout</h2>
            <?php if ($login_error) echo "<p class='error-message'>$login_error</p>"; ?>
            <form action="checkout.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" maxlength="3" required>
                </div>
                <div class="form-group">
                    <button type="submit">Proceed to Payment</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Anand Watches. All rights reserved.</p>
</footer>

</body>
</html>
