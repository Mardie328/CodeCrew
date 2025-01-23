<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created Date</th>
                                    <th>Give Admin Role</th>
                                    <th>Give Sub Role</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $query = "SELECT * FROM users ORDER BY user_id DESC";

                                $select_users_query = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_users_query)){
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];
                                    $created_date = $row['created_date'];

                            
                                echo"<tr>";

                                echo "<td>$user_id</td>";
                                echo "<td>$username</td>";
                                echo "<td>$user_firstname</td>";
                                echo "<td>$user_lastname</td>";
                                echo "<td>$user_email</td>";
                                echo "<td>$user_role</td>";
                                echo "<td>$created_date</td>";
                                echo "<td><a href='users.php?change_to_admin=$user_id' alt='change role'><i class='fa fa-user' style='color:green'></i></a></td>";
                                echo "<td><a href='users.php?change_to_sub=$user_id' alt='change role'><i class='fa fa-check-square-o' style='color:orange'></i></a></td>";
                                echo "<td><a href='users.php?source=edit_user&user_id=$user_id'><i class='fa fa-pencil' style='color:blue'></i></a></td>";
                                echo "<td><a href='users.php?delete_user=$user_id'><i class='fa fa-trash-o' style='color:red'></i></a></td>";
                                    
                                    echo "</tr>";
                                }

                                ?>
                            </tbody>
                        </table>
<?php

    //code to delete the comment                            
    if(isset($_GET['delete_user'])){

        $user_id = $_GET['delete_user'];

        $query = "DELETE FROM users WHERE user_id = $user_id";

        $delete_user_query = mysqli_query($connection, $query);

        header("Location: users.php");
        
    }
    //code to change the role of the user to admin
    if(isset($_GET['change_to_admin'])){

        $user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";

        $change_role_to_admin_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }

        //Change the role to subsriber
        if(isset($_GET['change_to_sub'])){

            $user_id = $_GET['change_to_sub'];
    
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
    
            $change_role_to_sub_query = mysqli_query($connection, $query);
    
            header("Location: users.php");
        }

?>
