<?php
//add stations to databse
include('dbcon.php');
if(isset($_POST['sname'])){
$st=$_POST['sname'];
$query="INSERT INTO station_names(name) VALUES('".$st."')";
$res=mysqli_query($connect,$query);
  header('location:station.php');
}
else{
  echo "<script type='text/javascript'>alert('connection error')</script>";
}
 ?>
