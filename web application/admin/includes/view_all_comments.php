<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Response To</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $query = "SELECT * FROM comments ORDER BY comment_id DESC";

                                $select_comments_query = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_comments_query)){
                                    $comment_id = $row['comment_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_email = $row['comment_email'];
                                    $comment_content = $row['comment_content'];
                                    $comment_status = $row['comment_status'];
                                    $comment_date = $row['comment_date'];

                            
                                echo"<tr>";

                                echo "<td>$comment_id</td>";
                                echo "<td>$comment_author</td>";
                                echo "<td>$comment_content</td>";
                                echo "<td>$comment_email</td>";
                                echo "<td>$comment_status</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";

                                $select_post_id_query = mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($select_post_id_query)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                                    
                                }

                                



                                echo "<td>$comment_date</td>";
                                echo "<td><a href='comments.php?approve=$comment_id'><i class='fa fa-check-square-o' style='color:green'></i></a></td>";
                                echo "<td><a href='comments.php?unapprove=$comment_id'><i class='fa fa-close' style='color:orange'></i></a></td>";
                                echo "<td><a href='comments.php?delete_comment=$comment_id'><i class='fa fa-trash-o' style='color:red'></i></a></td>";
                                    
                                    echo "</tr>";
                                }

                                ?>
                            </tbody>
                        </table>
<?php

    //code to delete the comment                            
    if(isset($_GET['delete_comment'])){

        $comment_id = $_GET['delete_comment'];

        $query = "DELETE FROM comments WHERE comment_id = $comment_id";

        $delete_comment_query = mysqli_query($connection, $query);

        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $comment_post_id";

        $update_comment_count = mysqli_query($connection, $query);

        header("Location: comments.php");
        
    }
    //code to unapprove the comment
    if(isset($_GET['unapprove'])){

        $comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";

        $unapprove_comment_query = mysqli_query($connection, $query);

        header("Location: comments.php");
    }

        //code to approve the comment
        if(isset($_GET['approve'])){

            $comment_id = $_GET['approve'];
    
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
    
            $approve_comment_query = mysqli_query($connection, $query);
    
            header("Location: comments.php");
        }

?>
