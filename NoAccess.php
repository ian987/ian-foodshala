<?php
	error_reporting(0);
	include 'header.php';

?>

<?php if(isset($_GET['access']) && $_GET['access'] == 'customer') ?>{
	<div class="alert alert-danger" style="margin: 20px;" role="alert">Customer doesnot have access to this page!!! Please SignIn as Resturant</div>
<?php 
	} else {
?>
	<div class="alert alert-danger" style="margin: 20px;" role="alert">Resturant doesnot have access to this page!!! Please SignIn as Customer</div>
<?php } ?>
<button class="btn btn-primary" style="margin: 20px;" onclick="goback()">Go Back to Home Page</button>

<script type="text/javascript">
	function goback(){
		window.location.href = "index.php";
	}
</script>