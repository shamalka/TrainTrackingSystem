<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */
include 'header.php';

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
                                        <input type="submit" name="INSERT" id="INSERT" value="NEXT">
                                    </div>
                                </form>



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