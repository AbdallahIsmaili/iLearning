<?php

include '../config/methods.php';
session_start();

if(isset($_SESSION['user_email'])){
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Account</h1>
    <a href="../config/methods.php">test</a>


</body>
</html>

<?php
}
else{
  header("Location: ../signin.php");
}

?>

