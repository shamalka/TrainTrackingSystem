<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */

                    include 'dbcon.php';

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
                            header("Location: admin_ticketprice.php");
                        }else{
                            echo "Error: " . $sql1 . "<br>" . $conn->error;
                        }
                    }


                    if(isset($_POST['FINISH'])){
                        header("Location: admin_stations.php");
                    }



                    ?>



