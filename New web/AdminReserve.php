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
    <link rel="stylesheet" href="design/basic.css">
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
   integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
   crossorigin="anonymous">
   </script>
   <script type="text/javascript" src="js/action.js"></script>
   <script type="text/javascript" src="js/action2.js"></script>
    <title></title>
  </head>
  <body>
    <!-- navgation bar  -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li class="active"><a href="AdminReserve.php">Reservations</a></li>
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
<!-- end navigation  -->

<!--pannel  -->
<div class="container">
  <h1 style="margin-left:350px">MANAGE RESERVATIONS</h1>
  <br><br>
<div class="panel panel-default">
    <div class="panel-heading" style="color:black;text-align:center"><b>CURRENT RESERVATIONS</b></div>
    <br>
    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

      <!--train id select /getting data for options  -->
      <div class="form-group">
        <label id="select" for="Select">Select Train ID : </label>
        <select  name="select">
          <?php $query="SELECT train_id FROM trains"; ?>
          <?php $result= mysqli_query($connect,$query); ?>
          <?php while($row= mysqli_fetch_array($result)) { ?>
              <option value='<?php echo $row['train_id'];?>'><?php echo $row['train_id']; ?>  </option>
          <?php } ?>
        </select>
      </div>

      <!-- submit button -->
      <div class="form-group">
      <input type="submit" name="submit" class="form-control" style="background-color:#ccccb3; color:black" placeholder="Ok" >
      </div>

      <!--search bar  -->
      <div class="form-group">
      <input type="text" id="search" class="form-control"  placeholder="Search" >
      </div>

      <!-- refresh button -->
      <div class="form-group">
        <input type="button" style="color:black;background-color:#66e0ff" name="refresh" value="Refresh" class="form-control" onclick="window.location.reload();">
        </div>
    </form>

    <!--pannel table  -->
    <div class="panel-body">
     <span id="message"></span>
     <div class="table-responsive" id="user_data">
       <div class="tbody1">
<div style="overflow-x:auto;">
  <table id="data" class="table table-striped">
    <thead style="color:black">
  <tr>
    <th >ID</th>
    <th >USER EMAIL</th>
    <th >FIRST CLASS</th>
    <th >SECOND CLASS</th>
    <th >THIRD CLASS</th>
    <th >DATE</th>
    <th >START STATION</th>
    <th >END STATION</th>
    <th >ARRIVAL TIME</th>
    <th >PAYMENT</th>
    <th >STATUS</th>
    <th> ACTION</th>
  </tr>

</thead>

<!-- retriving- data to table -->
<?php
if(isset($_POST['select'])){
  $val=$_POST['select'];
  $query="SELECT reservations.*,trains.name FROM reservations,trains WHERE reservations.train_id=trains.train_id AND reservations.train_id='$val' ORDER BY reservations.reservation_id DESC";
  $res=mysqli_query($connect,$query);
  if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_array($res)){
      $status='';
      if($row[11]=='PAID'){
        $status='<span class="label label-success" style="font-size:12px"> PAID </span>';
      }
      elseif($row[11]=='PENDING'){
        $status='<span class="label label-warning" style="font-size:12px">PENDING</span>';
      }
      else{
        $status='<span class="label label-danger" style="font-size:12px">CANCELED</span>';
      }
      ?>
      <tr style="font-size:20px">
        <td><?php  echo $row[0]?></td>
        <td><?php  echo $row[2]?></td>
        <td><?php  echo $row[3]?></td>
        <td><?php  echo $row[4]?></td>
        <td><?php  echo $row[5]?></td>
        <td><?php  echo $row[10]?></td>
        <td><?php  echo $row[7]?></td>
        <td><?php  echo $row[8]?></td>
        <td><?php  echo $row[9]?></td>
        <td><?php  echo $row[6]?></td>
        <td><?php  echo $status?></td>
        <?php if($row[11]=='CANCEL'){ ?>
          <td><button id="submit" type="submit" name="action" class="btn btn-danger" onclick="deleterow2('<?php echo $row[0]?>')">DELETE</button></td></td>
        <?php } ?>
</tr>
<?php
$_COOKIE['vvv']=$row[12];
  }
}
}

else{
  //echo "<script type='text/javascript'>alert('Please select train')</script>";
}

 ?>

</div>
</table>

</div>
</div>
</div>

<!-- display train name in bottom  -->
<?php if(isset($_COOKIE['vvv'])) {?>
  <label for="train">Train name: <?php echo $_COOKIE['vvv'];?></label>
<?php }
 else{?>
   <label for="train">Train name: <?php echo"Please select TRAIN";?></label>
 <?php } ?>
</div>
</div>

<!--row deleting  -->
<?php
//cookie is set by js function (action2.js)
if(isset($_COOKIE['delete'])){
    $del=$_COOKIE['delete'];
    $query2="DELETE FROM reservations WHERE reservation_id='$del'";
    mysqli_query($connect,$query2);

}
else{
  echo "error";
}
mysqli_close($connect);
 ?>

 <!-- search bar  -->
<script>
   getdata();
</script>
  </body>
</html>
