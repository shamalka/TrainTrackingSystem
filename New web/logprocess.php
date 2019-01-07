<?php

include ('dbcon.php');
  $emlerr='';
  $pswerr='';
  $logerr='';

  if (empty($_POST['Email'])) {
    session_start();
    $emlerr="Email Field cannot be empty";
    $_SESSION['emlerr']=$emlerr;
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
      }
  else {
    $eml= $_POST['Email'];
    $eml=stripcslashes($eml);
      }

  if (empty($_POST['psw'])) {
    session_start();
    $pswerr="Password field cannot be empty";
    $_SESSION['pswerr']=$pswerr;
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
  }
  else{
    $pwd = $_POST['psw'];
    $pwd=stripslashes($pwd);
  }
if (empty($emlerr) && empty($pswerr)) {
  $sql = "SELECT * FROM loginfo WHERE Email = '$eml'";
  $result = mysqli_query($connect,$sql);
  $row=mysqli_fetch_assoc($result);

  if($pwd==$row['password']) {
    session_start();
    $_SESSION['email']=$eml;
    $_SESSION['username']=$row['username'];
    $_SESSION['position']=$row['position'];
    echo"hi";
    header('location:http://localhost/TrainTrackingSystem/New%20web/Home.php');
}
  else {

     $logerr="No account found with that Email";
     echo $logerr;
     header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");

  }
}



//$eml=mysql_real_escape_string($eml);
//$pwd=mysql_real_escape_string($pwd);




 ?>
