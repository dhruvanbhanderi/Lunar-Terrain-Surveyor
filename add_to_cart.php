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

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$watchId = isset($_GET['watch_id']) ? intval($_GET['watch_id']) : 0;

$watchDetails = [
    1 => ['name' => 'Baroque Classic Watch', 'price' => 2500.00],
    2 => ['name' => 'Baroque Royal Watch', 'price' => 3800.00],
    3 => ['name' => 'Renaissance Vintage Watch', 'price' => 322200.00],
    4 => ['name' => 'Renaissance Luxury Watch', 'price' => 2343500.00],
    5 => ['name' => 'Renaissance Classic Watch', 'price' => 1124000.00]
];

if ($userId && $watchId && isset($watchDetails[$watchId])) {
    $watchName = $watchDetails[$watchId]['name'];
    $price = $watchDetails[$watchId]['price'];

    $checkSql = "SELECT * FROM cart WHERE user_id = ? AND watch_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $userId, $watchId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Item is already in the cart.');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, watch_id, watch_name, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $userId, $watchId, $watchName, $price);

        if ($stmt->execute()) {
            echo "<script>alert('Item added to cart successfully.');</script>";
        } else {
            echo "<script>alert('Failed to add item to cart.');</script>";
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    echo "<script>alert('User not signed in or invalid watch ID.');</script>";
}

$conn->close();

header("Location: cart.php");
exit;
?>
