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

    <!---->
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

<!--navigation bar-->
<div class="container">
<div class="form-style-5">
  <fieldset>
    <legend><span class="number"></span>ADD STATIONS</legend>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="border">
              <label for="stations">Stations:</label>
              <select  name="select">
                <?php $query="SELECT name FROM station_names"; ?>
                <?php $result= mysqli_query($connect,$query); ?>
                <?php while($row= mysqli_fetch_array($result)) { ?>
                    <option value='<?php echo $row['name'];?>'><?php echo $row['name']; ?>  </option>
                <?php } ?>
              </select>
              <label for="lastname"><span class="req">* </span> Arrival time: </label>
                  <input type="text" name="Atime" id = "txt"   required />
              <label for="lastname"><span class="req">* </span> Departure time: </label>
                  <input  type="text" name="Dtime" id = "txt"   required />
              <label for="lastname"><span class="req">* </span> First class ticket price: </label>
                  <input  type="text" name="fctp" id = "txt"   required />
              <label for="lastname"><span class="req">* </span> Second class ticket price: </label>
                  <input  type="text" name="sctp" id = "txt"   required />
              <label for="email"><span class="req">* </span> Third class ticket price: </label>
                  <input  required type="text" name="tctp" id = "email"  />
                      <div class="status" ></div>
              <input class="btn btn-success" type="submit" name="submit_reg" value="ADD">
            </fieldset>
        </form>
        <fieldset>
          <input type="submit" name="submit_reg" value="NEXT" onclick="window.location.href='addseats.php'">
        </fieldset>

        </div>
      </div>

      <!--insert data to ticket price table-->
      <?php
      $arr2='';
      $ss='';
      if(isset($_POST['Atime'],$_POST['Dtime'],$_POST['fctp'],$_POST['sctp'])){
        $arrival=$_POST['Atime'];
        $dep=$_POST['Dtime'];
        $fc=$_POST['fctp'];
        $sc=$_POST['sctp'];
        $tc=$_POST['tctp'];
        $ss=$_SESSION['tid'];
        $select=$_POST['select'];
        $query="INSERT INTO ticket_price (train_id,station,arrival_time,departure_time,first_class_price,second_class_price,third_class_price) VALUES('".$ss."','".$select."','".$arrival."'
      ,'".$dep."','".$fc."','".$sc."','".$tc."')";
        mysqli_query($connect,$query);
        //header('location:addstations.php');
      }
      else{
        echo "<script type='text/javascript'>alert('Fill all the fields')</script>";
      }

      //create string of added stations
      $query2="SELECT station FROM ticket_price WHERE train_id='$ss'";
      $result=mysqli_query($connect,$query2);
      while($row=mysqli_fetch_array($result)){
        if(empty($arr2)){
          $arr2=$row['station'];
        }
        else{
        $arr2=$arr2.','.$row['station'];}
      }
      $_SESSION['arr']=$arr2;
      ?>
  </body>
</html>
