<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'dbcon.php';

$train_id = $_GET['train_id'];

$sql = "DELETE FROM trains where train_id = '$train_id'";
$res1 = mysqli_query($conn,$sql);

$sql1 = "DELETE FROM stations where train_id = '$train_id'";
$res2 = mysqli_query($conn,$sql1);

$sql2 = "DELETE FROM ticket_price where train_id = '$train_id'";
$res3 = mysqli_query($conn,$sql2);

$sql3 = "DELETE FROM seats where train_id = '$train_id'";
$res4 = mysqli_query($conn,$sql3);


if($res1==true&&$res2==true&&$res3==true&&$res4==true){
    echo '<script language="javascript">';
    echo 'alert("Train Record Deleted!!")';
    echo '</script>';
    ?>
    <a href="admin_train.php">GO BACK TO TRAINS PAGE</a>
    <?php
}

?>