<?php 

$username = '';
$userEmail = '';
$userPassword = '';
$userGender = '';
$userIdImage = '';

include '../config/methods.php';


$update = new update();
$oldEmail = $_GET['useremail'];

if(isset($_POST['update-profile']) && isset($_GET['useremail'])){

    $newName = $_POST['new-name'];
    $newEmail = $_POST['new-email'];
    $oldEmail = $_GET['useremail'];
    $newPassword = $_POST['new-password'];
    $confirm_password = $_POST['confirm_password'];
    $newIdImage = $_POST['new-image'];

    $result = $update->updateUser($newName, $oldEmail, $newEmail, $newPassword, $confirm_password, $newIdImage);

    echo $result;

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Your profile has updated successfully!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    if($result == 2){
        // header("Location: ./signup.php");
        echo "<script>alert('Password and confirm password does not match!')</script>";
    }
    if($result == 3){
        // header("Location: ./login.php");
        echo "<script>alert('Problem!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
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
  <link rel="stylesheet" href="../assets/css/style.css?v1.3">
  <link rel="stylesheet" href="../assets/css/media_queries.css">
  <link rel="stylesheet" href="../assets/css/animation.css">

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
                    <img src="../assets/images/logo.png" alt="Educator Logo">
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
            <p class="section-subtitle">Update your profile!!</p>
            <h2 class="section-title">Hello and welcome, trait yourself!</h2>
            <br>
        <br>
        <br>
            <form action="edit-profile.php?useremail=<?php echo $userEmail; ?>" method="POST">
                <div class="form-group">
                    <label for="name">New username :</label>
                    <input type="text" name="new-name" id="name" value="<?php echo $username ?>" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">New Email :</label>
                    <input type="email" name="new-email" id="email" value="<?php echo $userEmail ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="image">Image :</label>
                    <select name="new-image" id="">
                        <?php

                        if($userGender == 'male'){
                            echo "<option value='$userIdImage' selected>$userIdImage</option>";
                            for($i=1; $i < 7; $i++){

                                echo "<option value='$i'>$i</option>";
                            }
                        }
                        if($userGender == 'female'){
                            echo "<option value='$userIdImage' selected>$userIdImage</option>";
                            for($i=7; $i < 13; $i++){

                                echo "<option value='$i'>$i</option>";
                            }
                        }

                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">New Password :</label>
                    <input type="password" name="new-password" id="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password :</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm your password">
                </div>
                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="update-profile" class="btn btn-primary">Update info</button>
                </div>
            </form>
            <!-- <a href="./config/connect.php">test</a> -->

        </section>

    </div>

  <!--
    - custom js link
  -->
  <script src="../assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>