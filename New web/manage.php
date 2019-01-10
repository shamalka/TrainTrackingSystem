<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location:Login.php");
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

<!--get details from database tables to edit form-->
<?php
$tid=$_POST['action'];
$_SESSION['trainid']=$tid;
include('dbcon.php');
$query="SELECT trains.name,stations.stations,seats.* FROM trains,stations,seats WHERE trains.train_id=stations.train_id AND stations.train_id=seats.train_id AND trains.train_id='$tid'";
$res=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($res);
 ?>

 <!--form design-->
<div class="container">
<div class="form-style-5">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="border">
            <legend><span class="number"></span>EDIT DETAILS</legend>
            <fieldset>
              <label for="firstname"><span class="req"></span> Name: </label>
                  <input  type="text" value="<?php echo $row['name']; ?>"name="name" id = "txt"  required />
              <label for="lastname"><span class="req"></span> Stations: </label>
                  <input  type="text" value="<?php echo $row['stations']; ?>" name="station" id = "txt"   required />
              <label for="lastname"><span class="req"></span> First class seats: </label>
                  <input  type="text" value="<?php echo $row['first_class_seats']; ?>"name="fcs" id = "txt"   required />
              <label for="lastname"><span class="req"></span> Second class seats: </label>
                  <input  type="text" value="<?php echo $row['second_class_seats'] ?>"name="scs" id = "txt"   required />
              <label for="lastname"><span class="req"></span> Third class seats: </label>
                  <input  type="text" value="<?php echo $row['third_class_seats'] ?>"name="tcs" id = "txt"   required />
              <input  type="submit" name="submit_reg" value="UPDATE">
          </fieldset>
        </form>
      </div>
    </div>

    <!--update database-->
    <?php
    if(isset($_POST['name'],$_POST['station'],$_POST['fcs'],$_POST['scs'],$_POST['tcs'])){
      $name=$_POST['name'];
      $sta=$_POST['station'];
      $fc=$_POST['fcs'];
      $sc=$_POST['scs'];
      $tc=$_POST['tcs'];
      $query2="UPDATE trians SET name=['$name'] WHERE train_id='$tid'";
      $query3="UPDATE stations SET stations=['$sta'] WHERE train_id='$tid'";
      $query4="UPDATE seats SET first_class_seats=['$fc'],second_class_seats=['$sc'], third_class_seats=['$tc'] WHERE train_id='$tid'";
      mysqli_query($connect,$query2);
      mysqli_query($connect,$query3);
      mysqli_query($connect,$query4);
      header('location:manage2.php');

    }
    else{
      echo "<script type='text/javascript'>alert('fill all fields')</script>";
    }
     ?>
</body>
</html>
