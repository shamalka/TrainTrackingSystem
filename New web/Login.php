
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
    <link rel="stylesheet" href="design/style.css">
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>SRILANKA RAILWAY DEPARTMENT</title>
  </head>

  <body class="bodys">

    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> TRAIN TRACKING & RESERVATION SYSTEM </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="img/AWT-Train.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='POST'>
      <input type="email" id="login" class="fadeIn second" name="Email" placeholder="Email">
        <span id="error_message" class="text-danger"></span>
      <input type="password" id="password" class="fadeIn third" name="psw" placeholder="password">
        <div >
        <span id="error_message" class="text-danger">
        </div>
      <div >
      <input type="submit" class="fadeIn fourth" name="log" value="Log In">
    </div>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
<!--  -->
<?php
include('dbcon.php');
if(isset($_POST["log"]))
 {
      if(empty($_POST["Email"]) && empty($_POST["psw"]))
      {
           echo '<script>alert("Both Fields are required")</script>';
      }
      elseif (empty($_POST['Email'])) {
         echo '<script>alert("Email is required")</script>';
      }
      elseif(empty($_POST['psw'])){
         echo '<script>alert("Passowrd is required")</script>';
      }
      else
      {
           $Email = mysqli_real_escape_string($connect, $_POST["Email"]);
           $password = mysqli_real_escape_string($connect, $_POST["psw"]);
           $query = "SELECT * FROM loginfo WHERE Email = '$Email'";
           $result = mysqli_query($connect, $query);
           if(mysqli_num_rows($result) > 0)
           {
                while($row = mysqli_fetch_array($result))
                {
                     if($password==$row['password'])
                     {
                          //return true;
                          session_start();
                          $_SESSION['email']=$Email;
                          $_SESSION['firstname']=$row['firstname'];
                          $_SESSION['lastname']=$row['lastname'];
                          header('location:Home.php');
                     }
                     else
                     {

                          echo '<script>alert("Invalid User Details")</script>';
                     }
                }
           }
           else
           {
                echo '<script>alert("Invalid details")</script>';
           }
      }
 }
?>
  </body>
</html>
