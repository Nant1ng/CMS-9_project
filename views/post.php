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


<div id ="header-logo"><img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse"></div>
<a href="../loggedin.php">Back to the blog</a>
</div>  

<main>
<h2>Create a new blogpost</h2>
<pre>

    <div class = "postform-container">
        <div class="post-form">
            <form method="POST" action="savePost.php" enctype="multipart/form-data">
            
            <div>
                <span>Choose a title</span>
                <input type="text" name="title" placeholder="Choose a title" size="30">
            </div>
            <div>
            <span>Write a description</span>
            <textarea name="description" cols="30" rows="10" placeholder="Description"></textarea>
            
            <div>
            <span>Choose image from device(max 1mb, png, gif or jpeg)</span>
            <input type="file" name="imageToUpload" > </br>
            </div>
            
            <div>
            <span>Choose a category</span>
            <input type="text" name="category" placeholder="Category">
            </div>

            <div>
            <span>Choose a date</span>
                <input type="date" name="date" placeholder="Choose date" size="30">
            </div>

            <input type="submit" value="Post to blog">
            
            </form>
        </div>
    </div>

</pre>
<main>
</body>
</html>



