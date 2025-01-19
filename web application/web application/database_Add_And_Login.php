<?php
session_start();

// Database connection
$connection = new mysqli("localhost", "root", "", "user_db");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $firstName = $connection->real_escape_string($_POST['first_name']);
    $lastName = $connection->real_escape_string($_POST['last_name']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $connection->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Email already registered. Please log in.";
    } else {
        // Insert user into database
        $stmt = $connection->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
        if ($stmt->execute()) {
            echo "Registration successful! Please log in.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}

// Handle user login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Verify user credentials
    $stmt = $connection->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION['email'] = $email; // Save email in session
        header("Location: home.php"); // Redirect to home page
        exit();
    } else {
        echo "Invalid email or password.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register or Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="database_Add_And_Login.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>

        <h1>Login</h1>
        <form action="database_Add_And_Login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>

