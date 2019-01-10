<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
include('dbcon.php');
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

    <!--navigation-->
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

<!--train add form-->
<div class="container">
<div class="form-style-5">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="border">
<fieldset>
  <legend><span class="number"></span>ADD NEW TRAIN</legend>
                <label for="train"><span class="req"></span> Train ID: </label>
                    <input  type="text" name="train" id = "txt"  required />
                <label for="tname"><span class="req"></span> Train Name: </label>
                    <input  type="text" name="tname" id = "txt"   required />
              <input  type="submit" name="submit_reg" value="NEXT">
          </fieldset>
        </form>
      </div>
    </div>

    <!--insert details to train table-->
    <?php
    if(isset($_POST['train'],$_POST['tname'])){
      $tr=$_POST['train'];
      $_SESSION['tid']=$tr;
      $name=$_POST['tname'];
      $query="INSERT INTO trains (train_id,name) VALUES('".$tr."','".$name."')";
      mysqli_query($connect,$query);
      header('location:addstations.php');
    }
    else{
      echo "<script type='text/javascript'>alert('fields are empty')</script>";
    }

     ?>
</body>
</html>
