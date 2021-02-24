<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startpage</title>
</head>
<body>
<a href="views/sign-up.php">Sign up</a>
<a href="views/login.php">LOGIN</a>

<?php
session_start();
include 'includes/database_connection.php';
$stm = $pdo->query("SELECT postID, title, description, imageURL, category, date FROM posts");


// IF statement för att få edit och delete att bara visas som admin


// Man måste kunna lägga till nytt blogginlägg som admin

//while loop för att skriva ut alla blogposts på sidan
while ($row = $stm->fetch()){

?>

<table id="blogposts" border="0">
<tr>
   <td><?php echo $row['postID'];?></td>
</tr>
<tr>
   <td><?php echo $row['imageURL'];?></td>
</tr>
   <td><?php echo $row['title'];?></td>
</tr>
<tr>
   <td><?php echo $row['description'];?></td>
</tr>
<tr>
   <td><?php echo $row['date'];?></td>
</tr>
<tr>
   <td>
       <a href="editPost.php?id=<?php echo $row['postID']; ?>">Edit</a>              <!-- För att få rätt id på edit o delete knapparna -->
       <a href="deletePost.php?id=<?php echo $row['postID']; ?>">Delete</a>
   </td>
</tr>
</table>

<!-- stänger while loop -->
<?php
}
echo '<br /><a href="logout.php">Logout</a>';  
?>
</body>
</html>
