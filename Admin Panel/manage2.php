<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location: Login.php");
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
   <script type="text/javascript" src="js/action2.js"></script>
   <script type="text/javascript" src="js/action.js"></script>
    <title></title>
  </head>
  <body>

    <!--navigation bar-->

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Train Tracking & Reservation</a>
        </div>
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li><a href="AdminReserve.php">Reservations</a></li>
      <li class="active"><a href="AdminTrain.php">Trains</a></li>
      <li><a href="station.php">Stations</a></li>
      <li><a href="AdminUser.php">Users</a></li>
      <li><a href="AdminNews.php">Add News</a></li>
      <li><a href="AdminRating.php">Ratings</a></li>
      <li><a href="ViewNews.php">News & Notifications</a></li>
      <li><a href="Admin.php">Make An Admin</a></li>
    </ul>
  </div>
</nav>
<?php


 ?>
 <br>
 <br><br><br>
<!--form for edit tcket prices-->
 <div class="container">
 <div class="panel panel-default">
     <div class="panel-heading" style="color:black;text-align:center"><b>EDIT DETAILS</b></div>
     <div class="panel-body">
      <span id="message"></span>
      <div class="table-responsive" id="user_data">
        <div id="livedata"></div>
</div>
<button type="submit" class="btn btn-success" name="button" onclick="window.location.href='AdminTrain.php'">FINISH</button>
</div>
</div>
</div>
<script type="text/javascript">

//live table update js function
function fetch_data()
   {
        $.ajax({
             url:"select.php",
             method:"POST",
             success:function(data){
                  $('#livedata').html(data);
             }
        });
   }
   fetch_data();
   function edit_data(id, text, column_name)
       {
            $.ajax({
                 url:"edit.php",
                 method:"POST",
                 data:{id:id, text:text, column_name:column_name},
                 dataType:"text",
                 success:function(data){
                      alert(data);
                 }
            });
       }
       $(document).on('blur', '.station', function(){
           var id = $(this).data("id1");
           var station = $(this).text();
           edit_data(id, station, "station");
      });
      $(document).on('blur', '.arrival_time', function(){
          var id = $(this).data("id2");
          var arrival_time = $(this).text();
          edit_data(id, arrival_time, "arrival_time");
     });
     $(document).on('blur', '.departure_time', function(){
         var id = $(this).data("id3");
         var departure_time = $(this).text();
         edit_data(id, departure_time, "departure_time");
    });
    $(document).on('blur', '.first_class_price', function(){
        var id = $(this).data("id4");
        var first_class_price = $(this).text();
        edit_data(id, first_class_price, "first_class_price");
   });
   $(document).on('blur', '.second_class_price', function(){
       var id = $(this).data("id5");
       var scp = $(this).text();
       edit_data(id, second_class_price, "second_class_price");
  });
  $(document).on('blur', '.third_class_price', function(){
      var id = $(this).data("id6");
      var third_class_price = $(this).text();
      edit_data(id, third_class_price, "third_class_price");
 });
</script>
</body>
</html>
