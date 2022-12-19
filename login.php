<?php
include('conn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	function check_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$email = check_input($_POST['email']);
	$password = md5(check_input($_POST['password']));

	if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
		$secret = '*********************';
		//get verify response data
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
		if ($responseData->success) {
			$_SESSION['log_msg'] = "Verifired";
		} else {
			$_SESSION['log_msg'] = 'Robot verification failed, please try again.';
		}
	} else {
		$_SESSION['log_msg'] = 'Please click on the reCAPTCHA box.';
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['log_msg'] = "Invalid email format";
		header('location:index.php');
	} else {
		$querylogin = mysqli_query($conn, "select * from user where email='$email'");
		$row2 = mysqli_fetch_array($querylogin);
		if (mysqli_num_rows($querylogin) == 0) {
			$_SESSION['log_msg'] = "User not found";
			header('location:index.php');
		} else {
			$query = mysqli_query($conn, "select * from user where email='$email' and password='$password'");
			$row = mysqli_fetch_array($query);
			if (mysqli_num_rows($query) == 0) {
				$_SESSION['log_msg'] = "Invalid Login | Login attempts remainning" + 5 - $row['failedloginAttempts	
			'];
				$querylogin = mysqli_query($conn, "update user SET failedloginAttempts = failedloginAttempts +1 WHERE where email='$email'");
				header('location:index.php');
			} elseif ($row['failedloginAttempts'] > 5) {
				$_SESSION['log_msg'] = "Max login Attempts reached!! Reset account";
				header('location:index.php');
			} else {
				$row = mysqli_fetch_array($query);
				if ($row['verify'] == 0) {
					$_SESSION['log_msg'] = "User not verified. Please activate account";
					header('location:index.php');
				} else {
					//$_SESSION['id']=$row['userid'];
					//header('location:index.php');
					//NEW CODE DOWN
					$_SESSION['id'] = $row['userid'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$email = check_input($_POST['email']);
						$password = md5(check_input($_POST['password']));
						$query = mysqli_query($conn, "select * from user where email='$email'");
						if (mysqli_num_rows($query) == 0) {
							$_SESSION['sign_msg'] = "No account found";
							header('location:signup.php');
						} else {
							$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$code = substr(str_shuffle($set), 0, 6);
							$query = mysqli_query($conn, "UPDATE user
						set code = '$code' WHERE email='$email'");
							$uid = mysqli_insert_id($conn);

							//now sending email 
							$to = $email;
							$subject = "Sign Up Verification Code";
							$message = "
									<html>
									<head>
									<title>Login OTP Code</title>
									</head>
									<body>
									<h2></h2>
									<p>Email: " . $email . " is logging in</p>
									<p>And your OTP is $code</p>
									</body>
									</html>
									";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
								"CC: loggerslogin134@gmail.com";

							mail($to, $subject, $message, $headers);

							$_SESSION['sign_msg'] = "Verification code sent to your email.";
						}
					}
					header('location:VerifyLoginForm.php');
					unset($_SESSION['sign_msg']);
				}
			}
		}
	}
}
