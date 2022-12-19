<?php
include('conn.php');
session_start();
$title = 'Home';
$page = 'home';
include_once('header.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = check_input($_POST['email']);
    echo $email;
    //$password = md5(check_input($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['sign_msg'] = "Invalid email format";
        header('location:signup.php');
    } else {
        $query = mysqli_query($conn, "select * from user where email='$email'");
        $row = mysqli_fetch_array($query);
        $uid = $row['userid'];
        if (mysqli_num_rows($query) == 0) {
            $_SESSION['sign_msg'] = "If any account with the email exists. A reset password link will be sent to the Email no acc";
            header('location:forgotpassword.php');
        } elseif (mysqli_num_rows($query) == 1) {
            //depends on how you set your verification code
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($set), 0, 12);
            $query = mysqli_query($conn, "update user SET code = '$code' WHERE userid='$uid'");
            //default value for our verify is 0, means it is unverified

            //sending email verification
            $to = $email;
            $subject = "Reset Password";
            $message = "
				<html>
				<head>
				<title>Password Reset</title>
				</head>
				<body>
				<h2>Someone Requested to change password</h2>
				<p>Your Account:</p>
				<p>Email: " . $email . "</p>
				<p>Please click the link below to change your password.</p>
				<h4><a href='http://localhost/loggerslogin/changepassword.php?uid=$uid&code=$code'>Change my Password</h4>
				</body>
				</html>
				";
            //dont forget to include content-type on header if your sending html
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
                "CC: loggerslogin134@gmail.com";

            mail($to, $subject, $message, $headers);

            $_SESSION['sign_msg'] = "If any account with the email exists. A reset password link will be sent to the Email";
            header('location:forgotpassword.php');
        }
    }
}


?>


<!DOCTYPE html>

<head>
    <title>Forgot your password?</title>
    <link rel="stylesheet" href="CSS/forgotpassword.css">
</head>

<body>
    <div class="container">
        <div id="login_form" class="well">
            <h2>
                <center><span class="glyphicon glyphicon-lock"></span>Getting Back to your Account? <br>Forgot password?</center>
                <span class="h4">A password reset link will be sent to your Email</span>
            </h2>
            <div class="form-element">
                <form action="forgotpassword.php" method="post">
                    <label for="email">Enter you email</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                    <div><br></div>

                    <button type="submit" class="btn btn-primary">Continue<span class="glyphicon glyphicon-save"></button>
                    <br>
                    <div class="flex">
                        <div class="already"> Account Locked? <a href="resetaccount.php">Reset Account</a></div>
                        <br>
                        <div class="already"><a href="index.php">Back to Login</a></div>

                    </div>
            </div>
            <?php
            if (isset($_SESSION['sign_msg'])) {
            ?>
                <div class="alert alert-danger">
                    <span>
                        <div class="center">
                            <?php echo $_SESSION['sign_msg'];
                            unset($_SESSION['sign_msg']);
                            ?>
                        </div>
                </div>
            <?php
            }
            ?>
</body>

</html>