<?php
  error_reporting(0);
  session_start();
	include 'header.php'; 
  include 'db.php';

  if(isset($_SESSION['cus_email'])){
      header('location: NoAccess.php');
  }
  else if(!isset($_SESSION['cus_email']) && !isset($_SESSION['resUsername'])){
      header('location: index.php?mssg= Please SignIn to Access Menu Page');
  }

  if(isset($_POST['itemSubmit'])){

    $name = $_POST['itemName'];
    $image = $_FILES['itemImage'];
    $price = $_POST['itemPrice'];
    $category = $_POST['itemCategory'];
    $res_id = $_SESSION['res_id'];

    $targetDir = 'assets/images/';
    $imagePath = $image['tmp_name'];
    $imageName = $image['name'];
    
    $dest = $targetDir.$imageName;

    if($imageName != "" && ($file_type="image/jpeg"||$file_type="image/png" || $file_type="image/jpg")){
      if(move_uploaded_file($imagePath,$dest)){
        $sql = "INSERT into items(item_name,resturant_id,item_image,item_price,item_category) values('$name','$res_id','$imageName','$price','$category')";
        
        $res = mysqli_query($con,$sql);
        if($res){
          header('location: menuItems.php?mssg=Item Added Sucessfully!!!');
        }
        else{
          header('location: menuItems.php?mssg=Record cannot be inserted!!!');
        }
      }
      else{
        header('location: menuItems.php?mssg=Error in File Upload!!!');
      }
    }
    else{
      header('location: menuItems.php?mssg=File name is blank or File type should be jpeg or png!!!');
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
  		<h1>Add Menu Items</h1>
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
        <form class="form-container" method="POST" action="menuItems.php" enctype="multipart/form-data">
        <div class="form-group">
           <label for="itemName">Item name</label>
          <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Enter Item Name">
        </div>

        <div class="form-group">
          <label for="itemImage">Item Image</label>
          <input type="file" class="form-control" id="itemImage" onchange="readURL(this);" name="itemImage">
          <img id="blah" src="#" alt="your image" style="display: none;" />
        </div>

        <div class="form-group">
          <label for="itemPrice">Item Price</label>
         	<input type="text" class="form-control" id="itemPrice" name="itemPrice" placeholder="Enter Amount">
        </div>

        <div class="radio">
          <label><input type="radio" name="itemCategory" value="Vegetarian"> Vegetarian</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <label><input type="radio" name="itemCategory" value="Non-Vegetarian"> Non-Vegetarian</label>
        </div>
        <button type="submit" name="itemSubmit" class="btn btn-primary btn-block">Submit</button>
        
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