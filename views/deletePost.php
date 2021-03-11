<?php
session_start();
include '../includes/database_connection.php';

// För att radera alla kommentarer som hör till den här posten
$pdo_stm = $pdo->prepare("DELETE FROM comments where postID=" . $_GET['id']);
$pdo_stm->execute();


// För att radera posten
$pdo_stm2 = $pdo->prepare("DELETE from posts where postID=" . $_GET['id']);
$pdo_stm2->execute();
header("location:loggedin.php");

?>