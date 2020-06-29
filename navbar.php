<?php
	error_reporting(0);
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>FoodShala</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<div class="container-fluid">

		<div id="navbar">
			<ul>
				<li><a href="index.php">Home</a></li>
				
				<?php 
					if(isset($_SESSION['cus_email'])){
					
				?>
					<li><a href="Logout.php">Logout as <b><?= strtoupper($_SESSION['cus_name']);?></b></a></li>
					<?php
						if(!empty($_SESSION['cart'])){
							$count = count($_SESSION['cart']);
						}
						else{
							$count = 0;
						}
					?>
					<li><a href="customerOrderList.php">My Orders</a></li>
					<div class="cart_div">
						<a href="cart.php"><img src="cart_icon.png" width="32px" height="26px" /><span> <?=$count;?> </span></a>
					</div>

				<?php 
					} else if(isset($_SESSION['resUsername'])){
					
				?>
					<li><a href="Logout.php">Logout as <b><?= strtoupper($_SESSION['res_name']);?></b></a></li>
					<li><a href="menuItems.php">Add Menu Items</a></li>
					<li><a href="viewOrder.php">Order List</a></li>
				<?php 
					} else {
					
				?>
					<li><a href="resturantSignin.php">Login as Resturant</a></li>
					<li><a href="customerSignin.php">Login as Customer</a></li>
				<?php } ?>
			</ul>
		</div>
		
	</div>
</body>
</html>
