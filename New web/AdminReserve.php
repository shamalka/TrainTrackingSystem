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
    <link rel="stylesheet" href="design/basic.css">
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
   integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
   crossorigin="anonymous">
   </script>
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li class="active"><a href="AdminReserve.php">Reservations</a></li>
      <li><a href="AdminTrain.php">Trains</a></li>
      <li><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>

<h1 class="left">MANAGE RESERVATIONS</h1>
<br><br>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading" style="color:black;text-align:center"><b>CURRENT RESERVATIONS</b></div>
    <div class="panel-body">
     <span id="message"></span>
     <div class="table-responsive" id="user_data">
<div style="overflow-x:auto;">
  <table class="table table-striped">
    <thead style="color:black">
  <tr>
    <th >ID</th>
    <th >TRAIN</th>
    <th >USER</th>
    <th >FIRST CLASS</th>
    <th >SECOND CLASS</th>
    <th >THIRD CLASS</th>
    <th >DATE</th>
    <th >STATUS</th>
    <th >PAYMENT</th>
    <th >ACTION</th>
  </tr>

</thead>
  </body>
</html>