<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
    <link rel = "stylesheet" type = "text/css" href = "../css/login.css" />
    <script src="https://kit.fontawesome.com/510675b914.js" crossorigin="anonymous"></script>
    <script src="../includes/Showpassword.js" defer></script>
</head>

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

            $sql = "SELECT userID, role, fname FROM users WHERE username = :username_IN AND password = :password_IN";
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
                $_SESSION['userID'] = $return['userID'];
                header("location:../loggedin.php");
            }else{  
                $errorMessage = '<label>Something went wrong, try again!</label>';  
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
<header>
<img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse" class ="header-logo">
</header>
<main>
<div class="login-form">
    <h2>Login here</h2>
        <!-- Inputfält -->
        <form method="post">
        <div class="input-box">
            <input type="text" name="username" placeholder = "Username">
        </div>
        <div class="input-box">
        <input type="password" name="password" placeholder ="Password" id="Input">
        <span class="eye" onclick="showpassword()">
        <i id="hide1" class="fa fa-eye"></i>
        <i id="hide2" class="fa fa-eye-slash"></i>
        </span>
        </div>
        <input type="submit" name="login" value="Logga in" class="login-btn">
        </form>
</div>
</main>
</body>
</html>