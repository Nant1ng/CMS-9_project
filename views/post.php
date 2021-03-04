<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
    <title>The blog</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';

?>
<?php
    include_once('../includes/header.php');
?>
<h2>Create a new blogpost</h2>

<pre>
<div class="post-form">
    <form method="POST" action="savePost.php" enctype="multipart/form-data">
    <span>Choose a title</span>
    <input type="text" name="title" placeholder="Choose a title" size="30">
    
    <span>Write a description</span>
    <textarea name="description" cols="30" rows="10" placeholder="Description"></textarea>
    
<span>Choose an image URL</span>
    <input type="text" name="imageUrl" placeholder="Image adress ex: https://images.pexels.com/photos/2811088/pexels-photo-2811088.jpeg" size="37">
    
<span>Choose file from device</span>
    <input type="file" name="imageupload" value="<?php echo $imageUrl;?>"> <input type="submit" value="Upload">
    
<span>Choose a date</span>
    <input type="date" name="date" placeholder="Choose date" size="30">
    
    <input type="submit" value="Post!">
    </form>
</div>
</pre>

</body>
</html>



