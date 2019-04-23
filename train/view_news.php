<?php
	include 'header.php';
?>

	<!-- Navigation -->
			<div class="topnav" id="myTopnav">
  <a href="admin.php">Dashboard</a>
  <a href="admin_reserve.php">Reservations</a>
  <a href="admin_train.php">Trains</a>
  <a href="admin_addtrain.php">Add Trains</a>
  <a href="admin_user.php">User Management</a>
  <a href="admin_news.php"  class="active">News Feed</a>
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
						<h1 class="left">VIEW NEWS</h1>
						<br><br>
                        <div style="overflow-x:auto;">
                                <?php
                                $news_id = $_GET['news_id'];
		                        mysql_connect("localhost","root","") or die (mysql_error());
                                mysql_select_db ("train");
                                $sql = "select * from news where news_id = '$news_id'";
                                $result = mysql_query($sql);
                                if (!$result) {
                                    echo "An error has occured: ".mysql_error();
                                } else {
                                    while($tr=mysql_fetch_array($result)) {
                                        ?>
                                    <table>
                                        <tr>
                                            <th align="center">NEWS ID</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[0]; ?></td>
                                        </tr>
                                        <tr>
                                            <th align="center">TITLE</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[1]; ?></td>
                                        </tr>
                                        <tr>
                                            <th align="center">ADDED BY</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[3]; ?></td>
                                        </tr>
                                        <tr>
                                            <th align="center">DATE</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[4]; ?></td>
                                        </tr>
                                        <tr>
                                            <th align="center">VERIFICATION</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[5]; ?></td>
                                        </tr>
                                        <tr>
                                            <th align="center">DESCRIPTION</th>
                                        </tr>
                                        <tr>
                                            <td align="center"><?php echo $tr[2]; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><a href="admin_news.php">BACK TO NEWS FEED</a></td>
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <br>
						</div>

						</div>
					</div>
					<!-- End Box Head -->	
					<br>

			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
    </div>
<!-- Footer -->
<div id="footer">
	<p>&copy; TRAIN TRACKING & RESERVATION SYSTEM</a></p>
</div>
<!-- End Footer -->



</body>


</body>
</html>


