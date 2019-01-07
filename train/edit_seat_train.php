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
                        <form method="post" action="post_edit_news.php">
                            <<div class="row">
                                <div class="col-25">
                                    <label for="train_id">TRAIN ID</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="train_id" name="train_id" placeholder="train_id">
                                </div>
                            </div>
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








