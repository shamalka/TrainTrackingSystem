<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$trainid = $_POST["train_id"];
$userid = $_POST["email"];
$rating = $_POST["train_rating"];
$comments = $_POST["comments"];


$query = "INSERT INTO `rating`(`train_id`, `email`, `train_rating`, `comments`) VALUES ('$trainid','$userid','$rating','$comments')";

if(mysqli_query($con,$query)){
	//echo "<h3>Data Insertion Success.!";
}else{
	//echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>