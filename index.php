<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <link rel = "stylesheet" type = "text/css" href = "css/index.css" />
    <title>Startpage</title>
</head>
<body>
<?php
    include_once('includes/header.php');
?>
   <div class ="start">
      <h1 class ="loginOrRegister">Login or register</h1>
   </div>
   <div class ="start">
      <div class ="login-link">
         <p>Welcome! Login here:</p>
         <a id="login" href="views/login.php">Login</a>
      </div>
      <hr>

      <div class ="signup-link">
      <p>Are you new here? Register here:</p>
         <a id="signup" href="views/sign-up.php">Sign up</a>
      </div>

   </div>
</body>
</html>
