<?php
$server="localhost";
$user="root";
$password="";
$dtabase="Train2";

$connect=mysqli_connect($server, $user, $password, $dtabase) ;

if (!$connect) {
  die("connection failed" .mysqli_connect_error());
}
/*else{
  echo "Connection successful";
}*/

 ?>
