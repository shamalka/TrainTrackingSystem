<?php
session_start();
$_SESSION['email']='';
session_destroy();
header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
exit;
 ?>
