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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $location = $conn->real_escape_string($_POST['location']);
    $card_type = $conn->real_escape_string($_POST['card_type']);
    $card_number = $conn->real_escape_string($_POST['card_number']);
    $address = $conn->real_escape_string($_POST['address']);

    $sql = "INSERT INTO users (username, password, email, contact, location, card_type, card_number, address) 
            VALUES ('$username', '$password', '$email', '$contact', '$location', '$card_type', '$card_number', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration Successful'); window.location.href = 'signin.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
