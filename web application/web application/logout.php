<?php
session_start();
session_destroy();
header("Location: database_Add_And_Login.php");
exit();
?>
