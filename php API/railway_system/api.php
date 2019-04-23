<?php
include 'variables.php';

$con = mysqli_connect($host,$username,$pwd,$db) or die("Unable to connect");


if(mysqli_connect_error($con)){
	echo "Failed to connect";
}

if(isset($_GET['get_trains'],$_GET['name'])){
    
    
	$query = mysqli_query($con,"SELECT name,start_station,end_station,time FROM trains WHERE start_station='".$_GET['get_trains']."' AND end_station='".$_GET['name']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_news'])){
	$query = mysqli_query($con,"SELECT title,news_id,description,author,dates,Times FROM news WHERE verify='VERIFIED' ORDER BY news_id DESC");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_first_class_seat_numbers'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT first_class_seats FROM seats WHERE train_id='".$_GET['train_id']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_second_class_seat_numbers'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT second_class_seats FROM seats WHERE train_id='".$_GET['train_id']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_third_class_seat_numbers'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT third_class_seats FROM seats WHERE train_id='".$_GET['train_id']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_first_class_reserved_seats'],$_GET['date'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT first_class_seats FROM reservations WHERE date='".$_GET['date']."' AND train_id='".$_GET['train_id']."' ");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_second_class_reserved_seats'],$_GET['date'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT second_class_seats FROM reservations WHERE date='".$_GET['date']."' AND train_id='".$_GET['train_id']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_third_class_reserved_seats'],$_GET['date'],$_GET['train_id'])){
	$query = mysqli_query($con,"SELECT third_class_seats FROM reservations WHERE date='".$_GET['date']."' AND train_id='".$_GET['train_id']."' ");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['select_stations'],$_GET['start'],$_GET['end'])){
	$query = mysqli_query($con,"SELECT train_id,stations FROM stations WHERE stations LIKE '%".$_GET['start']."%' AND stations LIKE '%".$_GET['end']."%'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_train_details'],$_GET['train_id'],$_GET['start_station'])){
    
    
	$query = mysqli_query($con,"SELECT trains.train_id,trains.name, ticket_price.arrival_time, ticket_price.departure_time FROM trains,ticket_price WHERE trains.train_id='".$_GET['train_id']."' AND trains.train_id=ticket_price.train_id AND ticket_price.station='".$_GET['start_station']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_first_class_ticket_price'],$_GET['train_id'],$_GET['end_station'])){
    
    
	$query = mysqli_query($con,"SELECT first_class_price FROM ticket_price WHERE train_id='".$_GET['train_id']."' AND station='".$_GET['end_station']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_second_class_ticket_price'],$_GET['train_id'],$_GET['end_station'])){
    
    
	$query = mysqli_query($con,"SELECT second_class_price FROM ticket_price WHERE train_id='".$_GET['train_id']."' AND station='".$_GET['end_station']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_third_class_ticket_price'],$_GET['train_id'],$_GET['end_station'])){
    
    
	$query = mysqli_query($con,"SELECT third_class_price FROM ticket_price WHERE train_id='".$_GET['train_id']."' AND station='".$_GET['end_station']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_reserved_seats'],$_GET['train_id'],$_GET['date'])){
    
    
	$query = mysqli_query($con,"SELECT second_class_seats FROM reservations WHERE train_id='".$_GET['train_id']."' AND date='".$_GET['date']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_arrival_time'],$_GET['train_id'],$_GET['start_station'])){
    
    
	$query = mysqli_query($con,"SELECT arrival_time FROM ticket_price WHERE train_id='".$_GET['train_id']."' AND station='".$_GET['start_station']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_reservations'],$_GET['user_id'])){
    
    
	$query = mysqli_query($con,"SELECT `train_id`,`reservation_id`,`user_id`,`start_station`,`end_station`,`first_class_seats`,`second_class_seats`,`third_class_seats`,`arrival_time`,`total_price`,`date` FROM `reservations` WHERE user_id='".$_GET['user_id']."' AND status='PAID' ORDER BY reservation_id DESC");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_email'])){
    
    
	$query = mysqli_query($con,"SELECT email FROM user_info");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}
else if(isset($_GET['get_user_settings'],$_GET['user_id'])){
    
    
	$query = mysqli_query($con,"SELECT name,phone_number,nic,email FROM user_info WHERE email='".$_GET['user_id']."'");

	if($query){
		while($row=mysqli_fetch_array($query)){
			$flag[]=$row;
		}
		print(json_encode($flag));
	}

}


mysqli_close($con);
?>