<?php
session_start();
include '../includes/database_connection.php';

$pdo_stm = $pdo->prepare("DELETE from posts where postID=" . $_GET['id']);
$pdo_stm->execute();
header("location:../loggedin.php");

?>