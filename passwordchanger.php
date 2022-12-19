<?php
include('conn.php');
session_start();
function passwordvalidity($passwordvalue)
{
    $commonPassword = array("123456", "123456789", "12345", "qwerty", "password", "12345678", "111111", "123123", "1234567890", "1234567", "qwerty123", "000000", "1q2w3e", "aa12345678", "abc123", "password1", "1234", "qwertyuiop", "123321", "password123", "1q2w3e4r5t", "iloveyou", "654321", "666666", "987654321", "123", "123456a", "qwe123", "1q2w3e4r", "7777777", "1qaz2wsx", "123qwe", "zxcvbnm", "121212", "asdasd", "a123456", "555555", "dragon", "112233", "123123123", "monkey", "11111111", "qazwsx", "159753", "asdfghjkl", "222222", "1234qwer", "qwerty1", "123654", "123abc", "asdfgh", "777777", "aaaaaa", "myspace1", "88888888", "fuckyou", "123456789a", "999999", "888888", "football", "princess", "789456123", "147258369", "1111111", "sunshine", "michael", "computer", "qwer1234", "daniel", "789456", "11111", "abcd1234", "q1w2e3r4", "shadow", "159357", "123456q", "1111", "samsung", "killer", "asd123", "superman", "master", "12345a", "azerty", "zxcvbn", "qazwsxedc", "131313", "ashley", "target123", "987654", "baseball", "qwert", "asdasd123", "qwerty", "soccer", "charlie", "qweasdzxc", "tinkle", "jessica", "q1w2e3r4t5", "asdf", "test1", "1g2w3e4r", "gwerty123", "zag12wsx", "gwerty", "147258", "12341234", "qweqwe", "jordan", "pokemon", "q1w2e3r4t5y6", "12345678910", "1111111111", "12344321", "thomas", "love", "12qwaszx", "102030", "welcome", "liverpool", "iloveyou1", "michelle", "101010", "1234561", "hello", "andrew", "a123456789", "a12345", "Status", "fuckyou1", "1qaz2wsx3edc", "hunter", "princess1", "naruto", "justin", "jennifer", "qwerty12", "qweasd", "anthony", "andrea", "joshua", "asdf1234", "12345qwert", "1qazxsw2", "marina", "love123", "111222", "robert", "10203", "nicole", "letmein", "football1", "secret", "1234554321", "freedom", "michael1", "11223344", "qqqqqq", "123654789", "chocolate", "12345q", "internet", "q1w2e3", "google", "starwars", "mynoob", "qwertyui", "55555", "qwertyu", "lol123", "lovely", "monkey1", "nikita", "pakistan", "7758521", "87654321", "147852", "jordan23", "212121", "123789", "147852369", "123456789q", "qwe", "forever", "741852963", "123qweasd", "123456abc", "1q2w3e4r5t6y", "qazxsw", "456789", "232323", "999999999", "qwerty12345", "qwaszx", "1234567891", "456123", "444444", "qq123456", "xxx");
    if (!in_array($passwordvalue, $commonPassword)) {
        return true;
    } else {
        return false;
    }
};
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //$email = check_input($_POST['email']);
    $userid = check_input($_POST['userid']);
    $password = check_input($_POST['password']);
    $orgpassword = check_input($_POST['password']);
    $date = date("Y/m/d");

    $password = openssl_encrypt(
        $password,
        $cipher_algo,
        $encrypt_key,
        $option,
        $encrypt_iv
    );
    $current_password = check_input($_POST['current_password']);
    $current_password = openssl_encrypt(
        $current_password,
        $cipher_algo,
        $encrypt_key,
        $option,
        $encrypt_iv
    );
    //code is provided
    if (isset($_POST['code'])) {
        $code = check_input($_POST['code']);
        //if posted this will happen
        $query = mysqli_query($conn, "select * from user where userid='$userid'and code='$code'");
        $row = mysqli_fetch_array($query);
        $email = $row['email'];
        if ($row['code'] == $code) {
            if ($row['password'] == $password) {
                $_SESSION['sign_msg'] = "Please use new password";
                header('location:changepassword.php');
            } else {
                if (passwordvalidity($orgpassword)) {
                    $queryupdate = mysqli_query($conn, "update user SET password = '$password', passwordchangedate='$date' WHERE userid='$userid'");
                    $_SESSION['sign_msg'] = "Password Changed";
                    $to = $email;
                    $subject = "Password Changed";
                    $message = "
                    <html>
                    <head>
                    <title>PYour Password was just changed</title>
                    </head>
                    <body>
                    <h2>Someone just changed your password</h2>
                    <p>Your Account:</p>
                    <p>Email: " . $email . "</p>
                    <p>If it wasn't you. Please click the link below to change your password.</p>
                    <h4><a href='http://localhost/loggerslogin/changepassword.php?uid=$userid&code=$code'>Change my Password</h4>
                    </body>
                    </html>
                    ";
                    //dont forget to include content-type on header if your sending html
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
                        "CC: loggerslogin134@gmail.com";

                    mail($to, $subject, $message, $headers);
                    session_start();
                    session_destroy();
                    $_SESSION['sign_msg'] = "Password Changed | Please Login again";
                    header('location:changepassword.php');
                } else {
                    $_SESSION['sign_msg'] = "Please use a strong/unique password";
                    header('location:changemypassword.php');
                }
            }
        } else {
            $_SESSION['sign_msg'] = "Invalid Link";
            header('location:signup.php');
        }
    }
    //code isnt provided
    elseif (isset($_POST['current_password'])) {
        if (isset($_SESSION['id'])) {
            $userid = $_SESSION['id'];
            $query = mysqli_query($conn, "select * from user where userid='$userid'");
            $row = mysqli_fetch_array($query);
            $email = $row['email'];
            $code = $row['code'];
            // $email = $row['email'];
            // $query = mysqli_query($conn, "select * from user where userid='$userid' and password = '$current_password'");
            // $row = mysqli_fetch_array($query);
            if ($row['password'] == $current_password) {
                if ($row['password'] == $password) {
                    $_SESSION['sign_msg'] = "Please use new password";
                    header('location:changemypassword.php');
                } else {
                    if (passwordvalidity($orgpassword)) {
                        $queryupdate = mysqli_query($conn, "update user SET password = '$password', passwordchangedate='$date' WHERE userid='$userid'");
                        $_SESSION['sign_msg'] = "Password Changed | Please Login again";
                        $to = $email;
                        $subject = "Password Changed";
                        $message = "
                    <html>
                    <head>
                    <title>PYour Password was just changed</title>
                    </head>
                    <body>
                    <h2>Someone just changed your password</h2>
                    <p>Your Account:</p>
                    <p>Email: " . $email . "</p>
                    <p>If it wasn't you. Please click the link below to change your password.</p>
                    <h4><a href='http://localhost/loggerslogin/changepassword.php?uid=$userid&code=$code'>Change my Password</h4>
                    </body>
                    </html>
                    ";
                        //dont forget to include content-type on header if your sending html
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: loggerslogin134@gmail.com" . "\r\n" .
                            "CC: loggerslogin134@gmail.com";

                        mail($to, $subject, $message, $headers);
                        session_start();
                        session_destroy();
                        $_SESSION['sign_msg'] = "Password Changed";
                        header('location:changemypassword.php');
                    } else {
                        $_SESSION['sign_msg'] = "Please use a strong/unique password";
                        header('location:changemypassword.php');
                    }
                }
            } else {
                $_SESSION['sign_msg'] = "Wrong Password";
                header('location:changemypassword.php');
            }
        } else {
            $_SESSION['sign_msg'] = "Invalid Request";
            header('location:changemypassword.php');
        }
    }
}
