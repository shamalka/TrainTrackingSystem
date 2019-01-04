<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TRAIN TRACKING & RESERVATION SYSTEM</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css" media="style2">
<link rel="stylesheet" type="text/css" href="styles.css" media="styles">
<link rel="stylesheet" type="text/css"  href="st.css" media="st">
<link rel="stylesheet" type="text/css" href="/css/master.css">


<style>

@import url('https://fonts.googleapis.com/css?family=Poppins');


* { padding:0; margin:0; outline:0; }

body {
  margin: 0 auto;
  font-family: "Poppins";
  background-image: linear-gradient(-45deg, #85b6da, #d4eff5);

}






h1, h2, h3, h4, h5 { font-family: "Poppins"; padding-bottom:8px; }
h1 { font-size:18px; line-height:22px; }
h2 { font-size:17px; line-height:21px; }
h3 { font-size:16px; line-height:20px; }
h4 { font-size:15px; line-height:19px; }
h5 { font-size:14px; line-height:18px; }
h6 { font-size:12px; line-height:16px; padding-bottom:5px; }



</style>
</head>
<body>

	<div id="header">

			<div id="head">
				<h1>TRAIN TRACKING & RESERVATION SYSTEM</h1>
				<div class="right">
					<p><a href="#"><strong>
						<?php
								if (isset($_SESSION['userid'])) {
									echo "You are logged in as ".$_SESSION['userid'];
								} else {
									echo "You are not logged in !";
								}

							?>
						</strong></a> |
						<a href="404.html">Help</a> |
						<a href="#">Profile</a> |
						<a href = 'index.php'>LOG OUT</a>
					</p>
				</div>
			</div>

</html>
