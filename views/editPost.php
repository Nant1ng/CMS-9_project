<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">
<title>Edit post</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';

if(isset($_POST['update'])){
    // Om man inte väljer en ny bild, behåll befintlig   
if(empty($_FILES['imageToUpload']['name'])){
    $sql1 = "UPDATE posts set description=:description_IN, title=:title_IN, category=:category_IN WHERE postID=:postID_IN";
    $query1 = $pdo->prepare($sql1);
   
    $postID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $query1->bindparam(':postID_IN', $postID);               
    $query1->bindparam(':description_IN', $description);
    $query1->bindparam(':title_IN', $title);
    $query1->bindparam(':category_IN', $category);

    $query1->execute();
    header("location:loggedin.php");
} else{
// Else statement för att kunna byta till en ny bild
    
    $upload_dir = "../image/uploads/";                                             //Mappen där bilderna ska sparas.
    $target_file = $upload_dir . basename($_FILES['imageToUpload']['name']);       //basename för att få rätt mappsökning linux/pc
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));            // Gör om infon till lowercase string, PATHINFO Hämtar filslutet (.jpg .png o.s.v).
// Kolla om det är en bild som användaren försöker ladda upp
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES['imageToUpload']['top_name']);
    if($check == false){
        echo "The file is not an image!";
        die;
    }
}
// Kolla om bilden redan finns
if(file_exists('$target_file')){
    echo "The file already exist!";
    die;
}
// bilden får inte vara större än 1mb
if($_FILES['imageToUpload']['size']>1000000){
    echo "The file is to big! max 1mb!";
    die;
}
// Det måste vara png, gif, jpg eller jpeg
if($fileType != "png" && $fileType != "gif" && $fileType != "jpg" && $fileType != "jpeg"){
    echo "You can only upload PNG, GIF, JPG or JPEG";
    die;
}

if(move_uploaded_file($_FILES['imageToUpload']['tmp_name'], $target_file)){
    echo "File uploaded succesfully";
}else {
    die;
};

    // Ta in alla värden från den raden som editknappen fanns på
    $postID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    // sql query och förbered för att köra
    $sql2 = "UPDATE posts set description=:description_IN, title=:title_IN, imageUrl=:imageUrl_IN, category=:category_IN WHERE postID=:postID_IN";
    $query2 = $pdo->prepare($sql2);

    $query2->bindparam(':postID_IN', $postID);               
    $query2->bindparam(':description_IN', $description);
    $query2->bindparam(':title_IN', $title);
    $query2->bindparam(':imageUrl_IN', $target_file);
    $query2->bindparam(':category_IN', $category);

    //Kör query
    $query2->execute();

    header("location:loggedin.php");
    }
}

?>

<?php

//Hämta id från url
$postID = $_GET['id'];

//Välj data från rätt id
$sql3 = "SELECT * FROM posts WHERE postID=:postID";
$query3 = $pdo->prepare($sql3);
$query3->execute(array(':postID' => $postID));

while($row = $query3->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id
{
    $title = $row['title'];  
    $description = $row['description'];                               //sparar all data från arrayen i nya variabler
    $imageUrl = $row['imageUrl'];    
    $category = $row['category'];                  
}

?>
<div id ="header-logo"><img class = "header-logo-img-editcreate" src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse">
<a href="loggedin.php">Back to the blog</a>
<div class = "loggaut-knapp-create">
    <a href="logout.php">Log out</a>
</div> 
</div>

<main>
<h4 class = "edit-post-title">Create a new blogpost</h4>

    <form name="form1" method="post" action="editPost.php" enctype="multipart/form-data">
    <div class ="editPost-container">
        <div class ="editPost-form">
                <div class = "title-input">
                    <p>Update title</p>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </div>
                
                <div class = "description-input">
                    <p>Update description</p>
                    <textarea
                    cols="50" rows="20"
                    name="description" 
                    value="<?php echo $description;?>">
                    <?php echo $description;?>    
                    </textarea>
                </div>
                
                <div class = "image-upload">
                    <p>Update image from device or use existing image:</p>
                    <p><?php echo $imageUrl;?></p>
                    <input type="file" name="imageToUpload">
                </div> 

                <div class = "category-input">
                    <p>Update category</p>
                    <input type="text" name="category" value="<?php echo $category;?>">
                </div>

                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>               <!-- hidden och get id för att hålla koll på vilket id i posts som ska redigeras. -->
                
                <div class ="submit-button">
                    <input type="submit" name="update" value="Update post">
                </div>
        </div>        
    </div>
    </form>
</main>
</body>
</html>
