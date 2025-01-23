<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Images</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Publish</th>
                                    <th>Unpublish</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $query = "SELECT * FROM posts ORDER BY post_date DESC";

                                $select_posts_query = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_posts_query)){
                                    $post_id = $row['post_id'];
                                    $post_autthor = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    $post_category = $row['post_cat_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_comment = $row['post_comment_count'];
                                    $post_date = $row['post_date'];

                            
                                echo"<tr>";

                                echo "<td>$post_id</td>";
                                echo "<td>$post_autthor</td>";
                                echo "<td>$post_title</td>";

                                $query = "SELECT * FROM categories WHERE cat_id = $post_category";

                                $slect_category = mysqli_query($connection, $query);

                                confirm($slect_category);

                                while($row = mysqli_fetch_array($slect_category)){

                                    $cat_title = $row['cat_title'];

                                    echo "<td>$cat_title</td>";

                                }

                                

                                echo "<td>$post_status</td>";
                                echo "<td><img class='img-responsive' style='max-width: 100px' src='../images/$post_image' alt='post image'></td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_comment</td>";
                                echo "<td>$post_date</td>";
                                echo "<td><a href='posts.php?publish=$post_id'><i class='fa fa-check-square-o' style='color:green'></i></a></td>";
                                echo "<td><a href='posts.php?unpublish=$post_id'><i class='fa fa-close' style='color:orange'></i></a></td>";
                                echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'><i class='fa fa-pencil' style='color:blue'></i></a></td>";
                                echo "<td><a href='posts.php?delete=$post_id'><i class='fa fa-trash-o' style='color:red'></i></a></td>";
                                    
                                    echo "</tr>";
                                }

                                ?>
                            </tbody>
                        </table>
<?php
    if(isset($_GET['delete'])){

        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $post_id";
        $delete_post_query = mysqli_query($connection, $query);

        header("Location: posts.php");
        
    }

    //code to publish the post
    if(isset($_GET['publish'])){

        $post_id = $_GET['publish'];

        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $post_id";

        $approve_comment_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }

    //code to unpublish the post
    if(isset($_GET['unpublish'])){

        $post_id = $_GET['unpublish'];

        $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = $post_id";

        $approve_comment_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }


?>
