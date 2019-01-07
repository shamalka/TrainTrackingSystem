
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
    <form action='logprocess.php' method='POST'>
      <input type="email" id="login" class="fadeIn second" name="Email" placeholder="Email">
      <?php if(isset($_SESSION['emalerr'])){?>
        <span id="error_message" class="text-danger">'<?php echo $_SESSION['emlerr']?>'</span>
  <?php   unset($_SESSION['emlerr']);} ?>
      <input type="password" id="password" class="fadeIn third" name="psw" placeholder="password">
      <?php if(isset($_SESSION['pswerrlerr'])){ ?>
        <div >
        <span id="error_message" class="text-danger">'<?php  echo $_SESSION['pswerr']?>'</span>
        </div>
      <?php unset($_SESSION['pswerr']);} ?>
      <div >
      <input type="submit" class="fadeIn fourth" value="Log In">
    </div>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>



  </body>
</html>
