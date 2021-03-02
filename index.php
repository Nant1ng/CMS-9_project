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
      <h4>Welcome! Login here<h4>
      <a id="login" href="views/login.php">Login</a>
      <h4>Or if your new here, sign up here<h4>
       <a id="signup" href="views/sign-up.php">Sign up</a></h4>
   </div>

</body>
</html>
