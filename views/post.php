<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <title>Document</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';

?>

<div class="form">

<form method="POST" action="savePost.php">
<input type="text" name="title" placeholder="title">
<textarea name="description" cols="30" rows="10" placeholder="meddelande"></textarea>
<input type="text" name="imageUrl" placeholder="image url">
<input type="text" name="category" placeholder="kategori">
<input type="date" name="date" placeholder="datum">
<input type="submit" value="Post message!">
</form>

</div>


</body>
</html>



