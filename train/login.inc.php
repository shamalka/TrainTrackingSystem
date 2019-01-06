<?php

session_start();
include 'dbcon.php';

$userid = $_POST['userid'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM log_info WHERE log_id = '$userid' AND password = '$pwd'";
$result = mysqli_query($conn,$sql);


if(!$row = mysqli_fetch_assoc($result)) {
    echo '<script language="javascript">';
    echo 'alert("Your credintials are INVALID!!!")';
    echo '</script>';
    ?>
    <a href="index.php">GO BACK TO HOME PAGE</a>
<?php
} else {	
		header("Location: admin.php");
		}

?>