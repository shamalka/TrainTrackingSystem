<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone_number"];
$nic = $_POST["nic"];

$salt = 'Username20Jun96';
$hashed_pwd = hash('gost', $password.$salt);

$query = "INSERT INTO user_info VALUES('$name','$email','$hashed_pwd','$phone','$nic','ACTIVE')";

if(mysqli_query($con,$query)){
	echo "<h3>Data Insertion Success.!";
}else{
	echo "<h3>Data Insertion Error.!";
}


mysqli_close($con);
?>