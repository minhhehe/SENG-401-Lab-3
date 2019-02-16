<?php
/*
    Database connection configuration file
    Remember to rename this file to dbConnector.php
 */

$host = 'localhost';
$db = 'SENG401';
$username = 'my_username';
$password = 'my_password';

$dsn = "mysql:host=$host;port=3306;dbname=$db";
$conn = new PDO($dsn, $username, $password);
 ?>
