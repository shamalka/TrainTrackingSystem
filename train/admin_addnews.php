<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 * Date: 04/01/2019
 * Time: 7:51 PM
 */
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
						<h2 class="left button">ADD NEW NEWS</h2>
						<br><br><br>
						<div class="container">
						  <form method="post" action="admin_addnews.php">
						  <div class="row">
							  <div class="col-25">
								<label for="id">NEWS ID</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="id" name="id" placeholder="news id">
							  </div>
							</div>

							<div class="row">
							  <div class="col-25">
								<label for="title">TITLE  (max 250 characters)</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="title" name="title" placeholder="title">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="date">DATE</label>
							  </div>
							  <div class="col-75">
								<select id="year" name="year">
								  <option value="2019">2019</option>
								  <option value="2018">2018</option>
								  <option value="2017">2017</option>
								  <option value="2016">2016</option>
								</select>
							  </div>
							  <br>
							  <div class="col-75">
								<select id="mon" name="mon">
								  <option value="01">01</option>
								  <option value="02">02</option>
								  <option value="03">03</option>
								  <option value="04">04</option>
								  <option value="05">05</option>
								  <option value="06">06</option>
								  <option value="07">07</option>
								  <option value="08">08</option>
								  <option value="09">09</option>
								  <option value="10">10</option>
								  <option value="11">11</option>
								  <option value="12">12</option>
								</select>
							  </div>
								<br>
							  <div class="col-75">
								<select id="date" name="date">
								  <option value="01">01</option>
								  <option value="02">02</option>
								  <option value="03">03</option>
								  <option value="04">04</option>
								  <option value="05">05</option>
								  <option value="06">06</option>
								  <option value="07">07</option>
								  <option value="08">08</option>
								  <option value="09">09</option>
								  <option value="10">10</option>
								  <option value="11">11</option>
								  <option value="12">12</option>
								  <option value="13">13</option>
								  <option value="14">14</option>
								  <option value="15">15</option>
								  <option value="16">16</option>
								  <option value="17">17</option>
								  <option value="18">18</option>
								  <option value="19">19</option>
								  <option value="20">20</option>
								  <option value="21">21</option>
								  <option value="22">22</option>
								  <option value="23">23</option>
								  <option value="24">24</option>
								  <option value="25">25</option>
								  <option value="26">26</option>
								  <option value="27">27</option>
								  <option value="28">28</option>
								  <option value="29">29</option>
								  <option value="30">30</option>
								  <option value="31">31</option>
								</select>
							  </div>
								<br>
							<div class="row">
							  <div class="col-25">
								<label for="desc">DESCRIPTION (max 1000 characters)</label>
							  </div>
							  <div class="col-75">
								<textarea id="desc" name="desc" placeholder="news description...." style="height:200px"></textarea>
							  </div>
							</div>
							<br>
							<div class="row">
							  <input type="submit" name="INSERT" id="INSERT" value="INSERT">
							</div>
						  </form>

						  <?php
								$conn = mysqli_connect("localhost", "root", "", "train");

								if (!$conn) {
									die("Connection failed: ".mysqli_connect_error());
								}

							?>

						  <?php

								if(isset($_POST['INSERT'])){
									$id = $_POST['id'];
									$title = $_POST['title'];
									$year = $_POST['year'];
									$mon = $_POST['mon'];
									$date = $_POST['date'];
									$desc = $_POST['desc'];
									$added = 'ADMIN';
									$verify = 'VERIFIED';


									$sql1 = "INSERT INTO news(`news_id`, `title`, `date`, `description`, `author`, `verify`) VALUES ('$id', '$title', '$year-$mon-$date', '$desc', '$added', '$verify')";

									if($conn->query($sql1)===TRUE){
										echo("News sucessfully added!!");
									}else{
										//echo "Error: " . $sql1 . "<br>" . $conn->error;
									}
								}
								?>
						</div>

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


