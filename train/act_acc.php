<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

include 'dbcon.php';

$email = $_GET['email'];

$sql = "UPDATE user_info SET status = 'ACTIVE' where email = '$email'";
$result = mysqli_query($conn,$sql);
if($result==true){
    echo '<script language="javascript">';
    echo 'alert("Account Activated!!")';
    echo '</script>';
    ?>
    <a href="admin_user.php">GO BACK TO USER MANAGEMENT</a>
    <?php
}

?>
