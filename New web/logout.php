<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
session_start();
$_SESSION['email']='';
session_destroy();
header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
exit;
 ?>
