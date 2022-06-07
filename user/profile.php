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
  <title>iLearning - Online Courses</title>

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
      <a href="#course">Courses</a>
    </li>
    <li class="nav-item">
      <a href="#blog">Blog</a>
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

<div class="container">

<br>
<br>
<br>
<br>

    <!-- get user information -->
    <?php

      $host = "localhost";
      $user = "root";
      $pass = "";
      $db = "elearning";
      $conn;
      $session_email = $_SESSION['user_email'];

      try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE email = '$session_email'";
        $statment = $conn->prepare($sql);
        $statment->execute();
        $result = $statment->fetchAll(PDO::FETCH_OBJ);

        if(count($result) > 0){

            // $username = $result[0]->name;
            $username = $result[0]->name;

            // $userEmail = $result[0]->email;
            $userEmail = $result[0]->email;

            // $userSex = $result[0]->sex;
            $userSex = $result[0]->sex;

            // $userImage = $result[0]->idimage;
            $userImage = $result[0]->idimage;

            // header("Location: ./profile.php");
        }else{
            echo "<script>alert('We run into a Problem!!');</script>";
            echo "<script>window.location.href='../signin.php';</script>";
        }


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    ?>
    
    <h2 class="section-title">My account</h2>
    <br>

    <!-- get user image -->
    <?php

      $host = "localhost";
      $user = "root";
      $pass = "";
      $db = "elearning";
      $conn;
      $user_image = $result[0]->idimage;

      try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT path FROM images WHERE idimage = '$user_image'";
        $statment = $conn->prepare($sql);
        $statment->execute();
        $result = $statment->fetchAll(PDO::FETCH_OBJ);

        if(count($result) > 0){
            $userImagePath = $result[0]->path;
        }else{
            echo "<script>alert('We run into a Problem!!');</script>";
            echo "<script>window.location.href='../signin.php';</script>";
        }


    }catch(PDOException $e){
        echo $e->getMessage();
    }
    ?>

      <div class="profile">
        <img class="profile-img" src="<?php echo $userImagePath; ?>" alt="">

        <div class="profile-info">
          <h2 class="section-title"><?php echo $username; ?></h2>
          <br>
          <label for="">My email:</label>
          <p class="section-subtitle"><?php echo $userEmail; ?></p>
          <br>
          <label for="">Gender:</label>
          <p class="section-subtitle"> <?php echo $userSex; ?></p>
          <br>
          <label for="">Image Id:</label>
          <p class="section-subtitle"> <?php echo $userImage; ?></p>
          <br>

          <div class="profile-buttons">

            <a class="edit-btn btn btn-primary" name="editMyProfile" href="user/edit-profile.php">
                <p class="btn-text">Edit my account!</p>
                <span class="square"></span>
            </a>


            <a class="delete-btn btn btn-primary" name="deleteMyProfile" href='../index.php?useremail=<?php echo $userEmail; ?>&action=delete'>
                <p class="btn-text">delete my account!</p>
                <span class="square"></span>
            </a>

          </div>  
        </div>
        
      </div>
    

    </div>

</body>
</html>

<?php
}
else{
  header("Location: ../signin.php");
}

?>

