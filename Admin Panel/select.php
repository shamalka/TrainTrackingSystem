<!--ticket prices table-->
<div class="tbody1">
<div style="overflow-x:auto;">
<table id="data" class="table table-striped">
<thead style="color:black">
<tr>
<th >STATION</th>
<th >ARRIVAL TIME</th>
<th >DEPARTURE TIME</th>
<th >FIRST CLASS PRICE</th>
<th >SECOND CLASS PRICE</th>
<th >THIRD CLASS PRICE</th>

</tr>
<tr>

  <!-- retrive data for table-->
<?php
$sesion='';
session_start();
$sesion=$_SESSION['trainid'];
include('dbcon.php');
$query3="SELECT * FROM ticket_price WHERE train_id='$sesion'";
$result=mysqli_query($connect,$query3);
while($row=mysqli_fetch_array($result)){?>
<td id="station" contenteditable="true" data_id1="<?php echo $row[0] ;?>"><?php  echo $row[1]?></td>
<td id="arrival_time" contenteditable="true" data_id2="<?php echo $row[0]; ?>"><?php  echo $row[2]?></td>
<td id="departure_time" contenteditable="true" data_id3="<?php echo $row[0]; ?>"><?php  echo $row[3]?></td>
<td id="first_class_price" contenteditable="true" data_id4="<?php echo $row[0]; ?>"><?php  echo $row[4]?></td>
<td id="second_class_price" contenteditable="true" data_id5="<?php echo $row[0]; ?>"><?php  echo $row[5]?></td>
<td id="third_class_price" contenteditable="true" data_id6="<?php echo $row[0]; ?>"><?php  echo $row[6]?></td>
</tr>
<?php } ?>
</thead>
</table>
</div>
</div>
