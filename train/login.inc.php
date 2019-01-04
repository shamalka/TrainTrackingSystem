<?php

session_start();
include 'dbcon.php';

$userid = $_POST['userid'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM user_info WHERE email = '$userid' AND password = '$pwd'";
$result = mysqli_query($conn,$sql);


if(!$row = mysqli_fetch_assoc($result)) {
	echo "Your creditials are INVALID!!!";
} else {	
		header("Location: admin.php");
		}

