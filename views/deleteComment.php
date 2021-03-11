<?php
session_start();
include '../includes/database_connection.php';
$postID = $_SESSION['postID'];


$pdo_stm = $pdo->prepare("DELETE from comments where commentID=" . $_GET['id']);
$pdo_stm->execute();    
header("location:blogComments.php?id=$postID");

?>