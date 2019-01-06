<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

$conn = mysqli_connect("localhost", "root", "", "train");

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if(isset($_POST['UPDATE'])){


    $news_id = $_POST['news_id'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $desc = $_POST['desc'];
    $author = $_POST['author'];
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



    $i = mysqli_query($conn,"UPDATE news SET title='$title', date='$year-$month-$day', description='$desc', author='$author' WHERE news_id='$news_id'");
    if($i==true) {
        header('Location: admin_news.php');
    }else{
        echo "Error: " . $i . "<br>" . $conn->error;
    }


}
?>