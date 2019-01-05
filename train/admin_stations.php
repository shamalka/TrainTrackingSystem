<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */
include 'header.php';

$_SESSION['train_id'] = 'train_id';

?>

    <!-- Navigation -->
    <div class="topnav" id="myTopnav">
        <a href="admin.php">Dashboard</a>
        <a href="admin_reserve.php">Reservations</a>
        <a href="admin_train.php">Trains</a>
        <a href="admin_addtrain.php" class="active">Add Trains</a>
        <a href="admin_user.php">User Management</a>
        <a href="admin_news.php">News Feed</a>
        <a href="admin_addnews.php">Add News</a>
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

                        <br><br><br>
                        <form method="post" action="admin_seats.php">
                            <h2 class="left button">TRAIN SEAT NUMBERS</h2>
                            <br><br><br>
                            <div class="container">
                                <form method="post" action="admin_seats.php">
                                    <div class="row">
                                        <div class="col-25">
                                            <label for="fc">FIRST CLASS SEATS</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="fc" name="fc" placeholder="FIRST CLASS SEATS">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label for="sc">SECOND CLASS SEATS</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="sc" name="sc" placeholder="SECOND CLASS SEATS">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label for="tc">THIRD CLASS SEATS</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="tc" name="tc" placeholder="THIRD CLASS SEATS">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <input type="submit" name="INSERT" id="INSERT" value="NEXT">
                                    </div>
                                </form>

<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */
	$conn = mysqli_connect("localhost", "root", "", "train");

	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}


	if(isset($_POST['INSERT'])){
		$train_id = $_POST['train_id'];
		$station = $_POST['station'];
		$shour = $_POST['shour'];
		$smin = $_POST['smin'];
		$ssec = $_POST['ssec'];
		$fhour = $_POST['fhour'];
        $fmin = $_POST['fmin'];
        $fsec = $_POST['fsec'];
        $fc = $_POST['fc'];
        $sc = $_POST['sc'];
        $tc = $_POST['tc'];


		$sql1 = "INSERT INTO ticket_price(`train_id`, `station`, `arrival_time`, `departure_time`, `first_class_price`, `second_class_price`, `third_class_price`) VALUES ('$train_id', '$station', '$shour:$smin:$ssec', '$fhour:$fmin:$fsec', '$fc', '$sc', '$tc')";

		if($conn->query($sql1)===TRUE){
           //header("Location: admin_ticketprice.php");
		}else{
		echo "Error: " . $sql1 . "<br>" . $conn->error;
		}
	}



?>

                            </div>
                    </div>
                    <!-- End Box Head -->
                    <br>

                </div>

                <div class="cl">&nbsp;</div>

            </div>

        </div>
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