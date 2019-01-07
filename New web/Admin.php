<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: http://localhost/TrainTrackingSystem/New%20web/Login.php");
    exit;
}
else{
  $fnameerr=$lnameerr=$emailerr=$passw1err=$passw2err="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('dbcon.php');
    if(empty($_post['firstname'])){
        $fnameerr="This field is required";
    }
    else{
      if (!preg_match("/^[a-zA-Z ]*$/",$_POST['firstname'])) {
        $fnameerr = "Only letters and white space allowed";
      }
      else{
        $fname=mysqli_escape_string($connect,$_POST['firstname']);
      }

    }
    if(empty($_POST['lastname'])){
          $lnameerr="This field is required";
    }
    else{
      if (!preg_match("/^[a-zA-Z ]*$/",$_POST['lastname'])) {
        $fnameerr = "Only letters and white space allowed";
      }
      else{
        $lname=mysqli_escape_string($connect,$_POST['lastname']);
      }

    }
    if(empty($_POST['email'])){
        $emailerr="This field is required";
    }
    else{
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $emailerr = "Invalid email format";
      }
      else {
        $email=mysqli_escape_string($connect,$_POST['email'])
      }

    }
    if(empty($_post['password'])){
        $passw1err="Password field cannot be empty";
    }
    else{
      $pass1=mysqli_real_escape_string($connect,$_POST['password']);

    }
    if(empty($_post['passwordagain'])){
        $passw2err="This field cannot be empty";
    }
    else{
        $pass2=mysqli_real_escape_string($connect,$_POST['passwordagain']);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li class="active"><a href="Admin.php">Make An Admin</a></li>
    </div>
    </ul>
  </nav>

  <div class="container">
    <h3>Add New Admin</h3>
    <br>
	<div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="border">

            <div class="form-group">
                <label for="firstname"><span class="req">* </span> First name: </label>
                    <input class="form-control" type="text" name="firstname" id = "txt"  required />

            </div>

            <div class="form-group">
                <label for="lastname"><span class="req">* </span> Last name: </label>
                    <input class="form-control" type="text" name="lastname" id = "txt"   required />

            </div>

            <div class="form-group">
                <label for="email"><span class="req">* </span> Email Address: </label>
                    <input class="form-control" required type="text" name="email" id = "email"  />
                        <div class="status" ></div>
            </div>


            <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                    <input  name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"   /> </p>

                <label for="password"><span class="req">* </span> Password Confirm: </label>
                    <input  name="passwordagain" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Enter again to validate"   />
                        <span id="confirmMessage" class="confirmMessage"></span>
            </div>


            <div class="form-group">
                <input class="btn btn-success" type="submit" name="submit_reg" value="Register">
            </div>


            </fieldset>
            </form><!-- ends register form -->
</div>
</div>
  </body>
</html>
