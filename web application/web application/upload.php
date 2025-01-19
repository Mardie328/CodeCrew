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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $userEmail = $_SESSION['email'];
    $userQuery = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $userQuery->bind_param("s", $userEmail);
    $userQuery->execute();
    $userQuery->bind_result($userId);
    $userQuery->fetch();
    $userQuery->close();

    $imageName = $_FILES['image']['name'];
    $imagePath = "images/" . basename($imageName);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $stmt = $connection->prepare("INSERT INTO images (user_id, file_path) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $imagePath);
        $stmt->execute();
        $stmt->close();
        echo "Image uploaded successfully!";
    } else {
        echo "Failed to upload image.";
    }
}
?>
