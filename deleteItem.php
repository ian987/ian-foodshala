<?php
	error_reporting(0);
	session_start(0);
	include 'db.php';

	if(isset($_GET['item_id']))
		$item_id = $_GET['item_id'];

	$sql = "UPDATE items set status = 0 where item_id = $item_id";
	$res = mysqli_query($con,$sql);

	if($res){
		$sql1 = "UPDATE orders set status = 0 where item_id = $item_id";
		$res1 = mysqli_query($con,$sql1);
		if($res1)
			header('location: index.php');
		else
			header('location: index.php?mssg= Something went wrong');
	}

?>