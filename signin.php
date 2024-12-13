<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mini";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_error = "";
$welcome_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $welcome_message = "Welcome, " . htmlspecialchars($user['username']) . "!";
        } else {
            $login_error = "Invalid password. Please try again.";
        }
    } else {
        $login_error = "Username not found. Please check and try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Anand Watches</title>
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
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
            width: 100%;
            z-index: 10;
        }

        header h1 {
            font-size: 2em;
            margin: 0;
        }

        header nav {
            margin-top: 10px;
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        header nav a:hover {
            color: #f4b400;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding-top: 100px;
            padding-bottom: 50px;
        }

        .signin-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .signin-box h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #ddd;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #4CAF50;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 1.2em;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .options {
            margin-top: 15px;
            color: #333;
            font-size: 0.9em;
        }

        .options a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        .welcome-message {
            color: green;
            font-size: 1.2em;
            margin-top: 20px;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            padding: 15px;
            width: 100%;
            position: relative;
            bottom: 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <video class="video-background" autoplay loop muted>
        <source src="Secrets of Himalaya _ Nepal in 4K.mp4" type="video/mp4">
    </video>

    <header>
        <h1>Anand Watches</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="about.html">About Us</a>
            <a href="contact.html">Contact Us</a>
            <a href="categories.html">Categories</a>
            <a href="signin.php">Sign In</a>
        </nav>
    </header>

    <div class="container">
        <div class="signin-box">
            <h2>Sign In</h2>
            <?php if ($welcome_message): ?>
                <p class="welcome-message"><?php echo $welcome_message; ?></p>
            <?php else: ?>
                <?php if ($login_error): ?>
                    <p class="error-message"><?php echo $login_error; ?></p>
                <?php endif; ?>
                <form action="signin.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Sign In</button>
                    </div>
                </form>
                <div class="options">
                    <a href="#">Forgot Password?</a> | <a href="signup.html">Sign Up</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Anand Watches. All rights reserved.</p>
    </footer>

</body>
</html>
