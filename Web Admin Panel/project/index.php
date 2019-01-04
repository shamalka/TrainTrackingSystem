<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style2.css" media="style2">
	<link rel="stylesheet" type="text/css" href="styles.css" media="styles">
	<link rel="stylesheet" type="text/css"  href="st.css" media="st">
	<link rel="stylesheet" type="text/css" href="/css/master.css">
<style>

@import url('https://fonts.googleapis.com/css?family=Poppins');

/* BASIC */

</style>
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> TRAIN TRACKING & RESERVATION SYSTEM </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action='login.inc.php' method='POST'>
      <input type="text" id="login" class="fadeIn second" name="userid" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="pwd" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>

</body>
</html>
