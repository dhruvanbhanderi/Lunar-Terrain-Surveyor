<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["messageContent"]);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // HTML structure with CSS, video background, and footer
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Thank You - Anand Watches</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    font-family: Arial, sans-serif;
                    color: #333;
                    overflow-x: hidden;
                }

                
                header {
                    background-color: rgba(0, 0, 0, 0.7);
                    color: #fff;
                    padding: 20px 0;
                    text-align: center;
                    position: relative;
                    z-index: 10;
                    width: 100%;
                    top: 0;
                }

                header h1 {
                    font-size: 2.5em;
                    font-weight: bold;
                    margin-bottom: 10px;
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
                }

                .nav-container nav a:hover {
                    background-color: #575757;
                }

                /* Video Background */
                .video-background {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    z-index: -1;
                }

                /* Message Styling */
                .content {
                    position: relative;
                    z-index: 10;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 80vh;
                    color: #fff;
                    text-align: center;
                }

                .message-box {
                    background-color: rgba(0, 0, 0, 0.7);
                    padding: 30px 50px;
                    border-radius: 10px;
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                }

                .message-box h2 {
                    color: #4CAF50;
                    margin-bottom: 15px;
                }

                .message-box p {
                    font-size: 1.2em;
                    line-height: 1.6;
                }

                /* Footer Styling */
                footer {
                    background-color: #333;
                    color: #fff;
                    text-align: center;
                    padding: 20px 0;
                    position: relative;
                    z-index: 10;
                    width: 100%;
                    bottom: 0;
                }

                footer p{
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: relative;
            z-index: 10;
        }
            </style>
        </head>
        <body>

            
            <header>
                <div class='nav-container'>
                    <h1>Anand Watches</h1>
                    <nav>
                        <a href='index.html'>Home</a>
                        <a href='about.html'>About Us</a>
                        <a href='contact.html'>Contact Us</a>
                        <a href='categories.html'>Categories</a>
                        <a href='social.html'>Social Icons</a>
                        <a href='signin.html'>Sign In</a>
                    </nav>
                </div>
            </header>

            
            <video class='video-background' autoplay loop muted>
                <source src='The Radcliffe Le Dome is a $430 Hyperwatch.mp4' type='video/mp4'>
            </video>

           
            <div class='content'>
                <div class='message-box'>
                    <h2>Thank You!</h2>
                    <p>Thank you for contacting us, <strong>$name</strong>! We will get back to you soon.</p>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <p>&copy; 2024 Anand Watches. All rights reserved.</p>
            </footer>

        </body>
        </html>
        ";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>
