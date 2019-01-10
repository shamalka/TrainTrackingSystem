<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
include('dbcon.php');
if(isset($_SESSION['arr'])){
  $tid=$_SESSION['tid'];
  $ar=$_SESSION['arr'];
  $query="INSERT INTO stations (train_id,stations) VALUES('".$tid."','".$ar."')";
  mysqli_query($connect,$query);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">

    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="design/form.css">
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
   integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
   crossorigin="anonymous">
   </script>
   <script type="text/javascript" src="js/action2.js"></script>
   <script type="text/javascript" src="js/action.js"></script>
    <title></title>
  </head>
  <body>

    <!--navigation bar-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li><a href="AdminReserve.php">Reservations</a></li>
      <li class="active"><a href="AdminTrain.php">Trains</a></li>
      <li><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>

<!--form for add seats-->

<div class="container">
<div class="form-style-5">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="border">
            <legend><span class="number"></span>ADD SEATS</legend>
            <fieldset>
              <label for="firstname"><span class="req"></span> First class seats: </label>
                  <input  type="text" name="fcs" id = "txt"  required />
              <label for="lastname"><span class="req"></span> Second class seats: </label>
                  <input  type="text" name="scs" id = "txt"   required />
              <label for="lastname"><span class="req"></span> Third class seats: </label>
                  <input  type="text" name="tcs" id = "txt"   required />
              <input  type="submit" name="submit_reg" value="FINISH" >
          </fieldset>
        </form>
      </div>
    </div>

<!--add seats for databse-->
    <?php
    if(isset($_POST['fcs'])){
      $td=$_SESSION['tid'];
      $fcs=$_POST['fcs'];
      $scs=$_POST['scs'];
      $tcs=$_POST['tcs'];
      $sbs=$_POST['sbs'];
      $ob=$_POST['os'];
      for($x=1; $x <= $fcs; $x++){
            if($x < $fcs){
                $a = "F".$x;
                $b = ",";
                $f_c = $f_c.$a.$b;
            }else{
                $a = "F".$x;
                $f_c = $f_c.$a;
            }
        }
        for($x=1; $x <= $scs; $x++){
            if($x < $scs){
                $a = "S".$x;
                $b = ",";
                $s_c = $s_c.$a.$b;
            }else{
                $a = "S".$x;
                $s_c = $s_c.$a;
            }
        }
        for($x=1; $x <= $tcs; $x++){
            if($x < $tcs){
                $a = "T".$x;
                $b = ",";
                $t_c = $t_c.$a.$b;
            }else{
                $a = "T".$x;
                $t_c = $t_c.$a;
            }
        }

    $sql1 = "INSERT INTO seats(train_id, first_class_seats, second_class_seats, third_class_seats) VALUES ('".$td."','".$f_c."','".$s_c."','".$t_c."')";
    mysqli_query($connect,$sql1);
    header('location:AdminTrain.php');
    }
    else{
      echo "<script type='text/javascript'>alert('fill all the fields')</script>";
    }
     ?>
  </body>
</html>
