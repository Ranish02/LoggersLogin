<?php
session_start();
$_SESSION['id'] = 2;
header('loggers.php');
