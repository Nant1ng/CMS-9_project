<!-- För att ladda upp bilder från datorn  -->
<?php
$upload_dir = "../image/uploads/";
$target_file = $upload_dir . basename($_FILES['imageToUpload']['name']);
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if(isset($_POST['submit'])){
    $check = getimagesize($_FILES['imageToUpload']['top_name']);
    if($check == false){
        echo "The file is not an image!";
        die;
    }
}

if(file_exists('$target_file')){
    echo "The file already exist!";
    die;
}

if($_FILES['imageToUpload']['size']>1000000){
    echo "The file is to big! max 1mb!";
    die;
}

if($fileType != "png" && $fileType != "gif" && $fileType != "jpg" && $fileType != "jpeg"){
    echo "You can only upload PNG, GIF, JPG or JPEG";
    die;
}

if(move_uploaded_file($_FILES['imageToUpload']['tmp_name'], $target_file)){
    echo "File uploaded succesfully";
}else {
    die;
};

?>
<!-- spara till databas -->
<?php
session_start();
include '../includes/database_connection.php';

$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$date = $_POST['date'];

$sql = "INSERT INTO posts (title,description,imageUrl,category,date) VALUES(:title_IN, :description_IN, :imageUrl_IN, :category_IN, :date_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(':title_IN', $title);
$stm->bindParam(':description_IN', $description);
$stm->bindParam(':imageUrl_IN', $target_file);
$stm->bindParam(':category_IN', $category);
$stm->bindParam(':date_IN', $date);

if($stm->execute()) {
    header("location:loggedin.php");
}else{
    echo "Something went wrong try again";
}

?>