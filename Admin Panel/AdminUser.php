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

    <!--navigation bar-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li><a href="AdminReserve.php">Reservations</a></li>
      <li><a href="AdminTrain.php">Trains</a></li>
      <li><a href="station.php">Stations</a></li>
      <li class="active"><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
  </nav>

          <h1 class="left">MANAGE USER ACCOUNTS</h1>
          <br><br>

          <!--pannel for table-->

          <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading" style="color:black;text-align:center"><b>ACCOUNTS DETAILS</b></div>
              <form class="form-inline" action="index.html" method="post">
                <div class="form-group">
                <input type="text" id="search" class="form-control"  placeholder="Search" >
                </div>
                <div class="form-group">
                  <input type="button" style="color:black;background-color:#66e0ff" name="refresh" value="Refresh" class="form-control" onclick="window.location.reload();">
                  </div>
              </form>

              <div class="panel-body">
               <span id="message"></span>
               <div class="table-responsive" id="user_data">
                   <div class="tbody1">
          <div style="overflow-x:auto;">
            <table id="data" class="table table-striped">
              <thead style="color:black">
            <tr style="font-size:25px">

              <th >NAME</th>
              <th >Email</th>
              <th >PHONE</th>
              <th >NIC</th>
              <th >STATUS</th>
              <th >ACTION</th>
            </tr>

          </thead>
<!--retriving data to table rows-->
          <?php
          include('dbcon.php');
          $query='SELECT * FROM user_info';
          $result=mysqli_query($connect,$query);


      while ($row=mysqli_fetch_array($result)) {
            $status='';
            if($row[5]=='ACTIVE'){
              $status='<span class="label label-success" style="font-size:15px"> ACTIVE </span>';
            }
            else{
              $status='<span class="label label-danger" style="font-size:15px">Banned</span>';
            }
            ?>
              <tr style="font-size:20px">
                <td><?php  echo $row[0]?></td>
                <td><?php  echo $row[1]?></td>
                <td><?php  echo $row[3]?></td>
                <td><?php  echo $row[4]?></td>
                <td><?php  echo $status?></td>
                <?php if($row[5]=='ACTIVE'){?>

                <td><button id="submit_data" type="submit" name="action" class="btn btn-warning" onclick="confirmation1();cf('<?php echo $row[4]?>');refresh();">BANNED</button></td>
              <?php }
                else { ?>
                    <td><button id="submit_data" type="submit" name="action" class="btn btn-success" onclick="confirmation2(); cf('<?php echo $row[4] ?>'); refresh();">ACTIVATE</button></td>
                <?php }
                ?>

            </tr>


          <?php
          }
          ?>
        </div>
          </table>


            </div>
          </div>
        </div>
      </div>
    </div>

<?php
//set active and banned STATUS
//cookie is created in action2.js file
if(isset($_COOKIE['message']) && ($_COOKIE['nic']) ){

  include('dbcon.php');
  $data=$_COOKIE['message'];
  $nic=$_COOKIE['nic'];
  $staus='';
  if($data=="Banned"){
      $staus="BANNED";

  }
  elseif ($data=="Activated") {
      $staus="ACTIVE";
  }
  else{
    exit;
  }
  //update database with new status
  $query="UPDATE user_info SET status='$staus' WHERE nic='$nic'";
  mysqli_query($connect,$query);
  mysqli_close($connect);


}
else{
  echo "error";
}

 ?>
 <script>
    getdata();
 </script>
  </body>
</html>
