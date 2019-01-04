<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TRAIN TRACKING & RESERVATION SYSTEM</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

@import url('https://fonts.googleapis.com/css?family=Poppins');


* { padding:0; margin:0; outline:0; }

body {
  margin: 0 auto;
  font-family: "Poppins";
  background-image: linear-gradient(-45deg, #85b6da, #d4eff5);
  
}


.left { float:left; display:inline; }
.right { float:right; display:inline; }


.shell { width: 1300px; 
		margin:0 
		auto; 
		
}

h1, h2, h3, h4, h5 { font-family: "Poppins"; padding-bottom:8px; }
h1 { font-size:18px; line-height:22px; }
h2 { font-size:17px; line-height:21px; }
h3 { font-size:16px; line-height:20px; }
h4 { font-size:15px; line-height:19px; }
h5 { font-size:14px; line-height:18px; }
h6 { font-size:12px; line-height:16px; padding-bottom:5px; }

#header { background:#56baed; height:100px; }
#header h1{ float:left; white-space:nowrap; padding-top:8px; padding-left:100px; padding-right:12px; font-size:25px; line-height:35px; color:#fff;}
#header a{ color:#fff }
#header a:hover{ color:#a1adc7; }

#header #head { height:43px; overflow:hidden; }
#header .right { color:#fff; white-space:nowrap; font-size:13px; }
#header .right p{ padding-top:12px; padding-right:100px;}
#header .right a strong{ text-decoration: underline; }

.topnav {
  overflow: hidden;
  background-color: #56baed;
  padding-top: 15px;
  padding-left: 100px;
}

.topnav a {
  float: left;
  display: block;
  color: #56baed;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.active {
  background-color: #111863;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

.button {
    background-color: #111863; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    width: 250px;
}

/*table*/

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

/*form*/

input[type=text], select, textarea {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
	box-sizing: border-box;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
	box-sizing: border-box;
}

input[type=submit] {
    background-color: #56baed;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
	box-sizing: border-box;
}

input[type=submit]:hover {
    background-color: #111863;
	box-sizing: border-box;
}

.container {
    border-radius: 5px;
    background-color: #fff;
    padding: 20px;
	box-sizing: border-box;
}



#footer { text-align: center; font-size:11px; padding:10px 0 0 0; color:#666; background:url(footer.gif) repeat-x 0 0; height:148px; }
#footer a{ color:#333; }

</style>
</head>
<body>

	<div id="header">
					
			<div id="head">
				<h1>TRAIN TRACKING & RESERVATION SYSTEM</h1>
				<div class="right">
					<p><a href="#">
						<a href="404.html">Help</a> |
						<a href="#">Profile</a> |
						<a href = 'index.php'>LOG OUT</a>
					</p>
				</div>
			</div>
