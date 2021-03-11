<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/comments.css" />
    <script src="https://kit.fontawesome.com/510675b914.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">

</head>
<body>


<?php
session_start();
include '../includes/database_connection.php';

$postID = $_GET['id'];

//Välj data från rätt id.
$sql = "SELECT * FROM posts WHERE postID=:postID";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':postID' => $postID));

while($row = $stmt->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id.
{
    $blogTitle = $row['title'];
    $blogText = $row['description'];
    $blogImg = $row['imageUrl'];
    $blogCategory = $row['category'];
    $blogDate = $row['date'];               
}

?>
<div id ="header-logo"><img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse">
<a href="loggedin.php">Back to the blog</a>
<!-- Lätt lösning -->
<br></br>
<div class = "loggaut-knapp">
    <a href="logout.php">Log out</a>
</div> 

</div>  

<!-- Visar det bloginlägget som kommentarerna tillhör. -->
<div class ="post">
    <figure><h4><?php echo $blogTitle?></h4>
    <p class ="date"><?php echo $blogDate;?></p>
    <hr>
    <figcaption class ="description"><p><?php echo $blogText;?></p></figcaption>
    <img src="<?php echo $blogImg;?>" alt="blog-bild">
    <figure>
</div>
<!-- Hämtar och skriver ut alla kommentarer. -->
<div class="comments">
    <!-- för att spara kommentaren i databasen. -->
<p>Leave a comment</p>
<?php
if(isset($_POST['submit-comment'])){
    $comment = $_POST['comment'];
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $date = date('Y-m-d');
    
    if(empty($comment)) {
        echo "<div>Please write a comment before posting!</div>";
    } else{
        $sql3 = "INSERT INTO comments (comment, date, userID, postID, username) VALUES (:comment, :date, :userID, :postID, :username)";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute([
            ':comment' => $comment,
            'date' => $date ,
            'userID' => $userID,
            ':postID' => $_GET['id'],
            ':username' => $username
        ]);
        header("location: blogComments.php?id={$postID}");
    }

}
?>
    <!-- Form för att kunna kommentera -->
    <div class="newCommentDiv">
        <form class="comment-form" method="POST" action="blogComments.php?id=<?php echo $_GET['id']; ?>">
            <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment..."></textarea><br>
            <div class ="submit-button">
                <input type="submit" name="submit-comment" value="Post comment">
            </div>
        </form>
    </div>

<?php
$sql2 = "SELECT * FROM comments WHERE postID = :id ORDER BY date DESC";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([':id'=>$_GET['id']]);
$comment_count = $stmt2->rowCount();
if($comment_count == 0) {
    echo "No comments yet, be the first one!";
}else if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
    echo '<h2 class="comment-count">' . $comment_count . ' Comments</h2>';            // För att skriva ut hur många kommentarer det finns
    while($comment = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $commentAuthor = $comment['username'];
        $commentText = $comment['comment'];
        $commentID = $comment['commentID'];
        $commentDate = $comment['date'];
        $_SESSION['postID'] = $comment['postID']
        ?>              <!-- stänger php taggen -->
        <!-- Skriver ut comments -->
        <div class="comment-box">
           <span class="comment-author"><b><?php echo $commentAuthor; ?></b> </span>
           <span class="comment-date"><?php echo $commentDate; ?></span>
           <p class="comment-text"><?php echo $commentText; ?></p>
           <a href="editComment.php?id=<?php echo $commentID; ?>">Edit</a>
           <a href="deleteComment.php?id=<?php echo $commentID?>">Delete</i></a>
        </div>
    
<?php  
    
    }
}else{
    echo '<h2 class="comment-count">' . $comment_count . ' Comments</h2>';            // För att skriva ut hur många kommentarer det finns
    while($comment = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $commentAuthor = $comment['username'];
        $commentText = $comment['comment'];
        $commentDate = $comment['date'];?>              <!-- stänger php taggen -->
        <!-- Skriver ut comments -->
        <div class="comment-box">
           <span class="comment-author"><b><?php echo $commentAuthor; ?></b> </span>
           <span class="comment-date"><?php echo $commentDate; ?></span>
           <p class="comment-text"><?php echo $commentText; ?></p>
        </div>


<?php
    // bara för att stänga whileloopen till kommentarerna 
    }
}
?>

</body>
</html>