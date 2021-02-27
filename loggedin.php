<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <title>Logged in</title>
</head>
<body>

    <header>
        <img src="image/logos/Millhouse-logos_black.png" alt="Logo Millhouse" width="200">
    
        <div class = "loggaut-knapp">
            <?php
            echo '<br /><a href="views/logout.php">Logout</a>';
            ?>
        </div>  
    </header>
    <hr>

<main>

<div id = "post-container">
<?php
session_start();
include 'includes/database_connection.php';
$stm = $pdo->query("SELECT postID, title, description, imageURL, category, date FROM posts");

//För välkomstmeddelande och kollar om man är admin
//ucfrist() är en inbygged funktion som gör så att den första bokstaven är uppercase
if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    echo "<h1>Välkommen " . ucfirst($_SESSION['fname']). "</h1>";

    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
        echo "<h2><a href='views/post.php'>Skapa en ny blogpost</a></h2>";
    }
}

// Man måste kunna lägga till nytt blogginlägg som admin

//while loop för att skriva ut alla blogposts på sidan
while ($row = $stm->fetch()){
    if($_SESSION['role'] == "admin"){           // Om role är admin loopa ut edit och deleteknapparna
?>
    <div class ="posts">
    <!-- Fixas senare -->
        <h2><?php echo $row['title'];?></h2>
        <figure><img src="<?php echo $row['imageURL'];?>" alt="blog-bild" width="200">
        <figcaption><p><?php echo $row['description'];?></p></figcaption><figure>
        <p><?php echo $row['date'];?></p>
        <!-- För att få rätt id på edit o delete knapparna -->
        <div class="edit">
        <a href="views/editPost.php?id=<?php echo $row['postID']; ?>">Edit</a>              
        </div>
        <div class="delete">
        <a href="views/deletePost.php?id=<?php echo $row['postID']; ?>">Delete</a>
        </div>
        <div class="comments">
        <a href="views/comments.php?id=<?php echo $row['postID']; ?>">Comments</a>
        </div>
    </div> <!-- stänger post -->
</div> <!-- stänger post-container -->

<!-- Stänger while loop -->
<?php
    }else{   // Inga edit och deleteknappar
     
    ?>
<div class ="posts">
<!-- Fixas senare -->
    <h2><?php echo $row['title'];?></h2>
    <img src="<?php echo $row['imageURL'];?>" alt="blog-bild" width="200">
    <figcaption><p><?php echo $row['description'];?></p></figcaption>
    <p><?php echo $row['date'];?></p>
    <div class="comments">
       <a href="views/comments.php?id=<?php echo $row['postID']; ?>">Comments</a>
    </div>

</div>
<?php
    }
}
?>
</main>
<hr>
<footer>
    <p>&copy; 2021 Grupp CMS 9, kurs systemutveckling PHP, Medieinsitutet</p>
</footer>
</body>
</html>