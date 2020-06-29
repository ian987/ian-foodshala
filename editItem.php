<?php
  error_reporting(0);
  session_start();
	include 'header.php'; 
  include 'db.php';

  if(isset($_SESSION['cus_email'])){
      header('location: NoAccess.php');
  }
  else if(!isset($_SESSION['cus_email']) && !isset($_SESSION['resUsername'])){
      header('location: index.php?error= Please SignIn to Access Edit Page');
  }

  if(isset($_GET['item_id']))
    $item_id = $_GET['item_id'];

  $qry = "SELECT * from items where item_id = $item_id";
  $result = mysqli_query($con,$qry);
  $item_details = mysqli_fetch_assoc($result);

  if(isset($_POST['updateItem'])){

    $id = $_POST['item_id'];
    $name = $_POST['itemName'];
    $image = $_FILES['itemImage'];
    $price = $_POST['itemPrice'];
    $category = $_POST['itemCategory'];
    $res_id = $_SESSION['res_id'];

    $targetDir = 'assets/images/';
    $imagePath = $image['tmp_name'];
    $imageName = $image['name'];
    
    $dest = $targetDir.$imageName;

    if($imageName == ""){
      $qry = "UPDATE items set item_name = '$name', item_price = '$price', item_category = '$category' where item_id = $id";
      
      $result = mysqli_query($con,$qry);
      if($result){
        header('location: index.php?mssg=Item Updated Sucessfully!!!');
      }
      else{
        header('location: index.php?mssg=Record cannot be inserted!!!');
      }
    }
    else if($file_type="image/jpeg"||$file_type="image/png" || $file_type="image/jpg"){
      
      if(move_uploaded_file($imagePath,$dest)){
        $sql = "UPDATE items set item_name = '$name',item_image = '$imageName', item_price = '$price', item_category = '$category' where item_id = $id";
        
        $res = mysqli_query($con,$sql);
        if($res){
          header('location: index.php?mssg=Item Added Sucessfully!!!');
        }
        else{
          header('location: index.php?mssg=Record cannot be inserted!!!');
        }
      }
      else{
        header('location: index.php?mssg=Error in File Upload!!!');
      }
    }
    else{
      header('location: editItem.php?mssg=File type should be jpeg or png!!!');
    }
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
  		<h1>Update Menu Items</h1>
  	</div>

    <?php
      if($_REQUEST['mssg']){
    ?>
      <div class="alert alert-primary" id="error_mssg" style="margin: 10px;" role="alert"><?php echo $_REQUEST['mssg'];?></div>
    <?php 
      } 
    ?>

    <!-- row and justify-content-center class is used to place the form in center -->
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4" style="margin-top: 30px;">
        <form class="form-container" method="POST" action="editItem.php" enctype="multipart/form-data">
        <div class="form-group">
           <label for="itemName">Item name</label>
          <input type="text" class="form-control" id="itemName" value="<?=$item_details['item_name'];?>" name="itemName" placeholder="Enter Item Name">
        </div>

        <div class="form-group">
          <label for="itemImage">Item Image</label>
          <input type="file" class="form-control" id="itemImage" onchange="readURL(this);" name="itemImage">
          <img id="blah" src="#" alt="your image" style="display: none;" />
        </div>

        <div class="form-group">
          <label for="itemPrice">Item Price</label>
         	<input type="text" class="form-control" id="itemPrice" value="<?=$item_details['item_price'];?>" name="itemPrice" placeholder="Enter Amount">
        </div>

        <div class="radio">
          <label><input type="radio" name="itemCategory" value="Vegetarian" <?php if(isset($item_details['item_category']) && $item_details['item_category']=="Vegetarian") echo "checked" ?>> Vegetarian</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <label><input type="radio" name="itemCategory" value="Non-Vegetarian" <?php if(isset($item_details['item_category']) && $item_details['item_category']=="Non-Vegetarian") echo "checked" ?>> Non-Vegetarian</label>
        </div>
        <input type="hidden" name="item_id" value="<?=$item_id?>">
        <button type="submit" name="updateItem" class="btn btn-primary btn-block">Update</button>
        
        </form>
      </section>
    </section>
  </section>
<!-- Login form creation ends -->
</body>
</html>

<script type="text/javascript">
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                	.css('display','inline-block')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>