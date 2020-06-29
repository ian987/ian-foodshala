<?php
	error_reporting(0);
	session_start();
	include 'db.php';

	$cus_id = $_POST['cus_id'];
	$item_id = $_POST['item_id'];

	$sql1 = "SELECT * from items where item_id = $item_id";
	$res1 = mysqli_query($con,$sql1);
	$cartItems = mysqli_fetch_assoc($res1);
	$quantity = 1;

	if(isset($_SESSION['cart'])){

		$item_array_id = array_column($_SESSION['cart'], "item_id");
		if(!in_array($item_id, $item_array_id)){
			$count = count($_SESSION['cart']);
			$items_array = array(
				'item_id' => $item_id,
				'item_name' => $cartItems['item_name'],
				'item_price' => $cartItems['item_price'],
				'item_image' => $cartItems['item_image'],
				'item_quantity' => $quantity
			);
			$_SESSION['cart'][$count] = $items_array;
			echo "Item added to shopping cart";
		}
		else{
			echo "Item already added to shopping cart";
		}
	}
	else{
		$items_array = array(
			'item_id' => $item_id,
			'item_name' => $cartItems['item_name'],
			'item_price' => $cartItems['item_price'],
			'item_image' => $cartItems['item_image'],
			'item_quantity' => $quantity
		);
		$_SESSION['cart'][0] = $items_array;
		echo "Item added to shopping cart";
	}

	// $sql = "INSERT into orders(item_id,customer_id,quantity) values('$item_id','$cus_id',1)";
	// $res = mysqli_query($con,$sql);
	// if($res){
	// 	echo "Order Added Successfully";
	// }
	// else
	// 	echo "Something went to wrong!!!";
?>