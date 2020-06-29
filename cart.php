<?php
	error_reporting(0);
	session_start();
	include 'header.php';
	include 'db.php';

	if(isset($_GET['action'])){
		if($_GET['action'] == 'remove'){
			foreach ($_SESSION['cart'] as $keys => $value) {
				if($value['item_id'] == $_GET['item_id']){
					unset($_SESSION['cart'][$keys]);
					header('location:cart.php');
				}
			}
		}
	}

	if(isset($_POST['action']) && $_POST['action'] == "change"){
		foreach($_SESSION['cart'] as $key => $value){
			if($value['item_id'] === $_POST['item_id']){
				$_SESSION['cart'][$key]['item_quantity'] = $_POST['quantity']; 
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'submit'){
		$count = 0;
		foreach($_SESSION['cart'] as $keys => $value){
			$id = $value['item_id'];
			$c_id = $_SESSION['cus_id'];
			$quantity = $value['item_quantity'];

			$sql = "INSERT into orders(item_id,customer_id,quantity) values('$id','$c_id','$quantity')";
			$res = mysqli_query($con,$sql);
			$count++;
		}
		if($count == count($_SESSION['cart'])){
			$_SESSION['cart'] = array();
			echo "<script>alert('Order Placed Successfully');</script>";
			echo "<script>window.location.href = 'index.php';</script>";
		}
		else
			echo "<script>alert('Something went to wrong!!!');</script>";
	}

?>

<html>
<head>
 
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <link rel="stylesheet" href="css/style.css">
</head>
 
<body>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- Login form creation starts-->
  <section class="container-fluid">
  	<div class="row justify-content-center" id="heading">
  		<h1>Cart Items</h1>
  	</div>
    
    <div class="container">
      <table class="table">
        <thead>
        	<?php
        		if(!empty($_SESSION['cart'])){
        	?>
		          <tr>
		            <th></th>
		            <th>Item Name</th>
		            <th>Quantity</th>
		            <th>Unit Price</th>
		            <th>Item Total</th>
		            <th>Action</th>
		          </tr>
		    <?php } ?>
        </thead>
        <tbody>
         	<?php
         		if(!empty($_SESSION['cart'])){
         			$total = 0;
         			foreach($_SESSION['cart'] as $value){
         				$id = $value['item_id'];
         				$item_total = $value['item_name'] * $value['item_quantity'];
         	?>		<tr>
         				<td><?php echo "<img src='assets/images/".$value['item_image']."' title= '".$value['item_name']."' style='border-radius:50%;' height = '60px' width = '50px'>";?></td>
         				<td><?=$value['item_name'];?></td>
         				<td>
         					<form method='post' action=''>
							<input type='hidden' name='item_id' value="<?=$id;?>" />
							<input type='hidden' name='action' value="change" />
         					<select name="quantity" onchange="this.form.submit()">
         						<option <?php if($value["item_quantity"]==1) echo "selected";?> value="1">1</option>
								<option <?php if($value["item_quantity"]==2) echo "selected";?> value="2">2</option>
								<option <?php if($value["item_quantity"]==3) echo "selected";?> value="3">3</option>
								<option <?php if($value["item_quantity"]==4) echo "selected";?> value="4">4</option>
								<option <?php if($value["item_quantity"]==5) echo "selected";?> value="5">5</option>
         					</select>
         					</form>
         				</td>
         				<td>&#x20B9 <?=$value['item_price'];?></td>
         				<td>&#x20B9 <?php echo number_format($value['item_price'] * $value['item_quantity'],2);?></td>
         				<td><?php echo "<a href='cart.php?action=remove&item_id=$id' class='btn btn-danger'>Remove</a>";?></td>
         			</tr>

         	<?php
         				$total += $value['item_price'] * $value['item_quantity'];
         	 		} 
         	?>
         		<tr>
         			<td colspan="4" align="right"><strong>Total</strong></td>
         			<td >&#x20B9 <?php echo number_format($total,2);?></td>
         		</tr>
         		<tr>
         			<td colspan="6" align="right"><a href="cart.php?action=submit" class="btn btn-primary btn-lg btn-block">Confirm Order</a></td>
         		</tr>
         	<?php
         	 	}
         	 	else{
         	 ?>
         	 		<div class="alert alert-primary">Your Cart is Empty!!</div>
         	 <?php } ?>

        </tbody>
      </table>
    </div>

    <script type="text/javascript">
    	function updatePrice(id){
    		var e = document.getElementById('quantity');
    		var no_of_product = e.options[e.selectedIndex].value;
    		
    		console.log(id,no_of_product);
    	}
    </script>