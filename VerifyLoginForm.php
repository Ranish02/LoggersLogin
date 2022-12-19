<?php
include('conn.php');
session_start();
$title = 'Verify Login';
$page = 'Login';
include_once('header.php');
?>

<!DOCTYPE html>

<head>
    <title>Verify your login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>
    <div class="container">
        <div id="login_form" class="well">
            <h2>
                <center><span class="glyphicon glyphicon-lock"></span>Enter the OTP to login</center>
            </h2>
            <div class="form-element">
                <form action="verifyloginotp.php" method="post">
                    <label for="otp">Code:</label>
                    <input type="text" name="otp" id="otp" class="form-control" required>
                    <div><br></div>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save">Verify</button>
                    <br>
                    <div class="already"><a href="signup.php">Back to Login</a></div>
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