
<?php
session_start();
include '../includes/database_connection.php';


$postID = $_GET['id'];

//Välj data från rätt id
$sql = "SELECT * FROM posts WHERE postID=:postID";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':postID' => $postID));

while($row = $stmt->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id
{
    $blogTitle = $row['title'];
    $blogText = $row['description'];
    $blogImg = $row['imageUrl'];
    $blogCategory = $row['category'];
    $blogDate = $row['date'];               
}


?>

<!-- Skriver ut den post som kommentarerna tillhör -->
<div class ="post">
    <figure><h4><?php echo $blogTitle?></h4>
    <p class ="date"><?php echo $blogDate;?></p>
    <hr>
    <figcaption class ="description"><p><?php echo $blogText;?></p></figcaption>
    <img src="<?php echo $blogImg;?>" alt="blog-bild">
    <figure>
</div>

<div class="comments">
<?php
$sql2 = "SELECT * FROM comments WHERE postID = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([':id'=>$_GET['id']]);
$comment_count = $stmt2->rowCount();
if($comment_count == 0) {
    echo "No comments";
}else {
    while($comment = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $commentAuthor = $comment['userID'];
        $commentText = $comment['comment'];
        $commentDate = $comment['date'];?>              <!-- stänger php taggen -->
        <!-- Skriver ut comments -->
        <h2 class="comment-count"><?php echo $comment_count; ?> Comments</h2>
           
        <div class="comment-box">
           <span class="comment-author"><b><?php echo $commentAuthor; ?></b> </span>
           <span class="comment-date"><?php echo $commentDate; ?></span>
           <p class="comment-text"><?php echo $commentText; ?></p>
        </div>

<?php   // bara för att stänga whileloopen till kommentarerna 
    }
}
?>

<!-- Form för att kunna kommentera -->
<h3>Leave a comment:</h3>
    <div class="newCommentDiv">
        <form action="#" class="comment-form">
            <textarea name="comment" id="" cols="20" rows="5" placeholder="Comment..."></textarea>
            <input type="submit" value="Post comment">
        </form>
    </div>


