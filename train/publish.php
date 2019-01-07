<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'dbcon.php';

$news_id = $_GET['news_id'];

$sql = "UPDATE news SET verify = 'VERIFIED' where news_id = '$news_id'";
$result = mysqli_query($conn,$sql);
if($result==true){
    echo '<script language="javascript">';
    echo 'alert("NEWS PUBLISHED!!")';
    echo '</script>';
    ?>
    <a href="admin_news.php">GO BACK TO NEWS FEED</a>
    <?php
}

?>
