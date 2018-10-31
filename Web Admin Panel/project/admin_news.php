<?php
	include 'header.php';
?>

	<!-- Navigation -->
			<div class="topnav" id="myTopnav">
  <a href="admin.php">Dashboard</a>
  <a href="admin_reserve.php">Reservations</a>
  <a href="admin_train.php">Trains</a>
  <a href="admin_user.php">User Management</a>
  <a href="admin_news.php"  class="active">News Feed</a>
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
						<h1 class="left">MANAGE NEWS FEED</h1>
						<br><br>
						<h2 class="left button">CURRENT NEWS FEED</h2>
						<br><br><br>
						<div style="overflow-x:auto;">
						  <table>
							<tr>
							  <th align="center">TITLE</th>
							  <th>DATE</th>
							  <th>TIME</th>
							  <th>ADDED BY</th>
							  <th>VERIFIED/ NOT VERIFIED</th>
							  <th>CONTROL</th>
							</tr>
							
						<?php
							mysql_connect("localhost","root","") or die (mysql_error());
							mysql_select_db ("train");
							$sql = "select * from news where verify = 'VERIFIED' order by date DESC";
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
							  <td align="center"><a href="profile.php? txtid=<?php echo $tr[0];?>"><?php echo $tr[4]; ?></a></td>
							  <td align="center"><?php echo $tr[5]; ?></td>
							  <td align="center">
							  <a href="news_view.php? method ="post" txtid=<?php echo $tr[0];?>">VIEW</a> | <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">EDIT</a>
							  </td>
							</tr>

						<?php
								}
							}
						?>
							
						  </table>
						</div>
						<br><br><br>
						<h2 class="left button">VERIFY PENDING NEWS</h2>
						<br><br><br>
						<div style="overflow-x:auto;">
						  <table>
							<tr>
							  <th align="center">TITLE</th>
							  <th>DATE</th>
							  <th>TIME</th>
							  <th>ADDED BY</th>
							  <th>VERIFIED/ NOT VERIFIED</th>
							  <th>CONTROL</th>
							</tr>
							
						<?php
							mysql_connect("localhost","root","") or die (mysql_error());
							mysql_select_db ("train");
							$sql = "select * from news where verify = 'NOT VERIFIED' order by date DESC";
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
							  <td align="center"><a href="profile.php? txtid=<?php echo $tr[0];?>"><?php echo $tr[4]; ?></a></td>
							  <td align="center"><?php echo $tr[5]; ?></td>
							  <td align="center"><a href="news_view.php? txtid=<?php echo $tr[0];?>">VIEW</a> | <a href="Edit_Form.php? txtid=<?php echo $tr[0];?>">EDIT</a></td>
							</tr>

						<?php
								}
							}
						?>
							
						  </table>
						</div>
						<br><br><br>
						<h2 class="left button">ADD NEW NEWS</h2>
						<br><br><br>
						<div class="container">
						  <form method="post" action="admin_news.php">
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
								<label for="time">TIME</label>
							  </div>
							  <div class="col-75">
								<select id="hour" name="hour">
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
							  <div class="col-75">
								<select id="min" name="min">
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
							  <div class="col-75">
								<select id="sec" name="sec">
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
									$title = $_POST['title'];
									$year = $_POST['year'];
									$mon = $_POST['mon'];
									$date = $_POST['date'];
									$hour = $_POST['hour'];
									$min = $_POST['min'];
									$sec = $_POST['sec'];
									$desc = $_POST['desc'];
									$added = 'ADMIN';
									$verify = 'VERIFIED';
									
									
									$sql1 = "INSERT INTO news(`Title`, `Date`, `Time`, `Description`, `added by`, `verify`) VALUES ('$title','$year-$mon-$date', '$hour:$min:$sec', '$desc', '$added', '$verify')";
									
									if($conn->query($sql1)===TRUE){
										echo("News sucessfully added!!");
									}else{
										echo "Error: " . $sql1 . "<br>" . $conn->error;
									}
								}
								?>
						</div>

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


