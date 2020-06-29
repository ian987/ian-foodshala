<?php
	$con = mysqli_connect('localhost','root','','foodshala');

	//Check connection
	if($con == false)
		die("ERROR: Could not connect. " . mysqli_connect_error());
?>