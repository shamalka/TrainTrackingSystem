<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */
	include 'header.php';

//$_SESSION['train_id'] = 'train_id';
//$train_id = $_POST['train_id'];
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

						<br><br><br>
						<h2 class="left button">ADD SUB STATIONS</h2>
						<br><br><br>
						<div class="container">
						  <form method="post" action="admin_ticketprice.php">
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
								<label for="station">STATION</label>
							  </div>
							  <div class="col-75">
								<input type="text" id="station" name="station" placeholder="station">
							  </div>
							</div>
							<div class="row">
							  <div class="col-25">
								<label for="ac"> ARRIVAL TIME</label>
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
							<br>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="dc">DEPARTURE TIME</label>
                                  </div>
                                  <div class="col-25">
                                      <select id="fhour" name="fhour">
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
                                      <select id="fmin" name="fmin">
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
                                      <select id="fsec" name="fsec">
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
                              <br>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="fc">FIRST CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="fc" name="fc" placeholder="first class">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="sc">SECOND CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="sc" name="sc" placeholder="second class">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-25">
                                      <label for="tc">THIRD CLASS</label>
                                  </div>
                                  <div class="col-75">
                                      <input type="text" id="tc" name="tc" placeholder="third class">
                                  </div>
                              </div>

                        <br><br><br>
                        <div class="container">
                            <br>
							<div class="row">
							  <input type="submit" name="ADD" id="ADD" value="ADD">
							</div>

                              <br>
                          </form>
                        </div>
                    </div>

                        <br><br><br>
                        <div class="container">
                            <form method="post" action="admin_stations.php">
                            <div class="row">
                                <input type="submit" name="FINISH" id="FINISH" value="FINISH">
                            </div>
                            <br><br>
                            </form>
                        </div>

                    <?php

                    $conn = mysqli_connect("localhost", "root", "", "train");

                    if (!$conn) {
                        die("Connection failed: ".mysqli_connect_error());
                    }

                    if(isset($_POST['INSERT'])){
                        $train_id = $_POST['train_id'];
                        $title = $_POST['title'];
                        $type = $_POST['type'];
                        $start = $_POST['start'];
                        $dest = $_POST['dest'];
                        $shour = $_POST['shour'];
                        $smin = $_POST['smin'];
                        $ssec = $_POST['ssec'];


                        $sql1 = "INSERT INTO trains(`train_id`, `name`, `type`, `start_station`, `end_station`, `time`) VALUES ('$train_id', '$title', '$type', '$start', '$dest', '$shour:$smin:$ssec')";

                        if($conn->query($sql1)===TRUE){
                            //header("Location: admin_ticketprice.php");
                        }else{
                            echo "Error: " . $sql1 . "<br>" . $conn->error;
                        }
                    }
                    if(isset($_POST['ADD'])){
                        $train_id = $_POST['train_id'];
                        $station = $_POST['station'];
                        $shour = $_POST['shour'];
                        $smin = $_POST['smin'];
                        $ssec = $_POST['ssec'];
                        $fhour = $_POST['fhour'];
                        $fmin = $_POST['fmin'];
                        $fsec = $_POST['fsec'];
                        $fc = $_POST['fc'];
                        $sc = $_POST['sc'];
                        $tc = $_POST['tc'];


                        $sql1 = "INSERT INTO ticket_price(`train_id`, `station`, `arrival_time`, `departure_time`, `first_class_price`, `second_class_price`, `third_class_price`) VALUES ('$train_id', '$station', '$shour:$smin:$ssec', '$fhour:$fmin:$fsec', '$fc', '$sc', '$tc')";

                        if($conn->query($sql1)===TRUE){
                            //header("Location: admin_ticketprice.php");
                        }else{
                            echo "Error: " . $sql1 . "<br>" . $conn->error;
                        }
                    }


                    ?>


					</div>
					<!-- End Box Head -->
					<br>


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


