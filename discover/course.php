<?php

include '../config/methods.php';
session_start();

if(isset($_SESSION['user_email'])){

    $userEmail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];

    if(isset($_GET['title'])){
        $courseTitle = $_GET['title'];
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/style.css?v1.5">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title><?php echo $_GET['title']; ?></title> 
</head>
<body>
    
<h1>Hi</h1>

<?php
echo $courseTitle;
echo "<br>";
echo $_GET['title'];
?>
                 

    <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
}
else{
  echo "<h1>Hello My Friend Please Sign in or create an account to see that beautiful course for free!</h1> <br> <br> <a href='../signin.php'>Log in now!</a>";
}

?>
