<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'dbcon.php';

$news_id = $_GET['news_id'];

$sql = "DELETE FROM news where news_id = '$news_id'";
$result = mysqli_query($conn,$sql);
if($result==true){
    echo '<script language="javascript">';
    echo 'alert("News Deleted!!")';
    echo '</script>';
    ?>
    <a href="admin_news.php">GO BACK TO NEWS FEED</a>
    <?php
}

?>
