<?php
  error_reporting(0);
	include 'header.php'; 
  include 'db.php';

  if(isset($_POST['resSignup'])){

    $username = $_POST['resUsername'];
    $name = $_POST['resName'];
    $password = $_POST['resPassword'];

    $sql = "INSERT into resturant(res_name,res_username,res_password) values('$name','$username','$password')";
    $res = mysqli_query($con,$sql);

    if($res){
      $success = "Registration Successfull!! Please SignIn";
      header("location: resturantSignin.php?mssg=$success");
    }
    else{
      $error = "Something went wrong!! Please register again";
      header("location: resturantSignup.php?mssg=$error");
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
  		<h1>Resturant Registration Form</h1>
  	</div>

    <?php
      if($_REQUEST['mssg']){
    ?>
      <div class="alert alert-primary" role="alert" style="margin: 10px;"><?php echo $_REQUEST['mssg'];?></div>

    <?php } ?> 

    <!-- row and justify-content-center class is used to place the form in center -->
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4" style="margin-top: 30px;">
        <form class="form-container" method="POST" action="resturantSignup.php">
        <div class="form-group">
           <label for="resUsername">Username</label>
          <input type="text" class="form-control" id="resUsername" name="resUsername" placeholder="Resturant Username">
        </div>

        <div class="form-group">
          <label for="resName">Resturant Name</label>
          <input type="text" class="form-control" id="resName" name="resName" placeholder="Resturant Name">
        </div>

        <div class="form-group">
          <label for="resPassword">Password</label>
          <input type="password" class="form-control" id="resPassword" name="resPassword" placeholder="Password">
        </div>
        <button type="submit" name="resSignup" class="btn btn-primary btn-block">Submit</button>
        <div class="form-footer">
          <p> Have an account? <a href="resturantSignin.php">Sign In</a></p>     
        </div>
        </form>
      </section>
    </section>
  </section>
<!-- Login form creation ends -->
</body>
</html>