<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */
include 'header.php';


    $news_id = $_GET['news_id'];
    // including the database connection in this page
    $conn = mysqli_connect("localhost", "root", "","train");
    // the sql query to retrive the record
    $sql = "SELECT `title`, `description`, `author`, `date` FROM `news` WHERE `news_id` = '$news_id'";
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
    <a href="admin_train.php">Trains</a>
    <a href="admin_addtrain.php">Add Trains</a>
    <a href="admin_user.php">User Management</a>
    <a href="admin_news.php">News Feed</a>
    <a href="admin_addnews.php"  class="active">Add News</a>
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
                            <div class="row">
                                <div class="col-25">
                                    <label for="news_id">NEWS ID</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="news_id" name="news_id" placeholder="<?php echo $news_id;?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="title">TITLE  (max 250 characters)</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="title" name="title" value="<?php echo $title;?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="desc">DESCRIPTION (max 1000 characters)</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="desc" name="desc" value="<?php echo $description;?>">
<!--                                    <textarea id="desc" name="desc" value="--><?php //echo $description;?><!--" style="height:200px"></textarea>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="date">DATE</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="year" name="year" value="<?php echo $year;?>">
                                </div>
                                <br>
                                <div class="col-75">
                                    <input type="text" id="month" name="month" value="<?php echo $month;?>">
                                </div>
                                <br>
                                <div class="col-75">
                                    <input type="text" id="day" name="day" value="<?php echo $day;?>">
                                </div>
                            </div>
                                <br>
                                <div class="row">
                                    <div class="col-25">
                                        <label for="author">Author</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="author" name="author" value="<?php echo $author;?>">
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


