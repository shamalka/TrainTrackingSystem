<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$userid = $_POST["user_id"];

$query = "DELETE FROM reservations WHERE user_id='$userid' AND status='PENDING' ORDER BY reservation_id DESC LIMIT 1";

if(mysqli_query($con,$query)){
	//echo "<h3>Data Insertion Success.!";
}else{
	//echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>