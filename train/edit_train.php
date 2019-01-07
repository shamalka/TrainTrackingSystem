<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */


include 'header.php';


    $train_id = $_GET['train_id'];
    // including the database connection in this page
    $conn = mysqli_connect("localhost", "root", "","train");
    // the sql query to retrive the record
    $sql = "SELECT `name`, `type`, `start_station`, `end_station`, `time` FROM `trains` WHERE `train_id` = '$train_id'";
    // fetches he result of the query in the variable result
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        // assigns the fetched results to the following variables
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $type = $row['type'];
            $start_station = $row['start_station'];
            $end_station = $row['end_station'];
            $time = $row['time'];

        }
    } else{
        $name = "";
        $type = "";
        $start_station = "";
        $end_station  = "";
        $time = "";

    }


?>

<!-- Navigation -->
<div class="topnav" id="myTopnav">
    <a href="admin.php">Dashboard</a>
    <a href="admin_reserve.php">Reservations</a>
    <a href="admin_train.php" class="active">Trains</a>
    <a href="admin_addtrain.php">Add Trains</a>
    <a href="admin_user.php">User Management</a>
    <a href="admin_news.php">News Feed</a>
    <a href="admin_addnews.php" >Add News</a>
    <a href="admin_rating.php">Ratings & Feedback</a>
</div>

<!-- End Navigation -->


<!-- End Header -->
<!-- Content -->
<div id="content" class="shell">

    <div id="main">
        <div class="cl">&nbsp;</div>

        <!-- Content -->
        <div id="content">

            <!-- Box -->
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <br><br>
                    <h2 class="left button">EDIT NEWS</h2>
                    <br><br><br>
                    <div class="container">
                        <form method="post" action="post_edit_train.php">
                            <div class="row">
							  <div class="col-25">
								<label for="tid">TRAIN ID</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="train_id" name="train_id" placeholder="<?php echo $train_id;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="title">TITLE</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="name" name="name" value="<?php echo $name;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="type">TYPE</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="type" name="type" value="<?php echo $type;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="start">START STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="start_station" name="start_station" value="<?php echo $start_station;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="dest">END STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="end_station" name="end_station" value="<?php echo $end_station;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="time">TIME</label>
							  </div>
							  <div class="col-25">
								<div class="col-75">
                                    <input type="text" id="time" name="time" value="<?php echo $time;?>">
                                </div>
							  </div>
							</div>
							  <br>
                                <div class="row">
                                    <input type="submit" name="UPDATE" id="UPDATE" value="UPDATE">
                                </div>
                            <br><br>
                        </form>

                    </div>
                <br><br>
                    <a href="admin_news.php">BACK TO NEWS FEED</a>
                </div>
            </div>
            <!-- End Box Head -->
            <br>
        </div>
    </div>


    <div class="cl">&nbsp;</div>
</div>
<!-- Main -->

<!-- Footer -->
<div id="footer">
    <p>&copy; TRAIN TRACKING & RESERVATION SYSTEM</a></p>
</div>
<!-- End Footer -->



</body>


</body>
</html>



