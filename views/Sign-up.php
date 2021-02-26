<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
include('../includes/database_connection.php');
try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// För registrering 
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
        $message = '<label>Alla fält måste fyllas i</label>';
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
            //echo "Register success";
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

?>

<!-- för error meddelandet -->
<?php  
    if(isset($errorMessage)){  
        echo '<label>'.$errorMessage.'</label>';  
    }  
?>  



<body>
    <div class="sign-up-container">
        <h3>Sign up</h3>
        <pre>
            <form method="post">
                <label>First name:</label>
                <input type="text" name="regFname">
                <label>Last name:</label>
                <input type="text" name="regLname">
                <label>Email:</label>
                <input type="text" name="regEmail">
                <label>Username:</label>
                <input type="text" name="regUsername" >
                <label>Password:</label>
                <input type="password" name="regPassword">
        
                <input type="submit" name="sign-up" value="Sign-up">
            </form>
        </pre>  
    </div>
</body>
</html>