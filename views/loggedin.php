<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="../css/style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/510675b914.js"></script>
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">
    <title>Logged in</title>
</head>
<body>

<header>
<a href="#top">
<div id ="header-logo"> <img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse"></div>
</a>
</header>

<main>
<div id = "post-container">
    <?php
    session_start();
    include '../includes/database_connection.php';

    $sql = "SELECT postID, title, description, imageUrl, category, date FROM posts ORDER BY date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array());
//För välkomstmeddelande, ucfrist() är en inbygged funktion som gör så att den första bokstaven är uppercase
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        echo "<h1>Welcome " . ucfirst($_SESSION['fname']). "</h1>";
?>
    <p class = "welcome-text">
    Welcome to Millhouse merchandise. We are a small business that focus on customer service and high quality products. Here on our product blog you can follow our latest products and also comment what you think of our products. Here you can choose to comment between accessories like glasses, watches and lighter decoration for your home. Happy reading!
    </p>
<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
        echo "<span><a href='post.php'> Create a new blogpost</a></span>";
    }
}
    ?>
    <div class = "loggaut-knapp">
        <a href="logout.php">Log out</a>
    </div> 
    <p class ="latestpost">Latest posts</p>
    <?php
    //while loop för att skriva ut alla blogposts på sidan
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $blogImg = $row['imageUrl'];
        if($_SESSION['role'] == "admin"){           // Om role är admin loopa ut edit och deleteknapparna
    ?>
        <div class ="post">
            <p class ="date"><?php echo $row['date'];?></p>
            <figure><h4><?php echo $row['title'];?></h4>
            <hr>
            <figcaption class ="description"><p><?php echo $row['description'];?></p></figcaption>
            <a href="blogComments.php?id=<?php echo $row['postID']; ?>">
                <img src="<?php echo $blogImg;?>" alt="blog-bild"></a>
            <figure>
            <!-- För att få rätt id på edit o delete knapparna -->
            
                <div class="postbuttons">
                    <a href="editPost.php?id=<?php echo $row['postID']; ?>"><i class="fas fa-edit"></i> Edit</a>
                    <a href="deletePost.php?id=<?php echo $row['postID']; ?>"><i class="fas fa-trash"></i> Delete</a>
                    <a href="blogComments.php?id=<?php echo $row['postID']; ?>"><i class="fas fa-comment"></i> Comments</a>
                </div>
        </div>
        <?php
            }else{   // Inga edit och deleteknappar för user
        ?>
<div class ="post">
<p class ="date"><?php echo $row['date'];?></p>
            <figure><h4><?php echo $row['title'];?></h4>
            <hr>
            <figcaption class ="description"><p><?php echo $row['description'];?></p></figcaption>
            <a href="blogComments.php?id=<?php echo $row['postID']; ?>">
                <img src="<?php echo $row['imageUrl']; ?>" alt="blog-bild"></a>
            <figure>
            <div class="postbuttons">
                <a href="blogComments.php?id=<?php echo $row['postID']; ?>"> Comments</a>
            </div>

</div> 

<?php
    }          // Stänger while loop 
}
?>
</main>
<footer>
    <p class = "footer">&copy; 2021 Grupp CMS 9, kurs systemutveckling PHP, Medieinsitutet</p>
</footer>
</body>
</html>