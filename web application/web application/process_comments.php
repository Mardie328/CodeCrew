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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_SESSION['email'];
    $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    if (isset($_POST['add_comment'])) {
        $content = $connection->real_escape_string($_POST['comment']);
        $stmt = $connection->prepare("INSERT INTO comments (user_id, content) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $content);
        $stmt->execute();
        echo "Comment added successfully!";
    } elseif (isset($_POST['edit_comment'])) {
        $commentId = (int)$_POST['comment_id'];
        $newContent = $connection->real_escape_string($_POST['new_comment']);
        $stmt = $connection->prepare("UPDATE comments SET content = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $newContent, $commentId, $userId);
        $stmt->execute();
        echo "Comment updated successfully!";
    } elseif (isset($_POST['delete_comment'])) {
        $commentId = (int)$_POST['comment_id'];
        $stmt = $connection->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $commentId, $userId);
        $stmt->execute();
        echo "Comment deleted successfully!";
    }
}
?>
