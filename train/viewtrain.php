<?php
include 'header.php';
?>

<!-- Navigation -->
<div class="topnav" id="myTopnav">
    <a href="admin.php">Dashboard</a>
    <a href="admin_reserve.php">Reservations</a>
    <a href="admin_train.php"   class="active">Trains</a>
    <a href="admin_addtrain.php">Add Trains</a>
    <a href="admin_user.php">User Management</a>
    <a href="admin_news.php">News Feed</a>
    <a href="admin_addnews.php">Add News</a>
    <a href="#about">Ratings & Feedback</a>
</div>

<!-- End Navigation -->

</div>
</div>
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
                    <h1 class="left">VIEW TRAIN DETAILS</h1>
                    <br><br>
                    <div style="overflow-x:auto;">
                        <table>
                            <tr>
                                <th align="center">TRAIN ID</th>
                                <th align="center">NAME</th>
                                <th align="center">TYPE</th>
                                <th align="center">START STATION</th>
                                <th align="center">END STATION</th>
                                <th align="center">TIME</th>
                            </tr>

                            <?php
                            $train_id = $_GET['train_id'];
                            mysql_connect("localhost","root","") or die (mysql_error());
                            mysql_select_db ("train");
                            $sql = "select * from trains where train_id = '$train_id'";
                            $result = mysql_query($sql);

                            if (!$result) {
                                echo "An error has occured: ".mysql_error();
                            } else {
                                while($tr=mysql_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td align="center"><?php echo $tr[0]; ?></td>
                                        <td align="center"><?php echo $tr[1]; ?></td>
                                        <td align="center"><?php echo $tr[2]; ?></td>
                                        <td align="center"><?php echo $tr[3]; ?></td>
                                        <td align="center"><?php echo $tr[4]; ?></td>
                                        <td align="center"><?php echo $tr[5]; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </table>
                    </div>
                    <br><br>
                    <h1 class="left">SUB STATIONS</h1>
                    <br><br>
                    <div style="overflow-x:auto;">
                        <table>
                            <tr>
                                <th align="center">TRAIN ID</th>
                                <th align="center">STATIONS</th>
                            </tr>

                            <?php
                            $train_id = $_GET['train_id'];
                            mysql_connect("localhost","root","") or die (mysql_error());
                            mysql_select_db ("train");
                            $sql = "select * from stations where train_id = '$train_id'";
                            $result = mysql_query($sql);

                            if (!$result) {
                                echo "An error has occured: ".mysql_error();
                            } else {
                                while($tr=mysql_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td align="center"><?php echo $tr[0]; ?></td>
                                        <td align="center"><?php echo $tr[1]; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </table>
                    </div>
                    <br><br>
                    <h1 class="left">TICKET PRICING</h1>
                    <br><br>
                    <div style="overflow-x:auto;">
                        <table>
                            <tr>
                                <th align="center">TRAIN ID</th>
                                <th align="center">STATION</th>
                                <th align="center">ARRIVAL TIME</th>
                                <th align="center">DEPARTURE TIME</th>
                                <th align="center">FIRST CLASS PRICE</th>
                                <th align="center">SECOND CLASS PRICE</th>
                                <th align="center">THIRD CLASS PRICE</th>
                            </tr>

                            <?php
                            $train_id = $_GET['train_id'];
                            mysql_connect("localhost","root","") or die (mysql_error());
                            mysql_select_db ("train");
                            $sql = "select * from ticket_price where train_id = '$train_id'";
                            $result = mysql_query($sql);

                            if (!$result) {
                                echo "An error has occured: ".mysql_error();
                            } else {
                                while($tr=mysql_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td align="center"><?php echo $tr[0]; ?></td>
                                        <td align="center"><?php echo $tr[1]; ?></td>
                                        <td align="center"><?php echo $tr[2]; ?></td>
                                        <td align="center"><?php echo $tr[3]; ?></td>
                                        <td align="center"><?php echo $tr[4]; ?></td>
                                        <td align="center"><?php echo $tr[5]; ?></td>
                                        <td align="center"><?php echo $tr[6]; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </table>
                    </div>
                    <br><br>
                    <h1 class="left">SEAT NUMBERS</h1>
                    <br><br>
                    <div style="overflow-x:auto;">
                        <table>
                            <tr>
                                <th align="center">TRAIN ID</th>
                                <th align="center">FIRST CLASS SEATS</th>
                                <th align="center">SECOND CLASS SEATS</th>
                                <th align="center">THIRD CLASS SEATS</th>
                            </tr>

                            <?php
                            $train_id = $_GET['train_id'];
                            mysql_connect("localhost","root","") or die (mysql_error());
                            mysql_select_db ("train");
                            $sql = "select * from seats where train_id = '$train_id'";
                            $result = mysql_query($sql);

                            if (!$result) {
                                echo "An error has occured: ".mysql_error();
                            } else {
                                while($tr=mysql_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td align="center"><?php echo $tr[0]; ?></td>
                                        <td align="center"><?php echo $tr[1]; ?></td>
                                        <td align="center"><?php echo $tr[2]; ?></td>
                                        <td align="center"><?php echo $tr[3]; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </table>
                    </div>
                    <br><br>
                    <a href="admin_train.php">BACK TO MAIN TRAIN PAGE</a>
                </div>

            </div>
        </div>
        <!-- End Box Head -->
        <br>


        <div class="cl">&nbsp;</div>
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


