<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
?>
<!-- get db connection-->
<?php
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

   <script type="text/javascript" src="js/action2.js">

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
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li class="active"><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>
<div class="container">
  <h5>Recent Posts</h5>

</div>
<br>
<!-- Data retrive for page-->
<?php
$query="SELECT * FROM news ORDER BY news_id DESC";
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0){
  while ($row=mysqli_fetch_array($result)) {?>
    <div class="container">
      <div class="well">
          <div class="media">
    		      <div id='row' class="media-body">
      		        <h4 class="media-heading"><?php echo $row[1]; ?></h4>
                  <p class="adder">By <?php echo "". $row[3] ?></p>
                  <br>
                  <p><?php echo $row[2] ?></p>
                  <br>
                  <ul class="list-inline list-unstyled">
    			             <li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo $row[4]?></span></li>

  			                </ul>
                      </div>
                    </div>
                    <?php if ($row[5]!="VERIFIED") {?>
                      <div class="button1">
                        <button id="btn1" type="submit" name="btn_verify" class="btn btn-success" onclick="verify('<?php echo $row[0]?>')">VERIFY</button>
                      </div>
                  <?php  } ?>
                    <div class="button1">
                      <button id="btn2" type="submit" name="btn_delete" class="btn btn-danger" onclick="deleterow('<?php echo $row[0]?>')">DELETE</button>
                    </div>
                  </div>
                </div>
            <?php  }
     }
     else {
       echo " Data not found";
     }
        ?>
<!-- End of php for data retriving-->

<!-- delete and verify-->
<?php
if(isset($_COOKIE['verify'])) {
  $data=$_COOKIE['verify'];
  $data2=(int)$data;
  $query1="UPDATE news SET verify='VERIFIED' WHERE news_id='$data2'";
  mysqli_query($connect,$query1);
  //mysqli_close($connect);
}
else{
  echo "error";
}

if(isset($_COOKIE['delete'])){
    $del=$_COOKIE['delete'];
    $del2=(int)$del;
    echo $del2;
    echo $del;
    $query2="DELETE FROM news WHERE news_id='$del'";
    mysqli_query($connect,$query2);
    //mysqli_close($connect);
}
else{
  echo "error";
}






 ?>

<!--end delete and verify-->
  </body>
</html>
