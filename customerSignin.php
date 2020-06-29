<?php
  error_reporting(0);
  session_start();
  include 'header.php'; 
  include 'db.php';

  if(isset($_POST['cusSignin'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $customerEmail = array();
    $sql1 = "SELECT cus_email from customer";
    $res1 = mysqli_query($con,$sql1);
    while($row1 = mysqli_fetch_assoc($res1))
      array_push($customerEmail, $row1['cus_email']);

    if(!in_array($email, $customerEmail)){
      
      $error = "Email ID doesn't exist. Please SignUp";
      header("location: customerSignup.php?mssg=$error");
    }
    else{ 
      $sql = "SELECT * from customer where cus_email = '$email' and cus_password = '$password'";
      $res = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($res);

      if($row == ""){
        $error = "Your email or password is invalid";
        header("location: customerSignin.php?mssg=$error");
      }
      else{
        if($row){
          $_SESSION['cus_email'] = $email;
          $_SESSION['cus_name'] = $row['cus_name'];
          $_SESSION['cus_id'] = $row['cus_id'];
          header("location: index.php");
        }
      }
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
  		<h1>Customer Login Form</h1>
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
        <form class="form-container" method="POST" action="customerSignin.php">
        <div class="form-group">
           <label for="email">Email Address</label>
           <input type="email" class="form-control" id="email" name="email" aria-describeby="emailHelp" placeholder="Enter email">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" name="cusSignin" class="btn btn-primary btn-block">Submit</button>
        <div class="form-footer">
          <p> Don't have an account? <a href="customerSignup.php">Sign Up</a></p>     
        </div>
        </form>
      </section>
    </section>
  </section>
<!-- Login form creation ends -->
</body>
</html>