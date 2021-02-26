<?php
session_start();
include '../includes/database_connection.php';


$title = $_POST['title'];
$description = $_POST['description'];
$imageUrl = $_POST['imageUrl'];
$category = $_POST['category'];
$date = $_POST['date'];

$sql = "INSERT INTO posts (title,description,imageUrl,category,date) VALUES(:title_IN, :description_IN, :imageUrl_IN, :category_IN, :date_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(':title_IN', $title);
$stm->bindParam(':description_IN', $description);
$stm->bindParam(':imageUrl_IN', $imageUrl);
$stm->bindParam(':category_IN', $category);
$stm->bindParam(':date_IN', $date);

if($stm->execute()) {
    header("location:../loggedin.php");
}else{
    echo "Något blev fel";
}




?>