<?php
include('conn.php');
$doemail = false;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];
    $uid = $_SESSION['otpid'];
    $querystring = "select * from user where userid='$uid'";
    $query = mysqli_query($conn, $querystring);
    $row = mysqli_fetch_array($query);
    if ($otp == $row['code']) {
        //on sucessfull login

        //send login info to email now
        $otp = $_POST['otp'];
        $uid = $_SESSION['otpid'];
        //$_SESSION['id'] = $uid;
        $querystring = "select * from user where userid='$uid'";
        $query = mysqli_query($conn, $querystring);
        $row = mysqli_fetch_array($query);
        $to = $row['email'];
        $_SESSION['username'] = $row['username'];
        $subject = "Device Logged in !!!";
        date_default_timezone_set('Australia/Melbourne');
        $date = date('m/d/Y h:i:s a', time());
        $message = "
                <html>
                <head>
                <title>Device Logged in</title>
                </head>
                <body>
                <h2>A device just logged in at $date </h2>
                <p>If it's not you. We suggest to change the password as soon as possible.
                </p>
                <p>To change your password </p>
                <h4><a href='http://localhost/loggerslogin/login.php'>Click Here !!!</h4>
                </body>
                </html>
                ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
            "CC: loggerslogin134@gmail.com";
        if ($doemail) {
            mail($to, $subject, $message, $headers);
        } else {
        }
        $_SESSION['id'] = $uid;

        header('location:index.php');
    } else {
        //on invaid oce or unsucessfull login
        $_SESSION['sign_msg'] = "Invalid Code";
        //$_SESSION['sign_msg'] =  "session id = $uid";
        header('location:VerifyLoginForm.php');
    }
}
