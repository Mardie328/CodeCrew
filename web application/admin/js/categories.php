<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Manage Categories
                            <small>user</small>
                        </h1>

                        <div class="col-xs-6">
                        <!--code to insert the category in to the database-->

                        <!--Calling for insert category function-->

                            <?php    insert_categories();      ?>


                        <!--Insert category form-->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title"><br>
                                </div>

                                <div class="from-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category" autocomplete="off">
                                </div>

                            </form>

                        <!--Edit Category form-->
                        <?php
                        
                        if(isset($_GET['edit'])){
                            
                            $edit_id = $_GET['edit'];

                            include "includes/update_categories.php";

                        }
                        
                        
                        
                        
                        ?>
            
                        </div>

                        <div class="col-xs-6">


                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!--PHP code to select the categories-->
                                    <?php 
                                    //function to collect all the categories
                                        findAllCategories();

                                    ?>

                                    <?php //Delete categories Query PHP code
                                        
                                        //function to delete categories

                                        GLOBAL $connectn;

                                        if(isset($_GET['delete'])){
                                            $del_cat_id = $_GET['delete'];
                                    
                                                $query = "DELETE FROM categories WHERE cat_id = $del_cat_id";
                                    
                                                $query_delete = mysqli_query($connection, $query);
                                                header("Location: categories.php");
                                        }
                                    
                                    ?>

                                    
                                </tbody>
                            </table>

                            
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>
