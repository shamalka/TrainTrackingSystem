<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}


include('dbcon.php');

date_default_timezone_set('Asia/Colombo');

$date=date("F j, Y"); ;
$time=date("h:i:sa");

$title=mysqli_escape_string($connect,$_POST['title']);
$add="Admin";
$des=mysqli_escape_string($connect,$_POST['txt']);
$ver="VERIFIED";

$sql="INSERT INTO news (title,description,author,dates,Times,verify) VALUES('".$title."','".$des."','".$add."','".$date."','".$time."','".$ver."')";
 if(mysqli_query($connect,$sql)){
   echo "success";
 }else{
   exit;
 }
 mysqli_close($connect);
 ?>
