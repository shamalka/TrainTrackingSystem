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
          <li><a href="AdminReserve.php">Reservations</a></li>
          <li><a href="AdminTrain.php">Trains</a></li>
          <li><a href="AdminUser.php">Users</a></li>
          <li class="active"><a href="AdminNews.php">Add News</a></li>
          <li><a href="AdminRating.php">Ratings</a></li>
          <li><a href="ViewNews.php">News & Notifications</a></li>
          <li><a href="Admin.php">Make An Admin</a></li>
        </ul>
      </div>
    </nav>
       <?php date_default_timezone_set('Asia/Colombo'); ?>

						<br><br><br>
						<div class="container">
              <h3>ADD NEW NEWS</h3>
              <br>
              <br>
              <form class="border">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="title" class="form-control" name="title" placeholder="Title">
                </div>
                <br>
                <div class="form-group">
                  <label for="Date">Date </label>
                  <input type ="text" id="time" name="time" value="<?php $date=getdate(date("U"));
echo "$date[weekday], $date[month] $date[mday], $date[year]";?>"/>
                  </div>
                  <br>

                <div class="form-group">
                  <label for="Time">Time </label>
                  <input type="text" name="time" id="time" value="<?php echo date("h:i:sa"); ?>"/>
                </div>
                <input type="button" class="btn btn-info" value="refresh" onclick='window.location.reload();'></input>
                <br>
                <br>
                <div class="form-group">
                  <label for="Date">Added By: </label>
                  <select class="" name="add">
                    <option value="2018">Admin</option>
                    <option value="2018">Reservation manager</option>
                    <option value="2018">Operator</option>
                  </select>
                  </div>
                  <br>
                  <div class="form-group">
								     <label for="tarea">DESCRIPTION (max 1000 characters)</label>
								     <textarea class="form-control" rows="20" name"desc" id="tarea" placeholder="Description"></textarea>
							    </div>
							    <br>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>


  </body>
</html>
