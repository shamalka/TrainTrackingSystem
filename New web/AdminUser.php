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


<!--<script type="text/javascript" src="js/action2.js"></script>-->
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
          <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading" style="color:black;text-align:center"><b>ACCOUNTS DETAILS</b></div>
              <div class="panel-body">
               <span id="message"></span>
               <div class="table-responsive" id="user_data">
          <div style="overflow-x:auto;">
            <table class="table table-striped">
              <thead style="color:black">
            <tr>
              <th >USER ID</th>
              <th >NAME</th>
              <th >NIC</th>
              <th >EMAIL</th>
              <th >PHONE</th>
              <th >ADDRESS</th>
              <th >PASSWORD</th>
              <th >STATUS</th>
              <th >ACTION</th>
            </tr>

          </thead>
          <?php
          include('dbcon.php');
          $query='SELECT * FROM user';
          $result=mysqli_query($connect,$query);


      while ($row=mysqli_fetch_array($result)) {
            $status='';
            if($row[7]=='ACTIVE'){
              $status='<span class="label label-success"> ACTIVE </span>';
            }
            else{
              $status='<span class="label label-danger">Banned</span>';
            }
            ?>

              <tr>
                <td><?php  echo $row[0]?></td>
                <td><?php  echo $row[1]?></td>
                <td><?php  echo $row[2]?></td>
                <td><?php  echo $row[3]?></td>
                <td><?php  echo $row[4]?></td>
                <td><?php  echo $row[5]?></td>
                <td><?php  echo $row[6]?></td>
                <td><?php  echo $status?></td>
                <?php if($row[7]=='ACTIVE'){?>
                <td><button type="submit" name="action" class="btn btn-danger" onclick="confirmation1()">BANNED</button></td>
              <?php }
                else { ?>
                    <td><button type="submit" name="action" class="btn btn-success" onclick="confirmation2()">ACTIVATE</button></td>
                <?php } ?>

            </tr>

          <?php
          }
          ?>
          </table>


            </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">

    function confirmation1() {
      var msg;
      var r = confirm("Are you sure you want to BANNED this account!");
      if (r == true) {
        msg="confirmed";
        document.cookie="message=Banned";
        location.reload();
      /*  $(document).ready(function(){
          $("button").click(function(){
        $.ajax({
           url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
           method:"POST",
           data:{msg:msg},
         });
       });
     });*/
   }
      else {
        msg = "Canceled!";
        document.cookie="message=Cancelled";
        location.reload();
      }


      document.getElementById("message").innerHTML = msg;
    }

    function confirmation2() {
      var msg;

      var r = confirm("Are you sure you want to ACTIVE this account!");
      if (r == true) {
        msg="Activated";
        document.cookie="message=Activated";
        location.reload();
      /* $(document).ready(function(){
          $("button").click(function(){
        $.ajax({
          url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
          method:"POST",
          data:{msg:msg},
        });
      });
    });*/
      }
      else {
        msg = "Canceled!";
        document.cookie="message=Cancelled";
        location.reload();
      }

      document.getElementById("message").innerHTML = msg;
    }


</script>
<?php
$data=$_COOKIE['message'];
echo $data;
 ?>
  </body>
</html>
