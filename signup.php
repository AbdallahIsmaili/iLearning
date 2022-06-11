<?php 

include './config/connect.php';
include './config/methods.php';

$register = new register();

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $sex = $_POST['sex'];

    if($sex == 'male'){
        $idimage = rand(1,6);
    }
    if($sex == 'female'){
        $idimage = rand(7, 12);
    }

    $result = $register->registerUser($name, $email, $sex, $password, $confirm_password, $idimage);


    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Used Email has been already taken!')</script>";
        echo "<script>window.open('./signup.php','_self')</script>";
    }
    if($result == 2){
        // header("Location: ./signup.php");
        echo "<script>alert('Password and confirm password does not match!')</script>";
        echo "<script>window.open('./signup.php','_self')</script>";
    }
    if($result == 3){
        // header("Location: ./login.php");
        echo "<script>alert('Registration successful!')</script>";
        echo "<script>window.open('./signin.php','_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iLearning - Get knowlage</title>

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

                <a class="btn btn-primary" href="signin.php">
                    <p class="btn-text">Or Sign in?</p>
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
            <p class="section-subtitle">Register Now!!</p>
            <h2 class="section-title">Hello and welcome, it's your road to knowlage!</h2>
            <br>
        <br>
        <br>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="email">Sex :</label>
                    <select name="sex" id="">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password :</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your password">
                </div>
                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="register" class="btn btn-primary">Sign up</button>
                </div>
            </form>

            <p>Already have an account? <a href="signin.php">log in!</a></p>
            <!-- <a href="./config/connect.php">test</a> -->

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