<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="shortcut icon" href="<?php echo base_url();?>./assets/images/rumahsakit2.png">
    <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/menuloginnew/css/style.css">

<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("");?>assets/menuloginnew/other/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="wrapper">
		<div class="container-login100" style="background-image: url('./assets/menuloginnew/other/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="<?php echo base_url("");?>index.php/Controllogin/loginuser/">
					<span class="login100-form-title p-b-20">
						Login
					</span>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="USER_ID" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="ID" maxlength="4" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-0">
						<a href="#">
							<br>
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
					<br>
						<center>
						<span class="label-input100">Copyright &copy; 2018 | RSHM Cibarusah</span>
						</center>
					<!--<div class="flex-c-m">
						<a href="#" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>
					-->
					
				</form>
			</div>
		</div>
		<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	</div>
	
	</div>
	

<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("");?>assets/menuloginnew/other/js/main.js"></script>

</body>
</html>