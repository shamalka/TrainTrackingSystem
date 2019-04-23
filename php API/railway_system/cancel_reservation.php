<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$reservationid = $_POST["reservation_id"];

$query = "UPDATE reservations SET status='CANCEL' WHERE reservation_id='$reservationid'";

if(mysqli_query($con,$query)){
	//echo "<h3>Data Insertion Success.!";
}else{
	//echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>