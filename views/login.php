<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
</head>
<body>
<?php
session_start();
include '../includes/database_connection.php';


try  
{  
      
    // För login
      
    if(isset($_POST["login"]))  
    {  
        if(empty($_POST["username"]) || empty($_POST["password"]))  
        {  
            $errorMessage = '<label>Alla fält måste vara ifyllda</label>';  
        }  
        else{  
            $query = "SELECT * FROM users WHERE username = :username AND password = :password";  
            $statement = $pdo->prepare($query);  
            $statement->execute(  
                array(  
                    'username'     =>     $_POST["username"],  
                    'password'     =>     $_POST["password"], 
                )  
            );  

        
            $count = $statement->rowCount();  
            if($count > 0){  
                $_SESSION["username"] = $_POST["username"];  
                header("location:../index.php");  
            }else{  
                $errorMessage = '<label>Något blev fel försök igen</label>';  
            }  
        }
        
    }  

}  
catch(PDOException $error)  
{  
    $errorMessage = $error->getMessage();  
}  
?>

<!-- för error meddelandet -->
<?php  
    if(isset($errorMessage)){  
        echo '<label>'.$errorMessage.'</label>';  
    }  
?>  

<div>
<h2>Logga in</h2>
<!-- Inputfält -->
<form method="post">
<input type="text" name="username" placeholder = "Username"><br>
<input type="password" name="password" placeholder = "Password"><br>
<input type="submit" name="login" value="Logga in">
</form>
</div>


</body>
</html>