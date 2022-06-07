<?php

include "./config/connect.php";
include './config/methods.php';

$email = "";
$password = "";

if (isset($_COOKIE['email']) and isset($_COOKIE['password'])) 
{
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

}

$login = new login();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $login->loginUser($email, $password);
    if($result == 1){

      if(isset($_POST['remember']) and $_POST['remember'] == 'on'){
        setcookie('email', $email, time() + (86400 * 30), "/", $domain = "", $secure = false, $httponly = false );
        setcookie('password', $password, time() + (86400 * 30), "/", $domain = "", $secure = false, $httponly = false );
        // echo "<script>alert('Cookies set!')</script>";
      }
      
      echo "<script>window.open('./index.php','_self')</script>";
    }
    if($result == 2){
      echo "<script>alert('Wrong email or password!')</script>";
    }
    if($result == 3){
      echo "<script>alert('No user found with that email!')</script>";
      echo "<script>window.open('./signup.php','_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iLearning - Get inside</title>

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css?v1.1">
  <link rel="stylesheet" href="./assets/css/media_queries.css">
  <link rel="stylesheet" href="./assets/css/animation.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800;900&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">

</head>

<body>

    <div class="container">
        <header>

            <nav class="navbar">
                <div class="navbar-brand">
                    <img src="./assets/images/logo.png" alt="Educator Logo">
                </div>

                <ul class="navbar-nav">

                    <li class="nav-item">
                    <a href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                    <a href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                    <a href="#contact">Contact Us</a>
                    </li>

                </ul>

                <a class="btn btn-primary" href="signup.php">
                    <p class="btn-text">Or Sign up?</p>
                    <span class="square"></span>
                </a>

                <button class="nav-toggle-btn">
                    <span class="one"></span>
                    <span class="two"></span>
                    <span class="three"></span>
                </button>

            </nav>

        </header>
        <br>
        <br>
        <br>
        <br>
        <br>
        <section class="login-form">
            <p class="section-subtitle">Login Page</p>
            <h2 class="section-title">Hello and welcome, it's your road to knowlage!</h2>
            <br>
        <br>
        <br>
            <form action="signin.php" method="POST">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" id="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" value="<?php echo $password; ?>"  id="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="remember">remember me? </label>
                    <input type="checkbox" name="remember" value="on" placeholder="Confirm your password">
                </div>
                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary">Sign in</button>
                </div>
            </form>

            <p>don't have an account? <a href="signup.php">register now!</a></p>
        </section>

    </div>

  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>