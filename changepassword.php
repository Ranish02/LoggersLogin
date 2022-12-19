<?php
include('conn.php');
session_start();
$title = 'Home';
$page = 'home';
include_once('header.php');
if (isset($_GET['code']) && isset($_GET['uid'])) {
    $userid = $_GET['uid'];
    $code = $_GET['code'];
} elseif (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    $query = mysqli_query($conn, "select * from user where userid='$userid'");
    $row = mysqli_fetch_array($query);
    $code = $row['code'];
} else {
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $userid = check_input($_POST['userid']);
    $oode = check_input($_POST['code']);
}
?>
<!DOCTYPE html>

<head>
    <title>Forgot your password?</title>
    <link rel="stylesheet" href="CSS/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container">
        <div id="signup_form" class="well">
            <h2>
                <center><span class="glyphicon glyphicon-user"></span>Create new password</center>
            </h2>
            <hr>
            <div class="form-element">
                <form method="POST" action="passwordchanger.php">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <input type="hidden" name="code" value="<?php echo $code; ?>">
                    <label for="password">Password</label>
                    <input onkeyup="trigger()" type="password" name="password" id="password" class="form-control" minlength="8" required>

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
                    <div><br></div>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save">Save</button>
                    <br>
                    <div class="already">Want to login?<a href="index.php"> Back to Login</a></div>

                </form>
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