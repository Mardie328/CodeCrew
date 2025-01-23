<?php
if(isset($_POST['create_user'])){

    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $created_date = date('d-m-y');

    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role, created_date) VALUES
    ('$username','$password','$firstname','$lastname','$email','$user_role', NOW())";

    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);


}


?>

<form action="" enctype="multipart/form-data" method="post" >

    <div class="form-group">
        <label for="title">First Name</label>
        <input class="form-control" type="text" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="title">Last Name</label>
        <input class="form-control" type="text" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="title">User Role</label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber">Select Option</option>
            <option value="subscriber">Subscriber</option>
            <option value="admin">admin</option>
        </select>
    </div>


    <div class="form-group">
        <label for="title">Username</label>
        <input class="form-control" type="text" name="username"> 
    </div>

    <div class="form-group">
        <label for="title">Email</label>
        <input class="form-control" type="email" name="user_email"> 
    </div>

    <div class="form-group">
        <label for="title">Password</label>
        <input class="form-control" type="password" name="user_password"> 
    </div>

  

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>




</form>
