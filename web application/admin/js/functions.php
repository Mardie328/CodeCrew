<?php 

function confirm($result){

    GLOBAL $connection;

   if(!$result){

    die("QUERY FAILED" . mysqli_error($connection));

   } 

}

function insert_categories(){

    GLOBAL $connection;

    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
             
            echo "<h4 style='color:red'>The category field should not be empty</h4>";

        }else{

        $query = "INSERT INTO categories (cat_title)VALUES('$cat_title')";
        $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query){
                die('Insert category query fail' . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories(){

    GLOBAL $connection;

    $query = "SELECT * FROM categories";
    $query_select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc( $query_select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
        <td>$cat_id</td>
        <td>$cat_title</td>
        <td><a href='categories.php?delete=$cat_id'><i class='fa fa-trash-o' style='color:red'></i></a></td>
        <td><a href='categories.php?edit=$cat_id'><i class='fa fa-pencil' style='color:blue'></i></a></td>
        </tr>";
    }
}













?>
