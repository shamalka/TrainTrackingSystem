<?php
/**
 * Created by PhpStorm.
 * User: Kaeshavan
 */



                    $conn = mysqli_connect("localhost", "root", "", "train");

                    if (!$conn) {
                        die("Connection failed: ".mysqli_connect_error());
                    }


                    if(isset($_POST['INSERT'])){
                        $train_id = $_POST['train_id'];
                        $title = $_POST['title'];
                        $type = $_POST['type'];
                        $start = $_POST['start'];
                        $dest = $_POST['dest'];
                        $shour = $_POST['shour'];
                        $smin = $_POST['smin'];
                        $ssec = $_POST['ssec'];


                        $sql1 = "INSERT INTO trains(`train_id`, `name`, `type`, `start_station`, `end_station`, `time`) VALUES ('$train_id', '$title', '$type', '$start', '$dest', '$shour:$smin:$ssec')";

                        if($conn->query($sql1)===TRUE){
                            header("Location: admin_ticketprice.php");
                        }else{
                            echo "Error: " . $sql1 . "<br>" . $conn->error;
                        }
                    }


 ?>
