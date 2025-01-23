<?php
if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_cat_id = $_POST['post_cat_id'];


    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_cat_id,post_title, post_author, post_date, post_image, post_content, post_tags)
    VALUES ($post_cat_id,' $post_title','$post_author',now(),'$post_image','$post_content','$post_tags')"
    ;

    $create_post_query = mysqli_query($connection,$query);

    confirm($create_post_query);


}
