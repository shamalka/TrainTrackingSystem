<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$trainid = $_POST["train_id"];
$userid = $_POST["user_id"];
$firstclass = $_POST["first_class_seats"];
$secondclass = $_POST["second_class_seats"];
$thirdclass = $_POST["third_class_seats"];
$totalprice = $_POST["total_price"];
$startstation = $_POST["start_station"];
$endstation = $_POST["end_station"];
$arrivaltime = $_POST["arrival_time"];
$date = $_POST["date"];
$status = $_POST["status"];

$query = "INSERT INTO reservations(train_id,user_id,first_class_seats,second_class_seats,third_class_seats,total_price,start_station,end_station,arrival_time,date,status) VALUES('$trainid','$userid','$firstclass','$secondclass','$thirdclass','$totalprice','$startstation','$endstation','$arrivaltime','$date','$status')";

if(mysqli_query($con,$query)){
	//echo "<h3>Data Insertion Success.!";
}else{
	//echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>