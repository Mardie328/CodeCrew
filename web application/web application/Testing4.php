<?php
session_start();
include("databaseConnection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Webpage Design</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Our Website</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="Testing3.php">ABOUT</a></li>
                    <li><a href="Testing.php">CONTACT</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div> 
        <div class="content">
            <h1>This is <br>my  <br>Blog</h1>
            <p class="par">Welcome,
                <?php 
                    if(isset($_SESSION['email'])){
                        $email=$_SESSION['email'];
                        $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                        while($row=mysqli_fetch_array($query)){
                        echo $row['firstName'].' '.$row['lastName'];
                    }
                }
            ?>
			</p>
            
</div>
        </div>
    </div>
</body>
</html>