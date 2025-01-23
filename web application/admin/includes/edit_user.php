<?php 
if(isset($_GET['user_id'])){

    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";

    $select_user_query = mysqli_query($connection, $query);

    confirm($select_user_query);

    while($row = mysqli_fetch_assoc($select_user_query)){

        $user_id = $row['user_id'];
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $username = $row['username'];
        $email = $row['user_email'];
        $password = $row['user_password'];
?>

<form action="" enctype="multipart/form-data" method="post" >

    <div class="form-group">
        <label for="title">First Name</label>
        <input class="form-control" type="text" name="user_firstname" Value="<?php echo $firstname; ?>">
    </div>

    <div class="form-group">
        <label for="title">Last Name</label>
        <input class="form-control" type="text" name="user_lastname" Value="<?php echo $lastname; ?>">
    </div>

    <div class="form-group">
        <label for="title">User Role</label>
        <select class="form-control" name="user_role" id="" Value="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php 
            if($user_role == 'admin'){
                echo "<option value='subscriber'>Subscriber</option>";
            }else{
                echo "<option value='admin'>admin</option>";
            }
            ?>
            
        </select>
    </div>


    <div class="form-group">
        <label for="title">Username</label>
        <input class="form-control" type="text" name="username"  Value="<?php echo $username; ?>"> 
    </div>

    <div class="form-group">
        <label for="title">Email</label>
        <input class="form-control" type="email" name="user_email"  Value="<?php echo $email; ?>"> 
    </div>

    <div class="form-group">
        <label for="title">Password</label>
        <input class="form-control" type="password" name="user_password"  value="<?php echo $password; ?>"> 
    </div>

  

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
    </div>




</form>

<?php } }?>

<?php
if(isset($_POST['update_user'])){

    $user_id = $_GET['user_id'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $query = "UPDATE users SET

        username = '$username',
        user_password = '$password',
        user_firstname = '$firstname',
        user_lastname = '$lastname',
        user_email = '$email',
        user_role = '$user_role'

        WHERE user_id =  $user_id;
    ";

    $update_user_query = mysqli_query($connection, $query);

    confirm($update_user_query);

    header("Location: users.php");


}


?>
