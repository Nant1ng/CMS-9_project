<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
    <link rel = "stylesheet" type = "text/css" href = "../css/login.css" />
    <script src="https://kit.fontawesome.com/510675b914.js"></script>
	<script defer src="../includes/Showpassword.js"></script>
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">
<title>Sign up</title>
</head>

<?php
session_start();
include('../includes/database_connection.php');


// För registrering.
// Kollar ifall användernamnet eller email redan är taget.
$regUsername = $regEmail = $regPassword = $regConfirmPassword = "";
$regUsername_error = $regEmail_error = $regPassword_error = $regConfirmPassword_error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT userID FROM users WHERE username = :username_IN";

    if($stm = $pdo->prepare($sql)){
        $stm->bindParam(":username_IN", $param_regUsername, PDO::PARAM_STR);
        $param_regUsername = trim($_POST["regUsername"]);

        if($stm->execute()){
            if($stm->rowCount() == 1){
                $regUsername_error = "This username is already taken!";
            } else{
                $regUsername = trim($_POST["regUsername"]);
            }
        }
    }
    $sql = "SELECT userID FROM users WHERE email = :email_IN";

    if($stm = $pdo->prepare($sql)){
        $stm->bindParam(":email_IN", $param_regEmail, PDO::PARAM_STR);
        $param_regEmail = trim($_POST["regEmail"]);

        if($stm->execute()){
            if($stm->rowCount() == 1){
                $regEmail_error = "This email is already taken!";
            } else{
                $regEmail = trim($_POST["regEmail"]);
            }
        }
    }
    //Kollar så att lösenordet är längre än 10 tecken. 
    if(strlen(trim($_POST["regPassword"])) < 10){
        $regPassword_error = "Password must have at least 10 characters!";
    } else{
        $regPassword = trim($_POST["regPassword"]);
    }
    $regConfirmPassword = trim($_POST["regConfirmPassword"]);
    if(empty($regConfirmPassword_error) && ($regPassword != $regConfirmPassword)){
        $regConfirmPassword_error = "Password is not matching!";
    }
    //Om man inte får ett error så skapas det ett konto.
    if(empty($regUsername_error) && empty($regEmail_error) && empty($regPassword_error) && empty($regConfirmPassword_error)){
        try{
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST["sign-up"]))
        {
            $regUsername = $_POST['regUsername'];
            $regPassword = $_POST['regPassword'];
            $salt = "siahbndjiasnidja12893183s9300";
            $regPassword = md5($regPassword.$salt);
            $regEmail = $_POST['regEmail'];
            $regFname = $_POST['regFname'];
            $regLname = $_POST['regLname'];
        
            if(empty($_POST["regUsername"]) || empty($_POST["regPassword"]) || empty($_POST["regEmail"]) || empty($_POST["regFname"]) || empty($_POST["regLname"]))
            {
                $message = '<input>All fields must be filled</input>';
            }
            else
            {
                $sql = "INSERT INTO users (username,password,email,fname,lname) VALUES(:username_IN, :password_IN, :email_IN, :fname_IN, :lname_IN)";
                $stm = $pdo->prepare($sql);
                $stm->bindParam(':username_IN', $regUsername);
                $stm->bindParam(':password_IN', $regPassword);
                $stm->bindParam(':email_IN', $regEmail);
                $stm->bindParam(':fname_IN', $regFname);
                $stm->bindParam(':lname_IN', $regLname);
        
                  if($stm->execute()){
                    echo "Your registeration was success, now you can log in!";
                     header("location:../index.php");
                  }else {
                      echo "Something went wrong try again";
                  }
            }
        }      
        }  
        catch(PDOException $error)  
        {  
            $message = $error->getMessage();  
        }
    }
}
?>

<!-- För error meddelandet. -->
<?php  
    if(isset($errorMessage)){  
        echo '<input>'.$errorMessage.'</input>';  
    }  
?>  

<body>

<header>
<div id ="header-logo"><img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse"></div>
</header>

<main>
    <div class="login-form signup-form">
        <h2>Sign up here</h2>
        <!-- Inputfält. -->
        <form method="post">
            
            <div class="input-box">
                <input type="text" name="regFname" placeholder = "First name">
            </div>

            <div class="input-box">
                <input type="text" name="regLname" placeholder = "Last name">
            </div>

            <div class="input-box">
                <input type="text" name="regEmail" placeholder = "Email">
            </div>
            <span><?php echo $regEmail_error; ?></span>

            <div class="input-box">
                <input type="text" name="regUsername" placeholder = "Username">
            </div>
            <span><?php echo $regUsername_error; ?></span>
            
            <div class="input-box">
                <input id="Input" type="password" name="regPassword" placeholder = "Password">
            </div>
            <div class="requirement">
                Enter at least 10 characters.
            </div>
             <span><?php echo $regPassword_error; ?></span>

            <div class="input-box">
                <input id="Input" type="password" name="regConfirmPassword" placeholder = "Confirm Password">
            </div>
            <span><?php echo $regConfirmPassword_error; ?></span>
            <input type="submit" name="sign-up" value="Sign-up" class="login-btn signup-btn">
            </form>
    </div>
</main>
</body>
</html>