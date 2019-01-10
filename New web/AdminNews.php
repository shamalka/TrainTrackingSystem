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
    <link rel="stylesheet" href="design/form.css">
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
   integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
   crossorigin="anonymous">
   </script>
    <title></title>
  </head>
  <body>
    <!-- navigation bar -->
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
          <li class="active"><a href="AdminNews.php">Add News</a></li>
          <li><a href="AdminRating.php">Ratings</a></li>
          <li><a href="ViewNews.php">News & Notifications</a></li>
          <li><a href="Admin.php">Make An Admin</a></li>
        </ul>
      </div>
    </nav>
<!-- end navigation -->

<!--registration form  -->
						<div class="container">
              <div class="form-style-5">
              <form id="form" >
                <fieldset>
                <legend><span class="number"></span>ADD NEW POST</legend>
                  <label for="title">Title</label>
                  <input id="title" type="text"  name="title" placeholder="Title">
                  <div class="form-group">
								     <label for="tarea">DESCRIPTION (max 1000 characters)</label>
								     <textarea id="tarea"  rows="20" name="tarea" placeholder="Description"></textarea>
                      <input id="submit" type="submit" value="submit">
                  </fieldset>
            </form>
            </div>
            <!--end registraion form  -->

            <!-- ajax for input data to database -->
              <script>
               $(document).ready(function(){
                    $('#submit').click(function(){
                         var title = $('#title').val();
                         var txt = $('#tarea').val();
                         if(title == '' ||txt=='')
                         {
                              alert("Title and Description fields are required");
                         }
                         else
                         {
                              $('#error_message').html('');
                              $.ajax({
                                   url:"http://localhost/TrainTrackingSystem/New%20web/addnews.php",
                                   method:"POST",
                                   data:{title:title,txt:txt},
                                   success:function(data){
                                        alert("Published successfully");
                                   }
                              });
                         }
                    });
               });
               </script>

               <!--end of script  -->

  </body>
</html>
