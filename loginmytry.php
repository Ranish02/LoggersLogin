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
    $password = check_input($_POST['password']);
    $org_pass = $password;
    $password = openssl_encrypt(
        $password,
        $cipher_algo,
        $encrypt_key,
        $option,
        $encrypt_iv
    );
    //racketts vitra : isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        //your site secret key

        $secret = '6LcxxlEgAAAAAGAbp0p2FnEu-K1DIXtXBGn71jZn';
        // //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        //if captacha response is sucessfull
        if ($responseData->success) {
            //if google recaptcha is verified:
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['sign_msg'] = "Invalid email format";
                header('location:index.php');
            } else {
                $query = mysqli_query($conn, "select * from user where email='$email'");
                $row = mysqli_fetch_array($query);
                if (mysqli_num_rows($query) == 0) {
                    $_SESSION['sign_msg'] = "User not found";
                    header('location:index.php');
                } else {
                    if ($password == $row['password']) {
                        if ($row['failedloginAttempts'] >= 5) {
                            //$_SESSION['sign_msg'] = "Max login Attempts reached!! Reset account";
                            $_SESSION['sign_msg'] = "Max attempt reached! Reset Account to Continue";
                            header('location:index.php');
                        } else {
                            //email entered and password right
                            $queryupdate = mysqli_query($conn, "update user SET failedloginAttempts = 0 WHERE email='$email'");
                            //RESET LOGIN ATTEMPT TO 0
                            if ($row['verify'] == 0) {
                                $_SESSION['sign_msg'] = "User not verified. Please activate account123";
                                header('location:index.php');
                            } else {
                                //SENDING EMAIL NOW

                                //$_SESSION['id']=$row['userid'];
                                //header('location:index.php');
                                //NEW CODE DOWN
                                $_SESSION['otpid'] = $row['userid'];
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $email = check_input($_POST['email']);
                                    $password = md5(check_input($_POST['password']));
                                    $query = mysqli_query($conn, "select * from user where email='$email'");
                                    if (mysqli_num_rows($query) == 0) {
                                        $_SESSION['sign_msg'] = "No account found";
                                        header('location:index.php');
                                    } else {
                                        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $code = substr(str_shuffle($set), 0, 6);
                                        $query = mysqli_query($conn, "UPDATE user
                            set code = '$code' WHERE email='$email'");
                                        $uid = mysqli_insert_id($conn);

                                        //now sending email 
                                        $to = $email;
                                        $subject = "Login Verification Code";
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
                                        $_SESSION['sign_msg'] = "OTP code sent to your email.";
                                    }
                                }
                                header('location:VerifyLoginForm.php');
                            }
                        };
                    } else {
                        //email entered and password wrong
                        if ($row['failedloginAttempts'] >= 5) {
                            //$_SESSION['sign_msg'] = "Max login Attempts reached!! Reset account";
                            $_SESSION['sign_msg'] = "Max attempt reached! Reset Account to Continue";
                            header('location:index.php');
                        } else {
                            $attempts_rem = 5 - $row['failedloginAttempts'];
                            $_SESSION['sign_msg'] = "Invalid Login | Login attempts remaining $attempts_rem";
                            $queryupdate = mysqli_query($conn, "update user SET failedloginAttempts = failedloginAttempts +1 WHERE email='$email'");
                            header('location:index.php');
                        };
                    }
                }
            }
        } else {
            $_SESSION['sign_msg'] = "Captcha Verification failed";
            header('location:index.php');
        }
    } else {
        $_SESSION['sign_msg'] = "Please click on Captcha";
        header('location:index.php');
    }
}
