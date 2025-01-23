<?php 

function confirm($result){

    GLOBAL $connection;

   if(!$result){

    die("QUERY FAILED" . mysqli_error($connection));

   } 

}

?>
