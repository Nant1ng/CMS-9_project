<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
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
            $username = $_POST['username'];
            $userPassword = $_POST['password'];
            $salt = "siahbndjiasnidja12893183s9300";
            $userPassword = md5($userPassword.$salt);

            $sql = "SELECT count(userID), role, fname FROM users WHERE username = :username_IN AND password = :password_IN";
            $stm = $pdo->prepare($sql);
            $stm->bindparam(":username_IN", $username);
            $stm->bindparam(":password_IN", $userPassword);
            $stm->execute();
            $return = $stm->fetch();

            if($return[0] > 0){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $userPassword;
                $_SESSION['role'] = $return['role'];
                $_SESSION['fname'] = $return['fname'];
                header("location:../loggedin.php");
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

<!-- För error meddelandet -->
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