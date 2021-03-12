<?php
$dsn = "mysql:host=localhost;dbname=bloggsystem";
$user = "root";
$password = "";

$pdo = new PDO ($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>