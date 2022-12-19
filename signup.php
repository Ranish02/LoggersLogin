<?php
session_start();
$title = 'Home';
$page = 'home';
include_once('header.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Sign up Form with Email Verification in PHP/MySQLi</title>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Open+San">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- <link rel="stylesheet" href="signup2.css"> -->
	<link rel="stylesheet" href="CSS/signup.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>

<body>
	<div class="container">
		<div id="signup_form" class="well">
			<h2>
				<center><span class="glyphicon glyphicon-user"></span>SIGN UP</center>
			</h2>
			<hr>
			<div class="form-element">
				<form method="POST" action="signupMain.php" id="signupform">
					<label for="fullname">Full Name</label> <input type="text" name="fullname" class="form-control" required>
					<label for="username">Username</label> <input type="text" name="username" class="form-control" required>
					<label for="email">Email</label> <input type="text" name="email" class="form-control" required>
					<label for="password">Password</label>
					<input onkeyup="passwordPreventCommon()" type="password" name="password" id="password" class="form-control" minlength="8" required>

					<div class="flex">
						<span id="click">
							<i class="bi bi-eye-slash" id="clicks"></i>
						</span>
					</div>
					<label for="password">Confirm Password</label>
					<input type="password" id="confirm_password" class="form-control" minlength="8" required>
					<div class="flex">
						<span id="click1">
							<i class="bi bi-eye-slash" id="clicks1"></i>
						</span>
					</div>
					<div class="pw-display-toggle-btn">
						<i class="fa fa-eye"></i>
						<i class="fa fa-eye-slash"></i>
					</div>
					<div class="pw-display-toggle-btn">
						<i class="fa fa-eye"></i>
						<i class="fa fa-eye-slash"></i>
					</div>
					<div class="pw-strength">
						<span>Type a password</span>
						<span></span>
					</div>
					<div class="suggestionpw">
						<span class="text">- 8 Characters</span> <br>
						<span class="text">- Constains Lowercase</span> <br>
						<span class="text">- Constains Uppercase</span> <br>
						<span class="text">- Contains Number</span> <br>
						<span class="text">- Contains Special Characters (!@#$%)</span> <br>
					</div>
					<div class="g-recaptcha" data-sitekey="6LcxxlEgAAAAAFQ1FOD15_APPbW3_2D6jEJeUDmQ" required></div>
					<div><br></div>
					<button type="submit" class="submit"><span class=" glyphicon glyphicon-save">Sign Up</button>
					<br>
					<div class="already">Already Have an Account?<a href="index.php"> Back to Login</a></div>

				</form>
			</div>
			<?php
			//session_start();
			if (isset($_SESSION['sign_msg'])) {
			?>
				<div class="alert alert-danger">
					<span>
						<div class="center">
							<?php echo $_SESSION['sign_msg'];
							unset($_SESSION['sign_msg']);
							?>
						</div>
					</span>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</body>
<script src="Javascript/jssignup.js"></script>

</html>