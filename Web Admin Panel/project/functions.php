<?php 
include_once 'connection.php';

/*function delete(mysqli $connect, $id){
	$sql = "DELETE FROM 'resrvation' WHERE code= '".$id."'";
	$result=$connect->query($sql);
	if(!$result){
		throw new Exception("cannot delete record");
	}
}*/

$id='';
if(!empty($_GET['id'])){
	$id=$_GET['id'];
}
if(empty($id)){
	throw new Exception('Invalid ID');
}
$sql = "DELETE FROM resrvation WHERE code= '".$id."'";
if($connect->query($sql)===True){
	echo "delete successful";
}
else{
	echo "error" .$connect->error;
}
header("Location:../reservation.php");
die;
$conn->close;
?>
