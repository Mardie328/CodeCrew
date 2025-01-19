<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: database_Add_And_Login.php");
    exit();
}

$connection = new mysqli("localhost", "root", "", "user_db");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$userEmail = $_SESSION['email'];
$stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$stmt->bind_result($userId);
$stmt->fetch();
$stmt->close();

$notificationsQuery = $connection->prepare("SELECT message, created_at FROM notifications WHERE user_id = ?");
$notificationsQuery->bind_param("i", $userId);
$notificationsQuery->execute();
$result = $notificationsQuery->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<p><strong>{$row['message']}</strong> - {$row['created_at']}</p>";
}

$notificationsQuery->close();
?>
