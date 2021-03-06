<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: Login.php");
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
   <script type="text/javascript" src="js/action2.js">

   </script>
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
      <li><a href="AdminTrain.php">Trains</a></li>
      <li><a href="station.php">Stations</a></li>
      <li><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li class="active"><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>
  <!-- end nav-->


  <div class="container">
      <h1 style="margin-left:500px">Ratings</h1>
      <br><br>
  <div class="panel panel-default">
      <div class="panel-heading" style="color:black;text-align:center"><b>CURRENT RATINGS</b></div>
      <br>
      <!--pannel form -->
      <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">

          <!-- train id selection -->
          <label id="select" for="Select">Select Train ID : </label>
          <select  name="select">
            <?php $query="SELECT train_id FROM trains"; ?>
            <?php $result= mysqli_query($connect,$query); ?>
            <?php while($row= mysqli_fetch_array($result)) { ?>
              <option selected="selected">
          <?php echo htmlspecialchars($row['train_id']); ?></option>
            <?php } ?>
          </select>
        </div>

        <!--submit button  -->
        <div class="form-group">
        <input type="submit" name="submit" class="form-control" style="background-color:#ccccb3; color:black" placeholder="Ok" >
        </div>

        <!--search bar  -->
        <div class="form-group">
        <input type="text" id="search" class="form-control"  placeholder="Search" >
        </div>

        <!--refersh button  -->
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
      <th >Email</th>
      <th >RATINGS</th>
      <th >COMMENTS</th>

    </tr>

  </thead>

  <!--retriving data for pannel table -->
  <?php
  $count=0;
  $count2=0;
  if(isset($_POST['select'])){
    $val=$_POST['select'];
    $query="SELECT rating.*,trains.name FROM rating,trains WHERE rating.train_id=trains.train_id AND rating.train_id='$val'";
    $res=mysqli_query($connect,$query);
    if(mysqli_num_rows($res)>0){

      while($row=mysqli_fetch_array($res)){
        ?>
        <tr>
          <td><?php  echo $row[1]?></td>
          <td><?php  echo $row[2]?></td>
          <td><?php  echo $row[3]?></td>
          <?php $count+=$row[2];
                $count2+=1;
           ?>
  </tr>
  <?php

  $_COOKIE['rate']=$row[4];
    }

  }
  mysqli_close($connect);
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

  <!-- display stars for rating -->
  <?php if(isset($_COOKIE['rate'])) { ?>

    <div class="">
      <label  for="train">Train name: <?php echo $_COOKIE['rate'];?></label>
    </div>
    <label  for="Overall">Overall Rating : </label>
    <?php  $var=($count/$count2);
        if ($var>=4.5 && $var<5) {
          $output='<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          echo $output;
        }
        elseif ($var>=3.5 && $var<4.5) {
          $output='<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          echo $output;
        }
        elseif ($var>=2.5 && $var<3.5) {
          $output='<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          echo $output;
        }
        elseif ($var>=1.5 && $var<2.5) {
          $output='<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          echo $output;
        }
        elseif ($var>=1 && $var<1.5) {
          $output='<span class="glyphicon glyphicon-star"></span>';
          echo $output;
        }
        else {
          echo "Rating unavilable";
        }
    ?>

  <?php }
   else{?>
     <label for="train">Train name: <?php echo"Please select TRAIN";?></label>
   <?php } ?>
  </div>
  </div>
  <script>
     getdata();
  </script>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

  </body>
</html>
