<?php
  error_reporting(0);
	include 'header.php'; 
  include 'db.php';

  if(isset($_POST['cusSignup'])){

    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $pref = $_POST['cusPref'];

    $sql = "INSERT into customer(cus_name,cus_email,cus_contact,cus_pref,cus_password) values('$name','$email','$contact','$pref','$password')";
    
    $res = mysqli_query($con,$sql);

    if($res){
      $success = "Registration Successfull!! Please SignIn";
      header("location: customerSignin.php?mssg=$success");
    }
    else{
      $error = "Something went wrong!! Please register again";
      header("location: customerSignup.php?mssg=$error");
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
  		<h1>Customer Registration Form</h1>
  	</div>

     <?php
      if($_REQUEST['mssg']){
    ?>
      <div class="alert alert-primary" role="alert"><?php echo $_REQUEST['mssg'];?></div>

    <?php } ?> 

    <!-- row and justify-content-center class is used to place the form in center -->
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4" style="margin-top: 30px;">
        <form class="form-container" method="POST" action="customerSignup.php">
        <div class="form-group">
          <label for="fullName">Full Name</label>
           <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Full Name">
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
           <input type="email" class="form-control" id="email" name="email" aria-describeby="emailHelp" placeholder="Enter email">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
          <label for="contact">Contact No</label>
          <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact No">
        </div>

        <div class="radio">
          <label><input type="radio" name="cusPref" value="Vegetarian"> Vegetarian</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <label><input type="radio" name="cusPref" value="Non-Vegetarian"> Non-Vegetarian</label>
        </div>
        <button type="submit" name="cusSignup" class="btn btn-primary btn-block">Submit</button>
        <div class="form-footer">
          <p> Have an account? <a href="customerSignin.php">Sign In</a></p>     
        </div>
        </form>
      </section>
    </section>
  </section>
<!-- Login form creation ends -->
</body>
</html>