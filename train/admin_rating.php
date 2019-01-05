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
  <a href="admin_news.php">News Feed</a>
  <a href="admin_addnews.php">Add News</a>
  <a href="admin_rating.php">Ratings & Feedback</a>
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
						<h1 class="left">MANAGE RATINGS AND FEEDBACK</h1>
						<br><br>
						<h2 class="left button">RATINGS AND FEEDBACK</h2>
						<br><br><br>
						<div style="overflow-x:auto;">
						  <table>
							<tr>
							  <th align="center">TRAIN ID</th>
							  <th align="center">EMAIL ID</th>
							  <th align="center">TRAIN - RATING</th>
							  <th align="center">COMMENTS</th>
							</tr>
							
						<?php
							mysql_connect("localhost","root","") or die (mysql_error());
							mysql_select_db ("train");
							$sql = "select * from rating";
							$result = mysql_query($sql);
							
							if (!$result) {
								echo "An error has occured: ".mysql_error();
							} else {
								while($tr=mysql_fetch_array($result)) {
						?>
						
							<tr>
							  <td align="center"><a href="train.php? txtid=<?php echo $tr[0];?>"><?php echo $tr[0]; ?></a></td>
							  <td align="center"><a href="profile.php? txtid=<?php echo $tr[1];?>"><?php echo $tr[1]; ?></a></td>
							  <td align="center"><?php echo $tr[2]; ?></td>
							  <td align="center"><?php echo $tr[3]; ?></td>
							</tr>

						<?php
								}
							}
						?>
							
						  </table>
						</div>
						<br><br><br><br>

                    </div>
                </div>
            </div>

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


