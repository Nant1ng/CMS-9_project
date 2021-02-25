<?php
session_start();
include '../includes/database_connection.php';

if(isset($_POST['delete'])){    
    
    // Ta in alla värden
    $postID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageUrl = $_POST['imageUrl'];
    $category = $_POST['category'];    
        
    // sql query och förbered för att köra
    $sql = "DELETE posts set description=:description_IN, title=:title_IN, imageUrl=:imageUrl_IN, category=:category_IN WHERE postID=:postID_IN";
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

// while($row = $query->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från posts med rätt id
// {
//     $title = $row['title'];  
//     $description = $row['description'];                               //sparar all data från arrayen i nya variabler
//     $imageUrl = $row['imageUrl'];    
//     $category = $row['category'];                  
// }

?>

<html>
<head>    
    <title>Remove post</title>
</head>
 
<body>
    <a href="../index.php">Tillbaka till bloggen</a>
    <br/><br/>
    <form name="form1" method="post" action="removePost.php">
    <table border="0">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td>Description:</td>
                    <td><input type="text" name="description" value="<?php echo $description;?>"></td>
                </tr>
            <tr>
                <td>Image url:</td>
                    <td><input type="text" name="imageUrl" value="<?php echo $imageUrl;?>"></td>
            </tr>
            <tr>
                <td>Category:</td>
                    <td><input type="text" name="category" value="<?php echo $category;?>"></td>
            </tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>                  <!-- hidden och get id för att hålla koll på vilket id i posts som ska redigeras. -->
                <td><input type="submit" name="delete" value="Delete"></td>
            </tr>
        </table>
    </form>
</body>
</html>
