<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <header>
    <img src="/image/logos/Millhouse-logos.jpeg" alt="Logo Millhouse" width="200">
</header>

<main>

<div id = "Posts">
<?php
session_start();
include 'includes/database_connection.php';
$stm = $pdo->query("SELECT postID, title, description, imageURL, category, date FROM posts");


// IF statement för att få edit och delete att bara visas som admin


// Man måste kunna lägga till nytt blogginlägg som admin

//while loop för att skriva ut alla blogposts på sidan
while ($row = $stm->fetch()){

?>
<div class ="Glasses">
<!-- fixas senare -->
    <a href=" " title ="Click here to see post">
    <h2><?php echo $row['title'];?></h2>
    <img <?php echo $row['imageURL'];?> alt="" width="200">
    <figcaption><p><?php echo $row['description'];?></p></figcaption>
    <p><?php echo $row['date'];?></p>
    </a>
    <!-- För att få rätt id på edit o delete knapparna -->
    <div class="edit">
       <a href="editPost.php?id=<?php echo $row['postID']; ?>">Edit</a>              
    </div>
    <div class="delete">
       <a href="deletePost.php?id=<?php echo $row['postID']; ?>">Delete</a>
    </div>
</div>

</div>
<!-- stänger while loop -->
<?php
}
echo '<br /><a href="views/logout.php">Logout</a>';  
?>
</main>

<footer>
</footer>
</body>
</html>