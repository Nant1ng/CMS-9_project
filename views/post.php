<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">
<title>The blog</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';


?>


<div id ="header-logo"><img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse">
<a href="../loggedin.php">Back to the blog</a>
<div class = "loggaut-knapp-create">
    <a href="logout.php">Log out</a>
</div> 
</div>  

<main>




<h2>Create a new blogpost</h2>
    <div class = "postform-container">
        <div class="post-form">
            <form method="POST" action="savePost.php" enctype="multipart/form-data">
            
            <div class = "title-input">
                <p>Choose a title</p>
                <input type="text" name="title" placeholder="Choose a title" size="30" required>
            </div>
            
            <div class ="description-input">
            <p>Write a description</p>
            <textarea name="description" cols="50" rows="20" placeholder="Description" required></textarea>
            </div>

            <div class = "image-upload">
            <p>Choose image from device</p>
            <p>(max 1mb and png, gif or jpeg)</p>
            <input type="file" name="imageToUpload">
            </div>
            
            <div class = "category-input">
            <p>Choose a category</p>
            <input type="text" name="category" placeholder="Category" required>
            </div>

            <div class = "date-input">
            <p>Choose a date</p>
                <input type="date" name="date" placeholder="Choose date" size="30" required>
            </div>

            <div class ="submit-button">
            <input type="submit" value="Post to blog">
            </div>
            </form>
        </div>
    </div>

<main>
</body>
</html>



