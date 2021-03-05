<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
<title>Sign up</title>
</head>

<?php
session_start();
include('../includes/database_connection.php');

// För registrering.
// Kollar ifall användernamnet eller email är redan taget.
$regUsername = $regEmail = "";
$regUsername_error = $regEmail_error = "";
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
    //Om email eller användernamet inte är taget så skapas det ett konto.
    if(empty($regUsername_error) && empty($regEmail_error)){
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
                $message = '<label>All fields must be filled</label>';
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
                    echo "Register success";
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

<!-- För error meddelandet -->
<?php  
    if(isset($errorMessage)){  
        echo '<label>'.$errorMessage.'</label>';  
    }  
?>  

<body>
<?php
    include_once('../includes/header.php');
?>
    <div class="signup-container">
        <h3>Sign up</h3>
        <pre>
            <form method="post" class ="signup-form">
                <label>First name:</label>
                <input type="text" name="regFname" placeholder = "First name">
                <label>Last name:</label>
                <input type="text" name="regLname" placeholder = "Last name">
                <label>Email:</label>
                <input type="text" name="regEmail" placeholder = "Email">
                <span><?php echo $regEmail_error; ?></span>
                <label>Username:</label>
                <input type="text" name="regUsername" placeholder = "Username">
                <span><?php echo $regUsername_error; ?></span>
                <label>Password:</label>
                <input type="password" name="regPassword" placeholder = "Password">
                <label>Confirm Password:</label>
                <input type="password" name="regConfirmPassword" placeholder = "Confirm Password">
                <input type="submit" name="sign-up" value="Sign-up">
            </form>
        </pre>  
    </div>
</body>
</html>