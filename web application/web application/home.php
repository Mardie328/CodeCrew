<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$connection = new mysqli("localhost", "root", "", "user_db");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch user details
$email = $_SESSION['email'];
$stmt = $connection->prepare("SELECT id, first_name, last_name FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($userId, $firstName, $lastName);
$stmt->fetch();
$stmt->close();

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES['upload']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only certain file formats
    if (in_array($fileType, ["jpg", "png", "jpeg", "gif"])) {
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $targetFilePath)) {
            $stmt = $connection->prepare("INSERT INTO uploads (user_id, file_path) VALUES (?, ?)");
            $stmt->bind_param("is", $userId, $targetFilePath);
            $stmt->execute();
            $stmt->close();
            $message = "File uploaded successfully!";
        } else {
            $message = "Error uploading file.";
        }
    } else {
        $message = "Only image files are allowed!";
    }
}

// Handle comment addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_comment'])) {
    $comment = $connection->real_escape_string($_POST['comment']);
    $stmt = $connection->prepare("INSERT INTO comments (user_id, comment) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $comment);
    $stmt->execute();
    $stmt->close();
}

// Handle comment deletion
if (isset($_GET['delete_comment'])) {
    $commentId = intval($_GET['delete_comment']);
    $stmt = $connection->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $commentId, $userId);
    $stmt->execute();
    $stmt->close();
    header("Location: home.php");
    exit();
}

// Handle comment editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $commentId = intval($_POST['comment_id']);
    $newComment = $connection->real_escape_string($_POST['new_comment']);
    $stmt = $connection->prepare("UPDATE comments SET comment = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $newComment, $commentId, $userId);
    $stmt->execute();
    $stmt->close();
    header("Location: home.php");
    exit();
}

// Fetch notifications
$notifications = [];
$notificationQuery = $connection->query("SELECT message FROM notifications WHERE user_id = $userId");
while ($row = $notificationQuery->fetch_assoc()) {
    $notifications[] = $row['message'];
}

// Fetch comments
$comments = [];
$commentQuery = $connection->query("SELECT id, comment FROM comments WHERE user_id = $userId");
while ($row = $commentQuery->fetch_assoc()) {
    $comments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($firstName . " " . $lastName); ?>!</h1>
        
        <!-- Notifications -->
        <h2>Notifications</h2>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li><?php echo htmlspecialchars($notification); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- File Upload -->
        <h2>Upload a Picture</h2>
        <form action="home.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="upload" required>
            <button type="submit">Upload</button>
        </form>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>

        <!-- Comments Section -->
        <h2>Comments</h2>
        <form action="home.php" method="POST">
            <textarea name="comment" required placeholder="Write your comment here"></textarea>
            <button type="submit" name="add_comment">Add Comment</button>
        </form>

        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <?php echo htmlspecialchars($comment['comment']); ?>
                    <a href="home.php?delete_comment=<?php echo $comment['id']; ?>">Delete</a>
                    <form action="home.php" method="POST" style="display:inline;">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                        <input type="text" name="new_comment" placeholder="Edit comment" required>
                        <button type="submit" name="edit_comment">Update</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
