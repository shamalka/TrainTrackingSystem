<?php

session_start();
include ('dbcon.php');
if (isset($_POST['Email']) && isset($_POST['psw'])) {}


  $emlerr='';
  $pswerr='';
  $logerr='';

  if (empty($_POST['Email'])) {
    $emlerr="Email Field cannot be empty";
      }
  else {
    $eml= $_POST['Email'];
    $eml=stripcslashes($eml);
      }

  if (empty($_POST['psw'])) {
    $pswerr="Password field cannot be empty";
  }
  else{
    $pwd = $_POST['psw'];
    $pwd=stripslashes($pwd);
  }
if (empty($emlerr) && empty($pswerr)) {
  $sql = "SELECT * FROM logininfo WHERE Email = '$eml'";
  $result = mysqli_query($connect,$sql);
  $row=mysqli_fetch_assoc($result);

  if($pwd==$row['password']) {
    session_start();
    $_SESSION['email']=$eml;
    $_SESSION['username']=$row['username'];
    $_SESSION['position']=$row['positiion'];
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
