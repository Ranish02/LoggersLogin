<?php
session_start();
include('conn.php');
$title = 'Home';
$page = 'home';
include_once('header.php');
if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    $query = mysqli_query($conn, "select * from user where userid='$userid'");
    $row = mysqli_fetch_array($query);
    $code = $row['code'];
    $email = $row['email'];
    $fullname = $row['fullname'];
    $verify = $row['verify'];
    if ($verify = 1) {
        $verified = 'Yes';
    } else {
        $verified = 'No';
    }

    $username = $row['username'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

    </head>
    <link rel="stylesheet" href="CSS/myaccount.css">

    <body>
        <table>
            <thead>
                <tr>
                    <td>Details</td>
                    <td style="background: rgb(132, 255, 159);">Information</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Fullname</th>
                    <td data-column="Last Name"><?php echo $fullname
                                                ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td data-column="Last Name"><?php echo $username
                                                ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td data-column="Last Name"><?php echo $email
                                                ?></td>
                </tr>
                <tr>
                    <th>Verified</th>
                    <td data-column="Last Name"><?php echo $verified
                                                ?></td>
                </tr>
            </tbody>
        </table>
    </body>

    </html>
<?php
} else {
    echo "Please login first";
}
?>