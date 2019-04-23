<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location:Login.php");
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
    <link rel="stylesheet" href="design/basic.css">
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
    <!--  -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li><a href="AdminReserve.php">Reservations</a></li>
      <li class="active"><a href="AdminTrain.php">Trains</a></li>
      <li><a href="station.php">Stations</a></li>
      <li><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>
<!--navigation  -->
<div class="container">
  <h1 style="margin-left:400px">MANAGE TRAINS</h1>
<div class="panel panel-default">
    <div class="panel-heading" style="color:black;text-align:center"><b>TRAIN DETAILS</b></div>
<br>
    <form class="form-inline"  method="post">

      <!--add tarin button  -->
      <label id="select" for="Select">ADD NEW TRAIN: </label>
      <input type="button" style="color:black;background-color:#66e0ff;" name="addtrain" value="ADD TRAIN" class="form-control" onclick="window.location.href='addtrain.php'">

      <!--search bar  -->
      <div class="form-group">
      <input type="text" id="search" class="form-control"  placeholder="Search" >
      </div>

      <!--refresh button  -->
      <div class="form-group">
        <input type="button" style="color:black;background-color:#66e0ff" name="refresh" value="Refresh" class="form-control" onclick="window.location.reload();">
        </div>
    </form>

<!-- pannel table  -->
    <div class="panel-body">
     <span id="message"></span>
     <div class="table-responsive" id="user_data">
         <div class="tbody1">
<div style="overflow-x:auto;">
  <form action="manage.php" method="post">


  <table id="data" class="table table-striped">
    <thead style="color:black">
  <tr style="font-size:20px">

    <th >TRAIN ID</th>
    <th >NAME</th>
    <th >STATIONS</th>
    <th >MORE DETAILS</th>
  </tr>
</thead>

<!-- retriving data from db to table rows  -->
<?php
$query='SELECT trains.train_id,trains.name,stations.stations FROM trains,stations WHERE trains.train_id=stations.train_id';
$result=mysqli_query($connect,$query);


while ($row=mysqli_fetch_array($result)) {?>
    <tr style="font-size:18px">
      <td><?php  echo $row[0]?></td>
      <td><?php  echo $row[1]?></td>
      <td><?php  echo $row[2]?></td>
      <td><button id="submit_data" type="submit" name="action" class="btn btn-warning" value="<?php echo $row[0]; ?>" onclick="window.location.href='manage.php'">click here</button></td>
  </tr>


<?php
}
?>
        </table>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>

<!-- function for search table data  -->
<script type="text/javascript">
//action2.js
  getdata();
</script>
  </body>
</html>
