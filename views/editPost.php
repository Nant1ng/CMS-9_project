<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <title>Edit post</title>
</head>
<body>


<?php
session_start();
include '../includes/database_connection.php';



if(isset($_POST['update'])){    
    
    // Ta in alla värden från den raden som editknappen fanns på
    $postID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageUrl = $_POST['imageUrl'];
    $category = $_POST['category'];    
        
    // sql query och förbered för att köra
    $sql = "UPDATE posts set description=:description_IN, title=:title_IN, imageUrl=:imageUrl_IN, category=:category_IN WHERE postID=:postID_IN";
    $query = $pdo->prepare($sql);


    $query->bindparam(':postID_IN', $postID);               
    $query->bindparam(':description_IN', $description);
    $query->bindparam(':title_IN', $title);
    $query->bindparam(':imageUrl_IN', $imageUrl);
    $query->bindparam(':category_IN', $category);

    //Kör query
    $query->execute();

    header("location:../loggedin.php");
    }

?>

<?php

//Hämta id från url
$postID = $_GET['id'];

//Välj data från rätt id
$sql = "SELECT * FROM posts WHERE postID=:postID";
$query = $pdo->prepare($sql);
$query->execute(array(':postID' => $postID));

while($row = $query->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id
{
    $title = $row['title'];  
    $description = $row['description'];                               //sparar all data från arrayen i nya variabler
    $imageUrl = $row['imageUrl'];    
    $category = $row['category'];                  
}

    include_once('../includes/header.php');
?>
    <a href="../loggedin.php">Back to the blog</a>
    <br/><br/>

    <h4>Edit post</h4>

    <form name="form1" method="post" action="editPost.php" enctype="multipart/form-data">
        <div class ="editPost-form">
                <p>Title</p>
                <div class = "title-input">
                    <input type="text" name="title" value="<?php echo $title;?>">
                </div>
                
                <p>Description</p>
                <div class = "description-input">
                    <textarea
                    cols="50" rows="20"
                    name="description" 
                    value="<?php echo $description;?>">
                    <?php echo $description;?>    
                    </textarea>
                </div>
                
                <p>Choose an image Url</p>
                <div class = "imageUrl">
                    <input type="text" name="imageUrl" value="<?php echo $imageUrl;?>">
                </div>

                <p>Upload from device</p>
                <div class = "imageupload">
                    <input type="file" name="imageupload" value="<?php echo $imageUrl;?>">
                    <input type="submit" value="Upload">
                </div>

                <p>Choose a category</p>
                <div class = "category-input">
                    <input type="text" name="category" value="<?php echo $category;?>">
                </div>

                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>               <!-- hidden och get id för att hålla koll på vilket id i posts som ska redigeras. -->
                
                <div class ="submit-button">
                    <input type="submit" name="update" value="Update">
                </div>
        </div>        
    </form>

</body>
</html>
