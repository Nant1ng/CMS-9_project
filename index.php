<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />

    <title>Startpage</title>
</head>
<body>
<?php
    include_once('includes/header.php');
?>
   <div class ="startpage-container">
      <p class = "welcomeLogin">Welcome! Login here</p>
      <a id="login" href="views/login.php">Login</a>
      <p class = "welcomeLogin">Or if your new here, sign up!</p>
      <p><a id="signup" href="views/sign-up.php">Sign up</a></p>
   </div>

</body>
</html>
