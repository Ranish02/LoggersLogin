<?php
session_start();
include('conn.php');
$title = 'Login';
$page = 'index';
include_once('header.php');

if (isset($_SESSION['id'])) {
	header('location:loggers.php');
}
function dateDiffInDays($date1, $date2)
{
	// Calculating the difference in timestamps
	$diff = strtotime($date2) - strtotime($date1);

	// 1 day = 24 hours
	// 24 * 60 * 60 = 86400 seconds
	return abs(round($diff / 86400));
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Sign up Form with Email Verification in PHP/MySQLi</title>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

	<link rel="stylesheet" href="CSS/login.css">
</head>

<body>
	<div class="container">
		<div id="login_form" class="well">
			<h2>
				<center><span class="glyphicon glyphicon-lock"></span> Please Login</center>
			</h2>
			<hr>
			<div class="form-element">
				<form method="POST" action="loginmytry.php">
					<label for="email">Email</label> <input type="text" name="email" class="form-control" required>

					<label for="password" class="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" required>
					<div class="flex">
						<span id="click">
							<i class="bi bi-eye-slash" id="clicks"></i>
						</span>
					</div>

					<div class="text"></div>
					<div class="g-recaptcha" data-sitekey="6LcxxlEgAAAAAFQ1FOD15_APPbW3_2D6jEJeUDmQ" required></div>
					<!-- <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button> <br>
			No account? <a href="signup.php"> Sign up</a> -->
					<div><br></div>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save">Login</button>
					<br>
					<div class="already">No account?<a href="signup.php">Sign up</a></div>
					<div class="already"><a href="forgotpassword.php">Trouble Logging in?</a></div>
				</form>
			</div>
		</div>
		<?php
		//session_start();
		if (isset($_SESSION['sign_msg'])) {
		?>
			<div class="alert alert-danger">
				<span>
					<div class="center">
						<?php echo $_SESSION['sign_msg'];
						unset($_SESSION['sssign_msg']);
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
<script src="Javascript/loginjs.js"></script>

</html>