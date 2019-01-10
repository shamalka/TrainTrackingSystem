<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
<script type="text/javascript" src="js/script.js">

</script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="design/style2.css">
    <title></title>
  </head>
  <!--navigation  -->
  <body onload="renderTime();">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="Home.php">Home</a></li>
          <li><a href="AdminReserve.php">Reservations</a></li>
          <li><a href="AdminTrain.php">Trains</a></li>
          <li><a href="station.php">Stations</a></li>
          <li><a href="AdminUser.php">Users</a></li>
          <li><a href="AdminNews.php">Add News</a></li>
          <li><a href="AdminRating.php">Ratings</a></li>
          <li><a href="ViewNews.php">News & Notifications</a></li>
          <li><a href="Admin.php">Make An Admin</a></li>
        </ul>
      </div>
    </nav>
    <!--end navigation  -->

    <!--display time in home  -->
    <div id="clock" class="date">

  </div>
  <div class="container">

<!--admin info card  -->
    <div class="card">
      <img src="img/633.jpg" alt="Avatar" style="width:100%">
      <div class="container">
        <h2><b><?php echo $_SESSION['firstname'].' '. $_SESSION['lastname']; ?></b></h2>
        <p><?php echo "System admin"; ?></p>
        <form class="" action="logout.php " method="post">
          <div class="Button1">
          <p><button type="submit" name="logout">Logout</button></p>
        </form>
<!--end admin info card  -->

        </div>
      </div>
    </div>
  </body>
</html>
