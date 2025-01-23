<?php 

include ("db.php");
include ("functions.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

   $user_name = mysqli_real_escape_string($connection, $username);
   $user_password = mysqli_real_escape_string($connection, $password);

   $query = "SELECT * FROM users WHERE username = '$user_name'";

   $select_user_query = mysqli_query($connection, $query);

   confirm($select_user_query);

   while($row=mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_user_name = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
   }


if($user_name === $db_user_name && $user_password === $db_user_password){
          session_start();

          $_SESSION['user_id'] = $db_user_id;
          $_SESSION['username'] = $db_user_name;
          $_SESSION['user_role'] = $db_user_role;
          $_SESSION['user_firstname'] = $db_user_firstname;
          $_SESSION['user_lastname'] = $db_user_lastname;

        header("Location: ../admin");

   }else{
        header("Location: ../index.php?error=login_error");
   }


}


?>
