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

<?php
    include_once('includes/header.php');
?>

<main>

<div id = "post-container">
    <?php
    session_start();
    include 'includes/database_connection.php';
    $stm = $pdo->query("SELECT postID, title, description, imageURL, category, date FROM posts ORDER BY date DESC");

    //För välkomstmeddelande och kollar om man är admin
    //ucfrist() är en inbygged funktion som gör så att den första bokstaven är uppercase
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        echo "<h1>Welcome " . ucfirst($_SESSION['fname']). "</h1>";


?>
     <p class = "welcome-text">
    Welcome to Millhouse merchandise. We are a small business that focus on customer service and high quality products. Here on our product blog you can follow our latest products and also comment what you think of our products. Here you can choose to comment between accessories like glasses, watches and lighter decoration for your home. Happy reading!
    </p>

<?php



        if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
            echo "<span><a href='views/post.php'> Create a new blogpost</a></span>";
        }
    }
   
    ?>

    <div class = "loggaut-knapp">
    <a href="views/logout.php">Log out</a>
    </div> 

    <p class ="latestpost">Latest posts</p>
        
    <?php
    // Man måste kunna lägga till nytt blogginlägg som admin

    //while loop för att skriva ut alla blogposts på sidan
    while ($row = $stm->fetch()){
        if($_SESSION['role'] == "admin"){           // Om role är admin loopa ut edit och deleteknapparna
    ?>

   

        <div class ="post">
            <p class ="date"><?php echo $row['date'];?></p>
            <figure><h4><?php echo $row['title'];?></h4>
            <hr>
            <figcaption class ="description"><p><?php echo $row['description'];?></p></figcaption>
            <a href="views/blogComments.php?id=<?php echo $row['postID']; ?>">
                <img src="<?php echo $row['imageURL'];?>" alt="blog-bild"></a>
            <figure>
            <!-- För att få rätt id på edit o delete knapparna -->
            
                <div class="postbuttons">
                    <a href="views/editPost.php?id=<?php echo $row['postID']; ?>">Edit</a>
                    <a href="views/deletePost.php?id=<?php echo $row['postID']; ?>">Delete</a>
                    <a href="views/blogComments.php?id=<?php echo $row['postID']; ?>">Comments</a>
                </div><!-- stänger postbuttons-->

        </div> <!-- stänger post -->

        <!-- Stänger while loop -->
        <?php
            }else{   // Inga edit och deleteknappar
        ?>

<div class ="post">
<p class ="date"><?php echo $row['date'];?></p>
            <figure><h4><?php echo $row['title'];?></h4>
            <hr>
            <figcaption class ="description"><p><?php echo $row['description'];?></p></figcaption>
            <a href="views/blogComments.php?id=<?php echo $row['postID']; ?>">
                <img src="<?php echo $row['imageURL'];?>" alt="blog-bild"></a>
            <figure>
            <!-- För att få rätt id på edit o delete knapparna -->
            
                <div class="postbuttons">
                    <a href="views/blogComments.php?id=<?php echo $row['postID']; ?>">Comments</a>
                </div><!-- stänger postbuttons-->

</div> <!-- stänger post-container -->

<?php
    }
}
?>


</main>

<footer>
    <p class = "footer">&copy; 2021 Grupp CMS 9, kurs systemutveckling PHP, Medieinsitutet</p>
</footer>

</body>
</html>