<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cart_items = [];
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($userId) {
    $sql = "SELECT watch_name, price FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Anand Watches</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            color: #333;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        header {
            background-color: rgba(51, 51, 51, 0.8);
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        header h1 {
            font-size: 2.5em;
            font-weight: bold;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-container nav {
            display: flex;
            gap: 20px;
        }

        .nav-container nav a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
        }

        .nav-container nav a:hover {
            background-color: #575757;
            color: #f4b400;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            color: #fff;
            position: relative;
            z-index: 10;
            text-align: center;
            flex-grow: 1; 
        }

        h2 {
            font-size: 2em;
            color: #f4b400;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.85); 
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
            color: #333;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        .checkout-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #45a049;
        }

        .footer {
            background-color: rgba(51, 51, 51, 0.8);
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            z-index: 10;
            margin-top: auto; 
        }
    </style>
</head>
<body>

<video class="video-background" autoplay loop muted>
    <source src="omega.mp4" type="video/mp4">
</video>

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
    <h2>Your Cart</h2>

    <?php if (!empty($cart_items)): ?>
        <table>
            <tr>
                <th>Watch Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?php echo $item['watch_name']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>1 item shippable in stock</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<footer class="footer">
    <p>&copy; 2024 Anand Watches. All rights reserved.</p>
</footer>

</body>
</html>
