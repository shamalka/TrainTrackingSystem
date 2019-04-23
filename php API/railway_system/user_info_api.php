<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");

$email = $_POST["user_email"];
$password = $_POST["user_password"];

$salt = 'Username20Jun96';
$hashed_pwd = hash('gost', $password.$salt);

$query = "SELECT * FROM user_info WHERE email LIKE '$email' AND password LIKE '$hashed_pwd' AND status='ACTIVE'";

$result = mysqli_query($con,$query);

if(mysqli_num_rows($result) > 0){
	echo "Login Success";
}else{
	echo "Login Failed";
}


mysqli_close($con);
?>