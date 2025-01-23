<?php

if(isset($_GET['p_id'])){

    $post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id";

    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_autthor = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];

    }

    if(isset($_POST['update_post'])){

        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_cat_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
    
    
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
    
    
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){

            $query = "SELECT * FROM posts WHERE post_id = $post_id";

            $select_image = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_image)){
                    $post_image = $row['post_image'];
                }
            

            }


            $query = "UPDATE posts SET
            post_title = '$post_title',
            post_cat_id = $post_cat_id,
            post_date = now(),
            post_author = '$post_author',
            post_status = '$post_status',
            post_tags = '$post_tags',
            post_content = '$post_content',
            post_image = '$post_image'
            WHERE post_id = $post_id";
    
            $update_post_query = mysqli_query($connection, $query);
    
            confirm($update_post_query);


        }
        
    }

?>


<form action="" enctype="multipart/form-data" method="post" >

    <div class="form-group">
        <label for="title">Post Title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="title">Post Category</label>
        <select class="form-control" name="post_category" id="">

        <?php 

$query = "SELECT * FROM categories";

[O$select_categories = mysqli_query($connection, $query);

confirm($select_categories);

while($row = mysqli_fetch_assoc($select_categories)){

    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='$cat_id'>$cat_title</option>";

}



?>

            
            

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input class="form-control" type="text" name="author" value="<?php echo $post_autthor; ?>"> 
    </div>

    <div class="form-group">
        <label for="title">Post Status</label>
        <input class="form-control" type="text" name="post_status" value="<?php echo $post_status; ?>"> 
    </div>

    <div class="form-group">
        <label for="title">Post Image</label><br>
        <img width="150" src="../images/<?php echo $post_image ?>" alt=""> <br><br>
        <input type="file" name="image"> 
    </div>

    <div class="form-group">
        <label for="title">Post Tags</label>
        <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags; ?>"> 
    </div>

    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" type="text" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>




</form>
