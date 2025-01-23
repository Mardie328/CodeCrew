<!-- Blog Comments -->

<?php 


    if(isset($_POST['create_comment'])){
        $comment_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)
        VALUES( $comment_post_id,'$comment_author', '$comment_email','$comment_content','pendding',NOW())";

        $insert_comment_query = mysqli_query($connection, $query);

        if(!$query){

            die('Insert comment query failed' . mysqli_error($connection));
        }

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $comment_post_id";

        $update_comment_count = mysqli_query($connection, $query);
          
    
    }
