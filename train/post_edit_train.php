<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'header.php';

$conn = mysqli_connect("localhost", "root", "", "train");

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if(isset($_POST['UPDATE'])){

    $train_id = $_POST['train_id'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $start_station = $_POST['start_station'];
    $end_station  = $_POST['end_station'];
    $time = $_POST['time'];
//
//
//    $sql1 = "UPDATE news SET `title` = '$title', `date` = '$year-$month-$day', `description` = '$desc', `author` = '$author' where `news_id` = '$news_id'";
//
//    if($conn->query($sql1)===TRUE){
//        echo '<script language="javascript">';
//        echo 'alert("NEWS SUCCESSFULLY UPDATED!!")';
//        echo '</script>';
//        ?>
    <!--        <a href="admin_news.php">GO BACK TO NEWS FEED</a>-->
    <!--        --><?php
//    }else{
//    echo "Error: " . $sql1 . "<br>" . $conn->error;
//    }



    $i = mysqli_query($conn,"UPDATE trains SET name='$name', type='$type', time='$time', start_station='$start_station', end_station='$end_station' WHERE train_id='$train_id'");
    if($i==true) {

        ?>
        <div id="content" class="shell">
        <div id="content">
        <div class="box">
        <!-- Box Head -->
        <div class="box-head">
            <br><br><br><br>
        <?php
        echo 'NOW EDIT SUB STATION DETAILS FOR TRAIN '.$train_id;
        ?>
        <br>
        <a href="edit_sub_train.php? train_id=<?php echo $train_id; ?>">EDIT SUB STATION DETAILS</a>
        </div>
        <?php
    }else{
        echo "Error: " . $i . "<br>" . $conn->error;
    }


}
?>