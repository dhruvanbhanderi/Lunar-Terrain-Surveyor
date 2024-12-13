<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.html");
    exit;
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Payment Confirmation - Anand Watches</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #283747; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; }
        .confirmation-box { background-color: #fff; color: #333; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .confirmation-box h2 { font-size: 1.8em; margin-bottom: 15px; }
        .confirmation-box p { font-size: 1em; margin-bottom: 20px; }
        .button { padding: 10px 20px; font-size: 1em; background-color: #4CAF50; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

<div class='confirmation-box'>
    <h2>Thank You for Your Purchase!</h2>
    <p>Your payment has been successfully processed.</p>
    <button class='button' onclick='window.location.href=\"index.html\"'>Return to Home</button>
</div>

</body>
</html>";
