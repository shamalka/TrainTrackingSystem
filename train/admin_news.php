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
  <a href="admin_news.php" class="active">News Feed</a>
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
						<br><br>
						<h2 class="left button">CURRENT NEWS FEED</h2>
						<br><br><br>
						<div style="overflow-x:auto;">
						  <table>
							<tr>
							  <th align="center">NEWS ID</th>
							  <th align="center">TITLE</th>
							  <th align="center">ADDED BY</th>
							  <th align="center">DATE</th>
							  <th align="center">VERIFICATION</th>							
							  <th align="center">CONTROL</th>
							</tr>
							<?php
								mysql_connect("localhost","root","") or die (mysql_error());
								mysql_select_db ("train");
								$sql = "select * from news order by date DESC";
								$result = mysql_query($sql);
								
								if (!$result) {
									echo "An error has occured: ".mysql_error();
								} else {
									while($tr=mysql_fetch_array($result)) {
							?>
						
							<tr>
							  <td align="center"><?php echo $tr[0]; ?></td>
							  <td align="center"><?php echo $tr[1]; ?></td>
							  <td align="center"><?php echo $tr[3]; ?></td>
							  <td align="center"><?php echo $tr[4]; ?></td>
							  <td align="center"><?php echo $tr[5]; ?></td>
							  <td align="center">
							  <a href="view_news.php? news_id=<?php echo $tr[0];?>">VIEW</a>
							  </td>
							  
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


