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
    <img src = "image/logos/Millhouse-logos_black.png" alt="Logo Millhouse" class ="header-logo">
</header>

<div class = "loggaut-knapp">
    <a href="views/logout.php">Logout</a>
</div>  

<main>


    <?php
    session_start();
    include 'includes/database_connection.php';
    $stm = $pdo->query("SELECT postID, title, description, imageURL, category, date FROM posts");

    //För välkomstmeddelande och kollar om man är admin
    //ucfrist() är en inbygged funktion som gör så att den första bokstaven är uppercase
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        echo "<h1>Välkommen " . ucfirst($_SESSION['fname']). "</h1>";

        if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
            echo "<h2><a href='views/post.php'> Skapa en ny blogpost</a></h2>";
        }
    }
    
    
    // Man måste kunna lägga till nytt blogginlägg som admin

    //while loop för att skriva ut alla blogposts på sidan
    while ($row = $stm->fetch()){
        if($_SESSION['role'] == "admin"){           // Om role är admin loopa ut edit och deleteknapparna
    ?>


<div id = "post-container">
        <div class ="post">
            <figure><h4><?php echo $row['title'];?></h4>
            <p class ="date"><?php echo $row['date'];?></p>
            <hr>
            <figcaption class ="description"><p><?php echo $row['description'];?></p></figcaption>
            <img src="<?php echo $row['imageURL'];?>" alt="blog-bild">
            <figure>
            <!-- För att få rätt id på edit o delete knapparna -->
            
                <div class="postknappar">
                <p><a href="views/editPost.php?id=<?php echo $row['postID']; ?>">Edit</a></p>              

                <p><a href="views/deletePost.php?id=<?php echo $row['postID']; ?>">Delete</a></p>

                <p><a href="views/comments.php?id=<?php echo $row['postID']; ?>">Comments</a></p>
                </div><!-- stänger postknappar -->

        </div> <!-- stänger post -->

        <!-- Stänger while loop -->
        <?php
            }else{   // Inga edit och deleteknappar
        ?>

        <div class ="post">
        <!-- Fixas senare -->
            <figure>
            <h2><?php echo $row['title'];?></h2>
            <p><?php echo $row['date'];?></p>
            <hr>
            <img src="<?php echo $row['imageURL'];?>" alt="blog-bild">
            <figcaption><p><?php echo $row['description'];?></p></figcaption>
            </figure>
            <div class="comments">
            <a href="views/comments.php?id=<?php echo $row['postID']; ?>">Comments</a>
        </div> <!-- stänger post -->
</div> <!-- stänger post-container -->



<?php
    }
}
?>

</main>

<hr>

<footer>
    <p class = "footer">&copy; 2021 Grupp CMS 9, kurs systemutveckling PHP, Medieinsitutet</p>
</footer>

</body>
</html>