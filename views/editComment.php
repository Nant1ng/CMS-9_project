<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <title>Edit comment</title>
</head>
<body>


<?php
session_start();
include '../includes/database_connection.php';

if(isset($_POST['update'])){    
    
    // Spara texten från inputfältet
    $commentEdit = $_POST['comment'];
    $commentID = $_POST['id'];
    
    // sql query och förbered för att köra
    $sql = "UPDATE comments set comment=:comment_IN WHERE commentID=:commentID_IN";
    $query = $pdo->prepare($sql);


    $query->bindparam(':comment_IN', $commentEdit);               
    $query->bindparam(':commentID_IN', $commentID);

    //Kör query
    $query->execute();
    header("location:../loggedin.php");

    }

?>

<?php

//Hämta id från url
$commentID = $_GET['id'];

//Välj data från rätt id
$sql = "SELECT * FROM comments WHERE commentID=:commentID";
$query = $pdo->prepare($sql);
$query->execute(array(':commentID' => $commentID));

while($row = $query->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id
{
    $comment = $row['comment'];            
}

?>


<?php
    include_once('../includes/header.php');
?>
    <a href="../loggedin.php">Back to the blog</a>
    <br/><br/>

    <h4>Edit comment</h4>

    <form name="form1" method="post" action="editComment.php">
        <div class ="editPost-form">
                <p>Edit comment:</p>
                <div class = "comment-input">
                    <textarea
                    cols="50" rows="20"
                    name="comment" 
                    value="<?php echo $comment;?>">
                    <?php echo $comment;?>
                    
                    </textarea>
                </div>
                
                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>               <!-- hidden och get id för att hålla koll på vilket id i posts som ska redigeras. -->
                
                <div class ="submit-button">
                    <input type="submit" name="update" value="Update comment">
                </div>
        </div>        
    </form>

</body>
</html>


