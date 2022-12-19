<?php
session_start();
include('conn.php');
function passwordvalidity($passwordvalue)
{
    $commonPassword = array("123456", "123456789", "12345", "qwerty", "password", "12345678", "111111", "123123", "1234567890", "1234567", "qwerty123", "000000", "1q2w3e", "aa12345678", "abc123", "password1", "1234", "qwertyuiop", "123321", "password123", "1q2w3e4r5t", "iloveyou", "654321", "666666", "987654321", "123", "123456a", "qwe123", "1q2w3e4r", "7777777", "1qaz2wsx", "123qwe", "zxcvbnm", "121212", "asdasd", "a123456", "555555", "dragon", "112233", "123123123", "monkey", "11111111", "qazwsx", "159753", "asdfghjkl", "222222", "1234qwer", "qwerty1", "123654", "123abc", "asdfgh", "777777", "aaaaaa", "myspace1", "88888888", "fuckyou", "123456789a", "999999", "888888", "football", "princess", "789456123", "147258369", "1111111", "sunshine", "michael", "computer", "qwer1234", "daniel", "789456", "11111", "abcd1234", "q1w2e3r4", "shadow", "159357", "123456q", "1111", "samsung", "killer", "asd123", "superman", "master", "12345a", "azerty", "zxcvbn", "qazwsxedc", "131313", "ashley", "target123", "987654", "baseball", "qwert", "asdasd123", "qwerty", "soccer", "charlie", "qweasdzxc", "tinkle", "jessica", "q1w2e3r4t5", "asdf", "test1", "1g2w3e4r", "gwerty123", "zag12wsx", "gwerty", "147258", "12341234", "qweqwe", "jordan", "pokemon", "q1w2e3r4t5y6", "12345678910", "1111111111", "12344321", "thomas", "love", "12qwaszx", "102030", "welcome", "liverpool", "iloveyou1", "michelle", "101010", "1234561", "hello", "andrew", "a123456789", "a12345", "Status", "fuckyou1", "1qaz2wsx3edc", "hunter", "princess1", "naruto", "justin", "jennifer", "qwerty12", "qweasd", "anthony", "andrea", "joshua", "asdf1234", "12345qwert", "1qazxsw2", "marina", "love123", "111222", "robert", "10203", "nicole", "letmein", "football1", "secret", "1234554321", "freedom", "michael1", "11223344", "qqqqqq", "123654789", "chocolate", "12345q", "internet", "q1w2e3", "google", "starwars", "mynoob", "qwertyui", "55555", "qwertyu", "lol123", "lovely", "monkey1", "nikita", "pakistan", "7758521", "87654321", "147852", "jordan23", "212121", "123789", "147852369", "123456789q", "qwe", "forever", "741852963", "123qweasd", "123456abc", "1q2w3e4r5t6y", "qazxsw", "456789", "232323", "999999999", "qwerty12345", "qwaszx", "1234567891", "456123", "444444", "qq123456", "xxx");
    if (!in_array($passwordvalue, $commonPassword)) {
        return true;
    } else {
        return false;
    }
};
//condition isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])
if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
    //your site secret key

    $secret = '6LcxxlEgAAAAAGAbp0p2FnEu-K1DIXtXBGn71jZn';
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    print_r($responseData);

    // $name = !empty($_POST['name']) ? $_POST['name'] : '';
    // $email = !empty($_POST['email']) ? $_POST['email'] : '';
    // $message = !empty($_POST['message']) ? $_POST['message'] : '';
    // $user_id = $_SESSION['otpid'];
    //condition $responseData->success
    if ($responseData->success) {
        //start
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function check_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $date = date("Y/m/d");
            $email = check_input($_POST['email']);
            $fullname = check_input($_POST['fullname']);
            $username = check_input($_POST['username']);
            $password = check_input($_POST['password']);
            $orgpassword = check_input($_POST['password']);
            $password = openssl_encrypt(
                $password,
                $cipher_algo,
                $encrypt_key,
                $option,
                $encrypt_iv
            );

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['sign_msg'] = "Invalid email format";
                header('location:signup.php');
            } else {
                $query = mysqli_query($conn, "select * from user where email='$email'");
                $query2 = mysqli_query($conn, "select * from user where username='$username'");
                if (mysqli_num_rows($query) > 0) {
                    $_SESSION['sign_msg'] = "Email already taken";
                    header('location:signup.php');
                } elseif (mysqli_num_rows($query2) > 0) {
                    $_SESSION['sign_msg'] = "Username already taken";
                    header('location:signup.php');
                } else {
                    if (passwordvalidity($orgpassword)) {
                        //if password is unqiue (validated) following code will run

                        //depends on how you set your verification code
                        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $code = substr(str_shuffle($set), 0, 12);

                        mysqli_query($conn, "INSERT INTO user(`fullname`,`username`, `email`, `password`,`acc_create_date`,`verify`,`code`,`failedloginAttempts`,`passwordchangedate`) VALUES('$fullname','$username','$email', '$password','$date',0,'$code',0,'$date')");
                        //$uid = mysqli_insert_id($conn);
                        $query = mysqli_query($conn, "select * from user where email='$email'");
                        $row = mysqli_fetch_array($query);
                        $uid = $row['userid'];
                        //default value for our verify is 0, means it is unverified

                        //sending email verification
                        $to = $email;
                        $subject = "Sign Up Verification Code";
                        $message = "
                        <html>
                        <head>
                        <title>Verification Code</title>
                        </head>
                        <body>
                        <h2>Thank you for Registering.</h2>
                        <p>Your Account:</p>
                        <p>Email: " . $email . "</p>
                        <p>Password: " . $_POST['password'] . "</p>
                        <p>Please click the link below to activate your account.</p>
                        <h4><a href='http://localhost/loggerslogin/activate.php?uid=$uid&code=$code'>Activate My Account</h4>
                        </body>
                        </html>
                        ";
                        //dont forget to include content-type on header if your sending html
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
                            "CC: loggerslogin134@gmail.com";
                        mail($to, $subject, $message, $headers);

                        $_SESSION['sign_msg'] = "Verification code sent to your email.";
                        header('location:signup.php');
                    } else {
                        $_SESSION['sign_msg'] = "Please use a strong/unique password";
                        header('location:signup.php');
                    }
                }
            }
        }

        //end
    } else {
        $_SESSION['sign_msg'] = 'Robot verification failed, please try again.';
        header('location:signup.php');
    }
} else {
    $_SESSION['sign_msg'] = 'Please click on the reCAPTCHA box.';
    header('location:signup.php');
}
