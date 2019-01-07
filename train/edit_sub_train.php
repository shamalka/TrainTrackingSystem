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
    $sql = "SELECT `title`, `description`, `author`, `date` FROM `news` WHERE `train_id` = '$train_id'";
    // fetches he result of the query in the variable result
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        // assigns the fetched results to the following variables
        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $description = $row['description'];
            $author = $row['author'];
            $date = $row['date'];
            // splits the date into three variables as date, month and year
            list($year, $month, $day) = explode("-", $date);
        }
    } else{
        $title = "";
        $description = "";
        $author = "";
        $date = "";
        $year = "";
        $month = "";
        $day = "";

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
                        <form method="post" action="edit_seat_train.php">
                            <div class="row">
							  <div class="col-25">
								<label for="tid">TRAIN ID</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="train_id" name="train_id" value="<?php echo $train_id;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="station">STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="station" name="station" value="<?php echo $station;?>">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="ac"> ARRIVAL TIME</label>
							  </div>
							  <div class="col-25">
								<div class="col-75">
                                    <input type="text" id="hour" name="hour" value="<?php echo $hour;?>">
                                </div>
							  </div>
								<br>
							  <div class="col-25">
								<div class="col-75">
                                    <input type="text" id="min" name="min" value="<?php echo $min;?>">
                                </div>
							  </div>
								<br>
							  <div class="col-25">
								<div class="col-75">
                                    <input type="text" id="sec" name="sec" value="<?php echo $sec;?>">
                                </div>
							  </div>
							</div>
							<br>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="dc">DEPARTURE TIME</label>
                                  </div>
                                  <div class="col-25">
                                      <div class="col-75">
                                    <input type="text" id="hour" name="hour" value="<?php echo $hour;?>">
                                </div>
                                  </div>
                                  <br>
                                  <div class="col-25">
                                      <div class="col-75">
                                    <input type="text" id="min" name="min" value="<?php echo $min;?>">
                                </div>
                                  </div>
                                  <br>
                                  <div class="col-25">
                                      <div class="col-75">
                                    <input type="text" id="sec" name="sec" value="<?php echo $sec;?>">
                                </div>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="fc">FIRST CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="fc" name="fc" value="<?php echo $fc;?>">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="sc">SECOND CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="sc" name="sc" value="<?php echo $sc;?>">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="tc">THIRD CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="tc" name="tc" value="<?php echo $tc;?>">
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








