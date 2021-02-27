<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <title>Skapa ett inlägg</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';

?>
<h2>Skapa ett nytt blogginlägg</h2>

<pre>
<div class="post-form">
    <form method="POST" action="savePost.php">
    <input type="text" name="title" placeholder="Rubrik" size="30">
    <textarea name="description" cols="30" rows="10" placeholder="Beskrivning"></textarea>
    <input type="text" name="imageUrl" placeholder="Bildadress ex: https://images.pexels.com/photos/2811088/pexels-photo-2811088.jpeg" size="30">
    <input type="text" name="category" placeholder="Välj kategori" size="30">
    <input type="date" name="date" placeholder="Väj datum" size="30">
    <input type="submit" value="Posta inlägg!">
    </form>
</div>
</pre>

</body>
</html>



