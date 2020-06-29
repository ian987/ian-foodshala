<?php
  error_reporting(0);
  session_start();
	include 'header.php'; 
  include 'db.php';

  if(isset($_SESSION['resUsername'])){
      header('location: NoAccess.php?access=resturant');
  }
  else if(!isset($_SESSION['cus_email']) && !isset($_SESSION['resUsername'])){
      header('location: index.php?mssg= Please SignIn to Access Menu Page');
  }

  $display_records = 5;

  if(!isset($_GET['page']))
    $page = 1;
  else
    $page = $_GET['page'];

  $limit_number = ($page - 1)*$display_records;
  $cus_id = $_SESSION['cus_id'];
  

  $sql = "SELECT o.*,i.*,r.res_name from orders as o
          inner join items as i on i.item_id = o.item_id
          inner join resturant as r on r.res_id = i.resturant_id
          where o.customer_id = $cus_id" ;
  $res = mysqli_query($con,$sql);
  $total_records = mysqli_num_rows($res);

  $no_of_pages = ceil($total_records/$display_records);

  $sql1 = "SELECT o.*,i.*,r.res_name from orders as o
          inner join items as i on i.item_id = o.item_id
          inner join resturant as r on r.res_id = i.resturant_id
          where o.customer_id = $cus_id limit $limit_number,$display_records";
  $res1 = mysqli_query($con,$sql1);

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
  		<h1>Order List</h1>
  	</div>
    
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Sl.No.</th>
            <th>Item Name</th>
            <th>Resturant Name</th>
            <th>Quantity</th>
            <th>Item Image</th>
            <th>Order Status</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 1;
            while($row = mysqli_fetch_assoc($res1)){
          ?> 
            <tr>
              <td><?=$i++;?></td>
              <td><?=$row['item_name'];?></td>
              <td><?=$row['res_name']?></td>
              <td><?=$row['quantity']?></td>
              <td><?php echo "<img src='assets/images/".$row['item_image']."' title= '".$row['item_name']."' style='border-radius: 50%;' height = '100px' width = '100px'>";?></td>
              <td><?php echo "<img src='assets/order-placed.png' title= 'Order Placed' height = '40px' width = '40px'";?></td>
            </tr>

          <?php } ?>
          
        </tbody>
      </table>
    </div>

    <nav aria-label="Page navigation example" style="float: right;margin-right: 200px;">
      <ul class="pagination">
        <li class="<?php if($page <= 1) {echo 'page-item disabled';} else {echo 'page-item';} ?>">
          <a class="page-link" href="<?php if($page <= 1) {echo '#';} else {echo 'customerOrderList.php?page='.($page - 1);} ?>">Previous</a>
        </li>
        <?php
          for($pages=1;$pages<=$no_of_pages;$pages++){
            echo "<li class='page-item'><a class='page-link' href='customerOrderList.php?page=$pages'>$pages</a></li>";
          } 
        ?>
        
        <li class="<?php if($page >= $no_of_pages) {echo 'page-item disabled';} else {echo 'page-item';} ?>">
          <a class="page-link" href="<?php if($page >= $no_of_pages) {echo '#';} else {echo 'customerOrderList.php?page='.($page + 1);} ?>">Next</a>
        </li>
      </ul>
    </nav>

  </section>
<!-- Login form creation ends -->
</body>
</html>