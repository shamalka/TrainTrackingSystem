<?php
	include 'header.php';
?>

	<!-- Navigation -->
			<div class="topnav" id="myTopnav">
  <a href="admin.php">Dashboard</a>
  <a href="admin_reserve.php">Reservations</a>
  <a href="admin_train.php" class="active">Trains</a>
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
							  <a href="news_view.php? method ="post" txtid=<?php echo $tr[0];?>">VIEW DETAILS</a> | <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">EDIT</a>
							  </td>
							</tr>

						<?php
								}
							}
						?>
							
						  </table>
						</div>
		
						<br><br><br>
						<h2 class="left button">ADD NEW TRAIN FOR BOOKING</h2>
						<br><br><br>
						<div class="container">
						  <form method="post" action="admin_train.php">
							<div class="row">
							  <div class="col-25">
								<label for="tid">TRAIN ID</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="tid" name="tid" placeholder="train id">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="title">TITLE</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="title" name="title" placeholder="title">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="type">TYPE</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="type" name="type" placeholder="type">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="start">START STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="start" name="start" placeholder="start">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="dest">END STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="dest" name="dest" placeholder="dest">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="time">TIME</label>
							  </div>
							  <div class="col-25">
								<select id="shour" name="shour">
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
								</select>
							  </div>		
								<br>
							  <div class="col-25">
								<select id="smin" name="smin">
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
								  <option value="32">32</option>
								  <option value="33">33</option>
								  <option value="34">34</option>
								  <option value="35">35</option>
								  <option value="36">36</option>
								  <option value="37">37</option>
								  <option value="38">38</option>
								  <option value="39">39</option>
								  <option value="40">40</option>
								  <option value="41">41</option>
								  <option value="42">42</option>
								  <option value="43">43</option>
								  <option value="44">44</option>
								  <option value="45">45</option>
								  <option value="46">46</option>
								  <option value="47">47</option>
								  <option value="48">48</option>
								  <option value="49">49</option>
								  <option value="50">50</option>
								  <option value="51">51</option>
								  <option value="52">52</option>
								  <option value="53">53</option>
								  <option value="54">54</option>
								  <option value="55">55</option>
								  <option value="56">56</option>
								  <option value="57">57</option>
								  <option value="58">58</option>
								  <option value="59">59</option>
								  <option value="60">60</option>
								</select>
							  </div>					
								<br>
							  <div class="col-25">
								<select id="ssec" name="ssec">
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
								  <option value="32">32</option>
								  <option value="33">33</option>
								  <option value="34">34</option>
								  <option value="35">35</option>
								  <option value="36">36</option>
								  <option value="37">37</option>
								  <option value="38">38</option>
								  <option value="39">39</option>
								  <option value="40">40</option>
								  <option value="41">41</option>
								  <option value="42">42</option>
								  <option value="43">43</option>
								  <option value="44">44</option>
								  <option value="45">45</option>
								  <option value="46">46</option>
								  <option value="47">47</option>
								  <option value="48">48</option>
								  <option value="49">49</option>
								  <option value="50">50</option>
								  <option value="51">51</option>
								  <option value="52">52</option>
								  <option value="53">53</option>
								  <option value="54">54</option>
								  <option value="55">55</option>
								  <option value="56">56</option>
								  <option value="57">57</option>
								  <option value="58">58</option>
								  <option value="59">59</option>
								  <option value="60">60</option>
								</select>
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="stno">NO OF STATIONS PASS THROUGH</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="stno" name="stno" placeholder="No of stations pass through">
							  </div>
							</div>
							<br>
							<div class="row">
							  <input type="submit" name="INSERT" id="INSERT" value="NEXT">
							</div>
							<div class="row">
							  
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
									$tid = $_POST['tid'];
									$title = $_POST['title'];
									$type = $_POST['type'];
									$start = $_POST['start'];
									$dest = $_POST['dest'];
									$shour = $_POST['shour'];
									$smin = $_POST['smin'];
									$ssec = $_POST['ssec'];
									$stno = $_POST['stno'];
									
									
									$sql1 = "INSERT INTO trains(`train_id`, `title`, `type`, `start_station`, `end_station`, `time`) VALUES ('$tid', '$title', '$type', '$start', '$dest', '$shour:$smin:$ssec', '$stno')";
									
									if($conn->query($sql1)===TRUE){
										echo("New record sucessfully added!!");
									}else{
										echo "Error: " . $sql1 . "<br>" . $conn->error;
									}
								}
								?>
												
						</div>

						<br><br><br>
						<form method="post" action="admin_train.php">
						<h2 class="left button">TRAIN SEAT NUMBERS</h2>
						<br><br><br>
						<div class="container">
						  <form method="post" action="admin_train.php">
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


