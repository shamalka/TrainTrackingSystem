<?php
session_start();
echo $_SESSION['message'];
if(isset($_POST['msg'])){
  echo"bla";
  include('dbcon.php');
  $data=$_POST['msg'];
  if($data=="confirmed"){

  }
  elseif ($data=="Activated") {

  }
  else{

  }
}
else{
  echo "error";
}




 ?>
