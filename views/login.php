<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/510675b914.js"></script>
	<script defer src="../includes/Showpassword.js"></script>
    <link rel="icon" href="../image/logos/Millhouse-favicon.jpeg">

</head>
<?php
    session_start();
    include '../includes/database_connection.php';
    error_reporting(E_ALL ^ E_WARNING);                 // för att inte visa varningar

try
{
    // För login.
    if(isset($_POST["login"]))  
    {  
        if(empty($_POST["username"]) || empty($_POST["password"]))
        {
            $errorMessage = '<label>All fields must be filled out</label>';
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
                header("location:loggedin.php");
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
<body>
	<header>
    <div id ="header-logo"> <img src = "../image/logos/Millhouse-logos_black.png" alt="Logo Millhouse"></div>
	</header>
	<main>
		<div class="login-form">
			<h2>Login here</h2>
            <!-- Inputfält -->
			<form method="post">
				<div class="input-box">
					<input name="username" placeholder="Username" type="text">
				</div>

                <div class = "input-box-password-container">

                    <div class="input-box-password">
                        <input id="Input" name="password" placeholder="Password" type="password"> 
                    </div>
                    <div class="eye" onclick="showpassword()">
                            <i class="fa fa-eye" id="hide1"></i> 
                            <i class="fa fa-eye-slash" id="hide2"></i>
                        </div>
                    </div>    

                <input class="login-btn" name="login" type="submit" value="Login">
                <!-- För error meddelandet -->
                <?php  
                    if(isset($errorMessage)){  
                    echo '<label id="errorMessage">'.$errorMessage.'</label>';  
                    }  
                ?>
			</form>
		</div>
	</main>
</body>
</html>