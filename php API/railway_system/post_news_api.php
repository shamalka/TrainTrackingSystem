<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$title = $_POST["title"];
$description = $_POST["description"];
$author = $_POST["author"];
$date = $_POST["dates"];
$time = $_POST["time"];

$query = "INSERT INTO news(title,description,author,dates,Times,verify) VALUES('$title','$description','$author','$date','$time','not verified')";

if(mysqli_query($con,$query)){
	//echo "<h3>Data Insertion Success.!";
}else{
	//echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>