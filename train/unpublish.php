<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'dbcon.php';

$news_id = $_GET['news_id'];

$sql = "UPDATE news SET verify = 'NOT VERIFIED' where news_id = '$news_id'";
$result = mysqli_query($conn,$sql);
if($result==true){
    echo '<script language="javascript">';
    echo 'alert("NEWS UNPUBLISHED!!")';
    echo '</script>';
    ?>
    <a href="admin_news.php">GO BACK TO NEWS FEED</a>
    <?php
}

?>
