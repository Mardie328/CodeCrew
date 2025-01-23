<form action="" method="post">
                                <div class="from-group">
                                <br>
                                    <?php
                                    
                                        if(isset($_GET['edit'])){

                                            $edit_id = $_GET['edit'];

                                            $query = "SELECT * FROM categories WHERE cat_id = $edit_id";

                                            $edit_query_select = mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($edit_query_select)){
                                                $edit_cat_id = $row['cat_id'];
                                                $edit_cat_title = $row['cat_title'];
                                            }
                                            ?>
                                            <label for="cat-title">Update Category</label>
                                            
                                            <input class="form-control" type="text" name="edit_cat_title" value=<?php echo $edit_cat_title; ?>><br>

                                            <div class="from-group">
                                                <input class="btn btn-primary" type="submit" name="update_category" value="Upadate Category" autocomplete="off">
                                            </div>
                                      <?php  } ?>


                                      <?php ////////////////////////////update query
                                      
                                      if(isset($_POST['update_category'])){
                                        $update_title = $_POST['edit_cat_title'];

                                        $query = "UPDATE categories SET cat_title = '$update_title' WHERE cat_id = $edit_id";

                                        $update_cat_query = mysqli_query($connection,  $query);

                                        if(!$update_cat_query){
                                            die("UPDATING QUERY FAILED" .mysqli_error($connection));
                                        }else{
                                            header("Location: categories.php");
                                        }
                                      }
                                      
                                      
                                      
                                      ?>
                                    

                                </div>

                                

                            </form>
