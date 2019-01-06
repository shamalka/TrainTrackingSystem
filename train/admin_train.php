<?php
	include 'header.php';
?>

	<!-- Navigation -->
			<div class="topnav" id="myTopnav">
  <a href="admin.php">Dashboard</a>
  <a href="admin_reserve.php">Reservations</a>
  <a href="admin_train.php" class="active">Trains</a>
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
						<h1 class="left">MANAGE TRAINS</h1>
						<br><br>
						<h2 class="left button">TRAINS AVAILABLE FOR BOOKING</h2>
						<br><br><br>
						<div style="overflow-x:auto;">
						  <table>
							<tr>
							  <th align="center">TRAIN ID</th>
							  <th align="center">NAME</th>
							  <th align="center">TYPE</th>
							  <th align="center">START STATION</th>
							  <th align="center">END STATION</th>
							  <th align="center">TIME</th>						  
							  <th align="center">CONTROL</th>
							</tr>
							
						<?php
							mysql_connect("localhost","root","") or die (mysql_error());
							mysql_select_db ("train");
							$sql = "select * from trains";
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
							  <td align="center">
							  <a href="viewtrain.php? train_id=<?php echo $tr[0];?>">VIEW DETAILS</a> | <a href="edittrain.php? train_id=<?php echo $tr[0];?>">EDIT</a> | <a href="delete_train.php? train_id=<?php echo $tr[0];?>">DELETE</a>
							  </td>
							</tr>

						<?php
								}
							}
						?>
							
						  </table>
						</div>
		

					</div>
					<!-- End Box Head -->	
					<br>

                </div>
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


