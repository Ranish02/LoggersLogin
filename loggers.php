<?php
session_start();
include('conn.php');
if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    $query = mysqli_query($conn, "select * from user where userid='$userid'");
    $row = mysqli_fetch_array($query);
    $username = $row['username'];
    $date = date("Y/m/d");
    $changedate = $row['passwordchangedate'];
    $dateDiff = dateDiffInDays($date, $changedate);
    if ($dateDiff >= 30) {
        $_SESSION['sign_msg'] = 'Change your password since its over 1 month old';
        header('location:changepassword.php');
    }
}
$title = 'Home';
$page = 'home';
include_once('header.php');
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
    <title>HomePage</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="loggers2.css"> -->
    <link rel="stylesheet" href="CSS/header.css">
</head>

<body>
    <div class="grid image-grid">

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img1" src="https://lh3.googleusercontent.com/pw/ACtC-3eqDpYXSzQK9Gr8Dm6pRBTXg65teqvPUlndvrG31BEmbHGYSiGja4ZhpI86_b5pYG_nWHZvi0-a2svpmvqtfGHSqLAypliNdl9vI-xGKT0XixvVSzroZ0e7HXFeyVoNyU5XMuMoEzf5f6VgQbmIO2yr=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img2" src="https://lh3.googleusercontent.com/pw/ACtC-3eO9L51TGiTghLao-VLNhO_C0egdgv7NfamlpdYbMAKCfXNlkk7WPPcxMJTaU9hO-HNnTqUivtavZ-6iK9mzoq0Qf3kJ5MAcnCoDUqbzd8VzpFKhu3mqDYZBG0KNGVxNHSEUwUiTxCUEFf_yFnNNLL0=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img3" src="https://lh3.googleusercontent.com/pw/ACtC-3dhqk2CMZiOyFNPfjfffFIRIp1r9XjSNhfWHXk3gHDNf0hGwwWtXlQbtTf7DBp9t_KnCVull_WGpXNDVRtLkslw1qskUAjbSMEilFituKSeJVKqzVbsTFOeLfvd92nowevb7EGG3Pno37_WfsShZnYP=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img4" src="https://lh3.googleusercontent.com/pw/ACtC-3eYKEnL-pUFhF9aCKHKKRNrWEyJJ-7SCD8-EJLpBkVKp6jIHEKvBGiOL0hPW5f6UAcyoxaR06XRDUayk0NaQMxpSWCjnNyqdypHsIzrPfSwQZmOBR4-i3VCc0Ywg9CUmFYv2vs-rbmEmio2-4ZUuokZ=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img5" src="https://lh3.googleusercontent.com/pw/ACtC-3ckl0QrFbuW3W6VJ88rW0TeCZYumT9H7ZzN1dW6nrxOcf6mxEYT79iai43_T8i9AbiViFkpJBqVtS6d7loh-IgUwviFhdnkg1U-BNgeBPvstSBHCqWokHbx3EIHTkZFh3QkaTykBxZH7BqYvni2ukTL=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img6" src="https://lh3.googleusercontent.com/pw/ACtC-3csXE_23DqssKWd76nUGNa5re7em4ySmZEif2L_jxJBpIV0pV3qHYXQope682nX2Qs04nhMHVZlNNwbUGzz6CWjaywX5VaH5TX2Wrh0iocAk5aRrN2ud7H55mGYdR-z-QEyK5ckiZ4BGZLiSpXe-TmD=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img7" src="https://lh3.googleusercontent.com/pw/ACtC-3fbpkwsUjaB8Cv6JFW_Z5E_7WjTwR3hEfafXoDmSsxBN_I_TKHLw3ngMCcOhYVv0KrzdJpjBfRzmTPVUikRZpyy53lb10ENbvWxrP-Hf83Y1KXc2RG0zLXoXqQjaT7NP9bBKEY7iv2I8sRIUJxCU9ql=w1703-h973-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img8" src="https://lh3.googleusercontent.com/pw/ACtC-3cCwp7dKtvwMA8uf_Y3OTxZz-CiYRpay0fSZhfqYXCeDWBBfQERYnB7DzDCbsyyzdzoOU7_9BbW3WR5VaY9YPD3syn3VgZDxj6-2qTOwDw_HDlnLd92LlvCZIEr8oDKVt4AU7q-oJNHE6O9sRhGAVMi=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img9" src="https://lh3.googleusercontent.com/pw/ACtC-3ffctj4lOMbhO6QA2a-9o24LTDFytAw4WAnxkpZr3fCDQHPyXTXeXqaI7KrD2ktnpXyfzGKvsax_oekoUGojWEGc9Ghte4ycSxgx6ZydR3LsnJlXO5zKwpoZYIBCIlYxxpq2PNcc9irUdA7P68_rdSY=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

        <div class="grid-block">
            <div class="tile">
                <a class="tile-link" href="#">
                    <img class="tile-img tile-img10" src="https://lh3.googleusercontent.com/pw/ACtC-3dM37DnDx6OrPA4-VazUuGM5p9grWJtW8SLNQ9vo3xZlGTHw8wt6NXShF3umpCjoaM6XUyvIDl8una8MAd4z-hU23Fuz9_AjCkTpQ4YV3k5C0cXPzAq70WhaKHAEFHKcDXGVqAZVl5HgOSr9hSbHrLr=w1384-h791-no" alt="Image">
                </a>
            </div>
        </div>

    </div>
</body>

</html>