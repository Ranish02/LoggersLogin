<?php
include('conn.php');
if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    $query = mysqli_query($conn, "select * from user where userid='$userid'");
    $row = mysqli_fetch_array($query);
    $username = $row['username'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>HomePage</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="CSS/header.css">
</head>

<body>
    <div class="navbar">
        <a href="loggers.php">Loggers Login</a>
        <a href="loggers.php">Home</a>
        <a href="#about">About</a>
        <a href="videopage.php">Video</a>
        <div class="dropdown">
            <?php
            if (isset($_SESSION['id'])) {
            ?>
                <button class="dropbtn"><i class="bi bi-person-fill"></i><?php echo $username; ?>
                <?php
            } else {
                ?>
                    <button class="dropbtn"><i class="bi bi-person-fill"></i>Account
                    <?php
                }
                    ?>
                    <i class="fa fa-caret-down"></i>
                    </button>

                    <div class="dropdown-content">
                        <?php
                        if (isset($_SESSION['id'])) {
                        ?>
                            <a href="myaccount.php">My Account</a>
                            <a href="changemypassword.php">Change Password</a>
                            <a href="logout.php">Log Out</a>
                        <?php
                        } else {
                        ?>
                            <a href="index.php">Login</a>
                            <a href="signup.php">Sign Up</a>
                        <?php
                        }
                        ?>

                    </div>
        </div>
    </div>

</body>

</html>