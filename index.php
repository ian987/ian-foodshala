<?php
	include 'header.php';
	include 'navbar.php';
	include 'db.php';

	if(isset($_SESSION['resUsername'])){
		$id = $_SESSION['res_id'];
		$sql = "SELECT i.*,r.res_name from items as i
				inner join resturant as r on r.res_id = i.resturant_id
				where resturant_id = $id and i.status = 1";
		$res = mysqli_query($con,$sql);
	}
	else{
		$sql = "SELECT i.*,r.res_name from items as i
				inner join resturant as r on r.res_id = i.resturant_id and i.status = 1";
		$res = mysqli_query($con,$sql);
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>FoodShala</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<div class="container-fluid">
		<?php
	      if($_REQUEST['mssg']){
	    ?>
	      <div class="alert alert-primary" id="error_mssg" style="margin: 10px;" role="alert"><?php echo $_REQUEST['mssg'];?></div>
	    <?php } ?>

	    <!--  -->

		<div class="sidebar">
			<a href="index.php"></i> Home</a>
			<?php 
				if(isset($_SESSION['resUsername'])){
			?>
				<a href="menuItems.php"></i> Add Menu Items</a>
				<a href="viewOrder.php"></i> Order List</a>
			<?php
			} else if(isset($_SESSION['cus_email'])) {
			?>
				<a href="customerOrderList.php"></i> My Orders</a>
				<a href="cart.php"></i> Cart</a>
			<?php } ?>
		</div>

		<div class="main">
			<section class="product">

				<?php
					while($items = mysqli_fetch_assoc($res)){
						$cus_id = $_SESSION['cus_id'];
						$item_id = $items['item_id'];
						$res_name = strtoupper($items['res_name']);
				?>
					<input type="hidden" id="item_id" value="<?=$item_id?>">
					<div class="product-card">
						<div class="product-image">
					      <?php echo "<img src='assets/images/".$items['item_image']."' style='border-radius: 50%;' height = '130px' width = '130px' title= '".$items['item_name']."'>"; ?>
					    </div>
					    <div class="product-info">
					      <h5><b><?=$res_name;?></b>&nbsp;<i><?=$items['item_name'];?></i></h5>
					      <h6>&#x20B9 <?=$items['item_price'];?></h6>
					      <?php if(isset($_SESSION['resUsername'])) {?>
					      	<?php echo "<a href='editItem.php?item_id=$item_id' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>" ?>
						      <?php echo "<a href='deleteItem.php?item_id=$item_id' class='btn btn-primary'><i class='fa fa-remove'></i> Remove</a>" ?>
						  <?php } else {?>

						  		<?php
						  			if(!isset($_SESSION['cus_id'])){
						  		?>
						  			<a href="customerSignin.php" class="btn btn-primary"><i class='fa fa-shopping-cart' aria-hidden='true'></i> Order Now</a>
						  		<?php
						  		} else {
						  		?>
						  			<button class="btn btn-primary orderItems" onclick="orderItems(<?=$cus_id;?>,<?=$item_id?>)"><i class='fa fa-shopping-cart' aria-hidden='true'></i> Order Now</button>
						  		<?php } ?>
						
						  <?php } ?>
					    </div>
					</div>

				<?php } ?>

			</section>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	
	function orderItems(c_id,i_id){

		var xmlHttp = new XMLHttpRequest();

        xmlHttp.onload = function()
        {  
        	alert(xmlHttp.responseText);	
        	window.location.href = "index.php";
            
        }
        xmlHttp.open("POST", "orderItems.php");
		xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         
        xmlHttp.send("cus_id="+c_id+"&item_id="+i_id);
    }		
	
</script>