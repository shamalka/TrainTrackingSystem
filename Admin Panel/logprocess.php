<?php

include ('dbcon.php');
  $emlerr='';
  $pswerr='';
  $logerr='';
//if(isset($_POST['log'])){}
  if (empty($_POST['Email'])) {
    $emlerr="Email Field cannot be empty";
    echo $emlerr;
    //$_SESSION['emlerr']=$emlerr;
    //header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
      }
  else {
    $eml= $_POST['Email'];
    $eml=mysqli_escape_string($connect,$eml);
      }

  if (empty($_POST['psw'])) {
    $pswerr="Password field cannot be empty";
    echo $pswerr;
    //$_SESSION['pswerr']=$pswerr;
    //header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
  }
  else{
    $pwd = $_POST['psw'];
    $pwd=mysqli_escape_string($connect,$pwd);
    $phashes=password_hash($pwd,PASSWORD_DEFAULT);
  }
if (isset($_POST['Email'],$_POST['psw'])) {
  $sql = "SELECT * FROM loginfo WHERE Email = '$eml'";
  $result = mysqli_query($connect,$sql);
  $row=mysqli_fetch_assoc($result);

    if(password_verify("'.$pwd.'",$row['password'])){
    session_start();
    $_SESSION['email']=$eml;
    $_SESSION['firstname']=$row['firstname'];
    $_SESSION['lastname']=$row['lastname'];
    header('location:http://localhost/TrainTrackingSystem/New%20web/Home.php');
  }
    else {

     $logerr="No account found with that Email";
     header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");

  }
}

/*else{
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
}*/



//$eml=mysql_real_escape_string($eml);
//$pwd=mysql_real_escape_string($pwd);




 ?>
