<?php

$conn = mysqli_connect("localhost", "root", "", "train");

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}


if(isset($_POST['INSERT'])){

    $train_id = $_POST['train_id'];


    $sql = "SELECT station FROM ticket_price WHERE train_id = '$train_id'";
    $result = mysqli_query($conn,$sql);

    $stations;

    if (!$result) {
        echo "An error has occured: ".mysql_error();
    } else {
        while ($tr = mysql_fetch_array($result)) {
            $stations = $stations.$tr;
            $stations = $stations.", ";
        }

    }

    $sql1 = "INSERT INTO stations(`train_id`, `stations`) VALUES ('$train_id', '$stations')";
    $res2 = mysqli_query($conn,$sql1);

    if (!$res2) {
        echo "An error has occured: ".mysql_error();
    } else {
        header("Location: admin_seats.php");
    }




    $fc = $_POST['fc'];
    $sc = $_POST['sc'];
    $tc = $_POST['tc'];

    for($x=1; $x <= $fc; $x++){
        if($x < $fc){
            $a = "F".$x;
            $b = ", ";
            $f_c = $f_c.$a.$b;
        }else{
            $a = "F".$x;
            $f_c = $f_c.$a;
        }
    }

    for($x=1; $x <= $sc; $x++){
        if($x < $sc){
            $a = "S".$x;
            $b = ", ";
            $s_c = $s_c.$a.$b;
        }else{
            $a = "S".$x;
            $s_c = $s_c.$a;
        }
    }

    for($x=1; $x <= $tc; $x++){
        if($x < $tc){
            $a = "T".$x;
            $b = ", ";
            $t_c = $t_c.$a.$b;
        }else{
            $a = "T".$x;
            $t_c = $t_c.$a;
        }
    }


    $sql1 = "INSERT INTO seats(`train_id`, `first_class_seats`, `second_class_seats`, `third_class_seats`) VALUES ('$train_id', '$f_c', '$s_c', '$t_c')";

    if($conn->query($sql1)===TRUE){
        echo '<script language="javascript">';
        echo 'alert("Train details sucessfully inserted!!!")';
        echo '</script>';
        //header("Location: admin_ticketprice.php");
    }else{
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}

?>



