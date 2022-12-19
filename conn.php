<?php
$servername = "sql300.epizy.com";;
$username = "epiz_31902796";;
$password = "n4R8RX6hwoFV";;
$dbname = "epiz_31902796_sample";
//
// encryption conn:
//$cipher_algo = "AES-256-CTR";
$cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
$iv_length = openssl_cipher_iv_length($cipher_algo); //The length of the initialization vector
$option = 0; //Bitwise disjunction of flags
$encrypt_iv = '8746376827619797'; //Initialization vector, non-null
$encrypt_key = "Delftstackk!";
$encryption_key = openssl_random_pseudo_bytes(32);
$decrypt_iv = '8746376827619797'; //Initialization vector, non-null
$decrypt_key = "Delftstackk!"; // The encryption key
// Use openssl_decrypt() to decrypt the string
$conn = mysqli_connect("localhost", "root", "", "loggersdb");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
