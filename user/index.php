

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login User</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../assets/images/logo1.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Backend/Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Backend/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Backend/Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
					<span class="login100-form-title p-b-26">
                    <img src="../assets/images/logo1.png" alt="">
					</span>
					
					<form action="login.php" method="post" class="login100-form validate-form">
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input  type="text" class="input100" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Masukkan password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
                    
					<!-- <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="#">
							Sign Up
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="../Backend/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../Backend/Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../Backend/Login/js/main.js"></script>

</body>
</html>