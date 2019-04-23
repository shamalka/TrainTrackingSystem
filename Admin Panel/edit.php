<?php

//edit table data live
include('dbcon.php');
$id = $_POST["id"];
$text = $_POST["text"];
$column_name = $_POST["column_name"];
 $sql = "UPDATE ticket_price SET ".$column_name."='".$text."' WHERE id='".$id."'";
 if(mysqli_query($connect, $sql))
 {
      echo 'Data Updated';
 }
 ?>


 ?>
