<?php

include './config/methods.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iLearning - Categories</title>

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
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

  <!--
    - main container
  -->

  <div class="container">

    <!--
      - #HEADER
    -->

    <header>

      <nav class="navbar">

        <div class="navbar-brand">
          <img src="./assets/images/logo.png" alt="Educator Logo">
        </div>

        <ul class="navbar-nav">

          <li class="nav-item">
            <a href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a href="#blog">Blog</a>
          </li>
          <li class="nav-item">
            <a href="#contact">Contact Us</a>
          </li>
        </ul>

        <?php
          if(isset($_SESSION['user_email'])){
              // if user active we will show his name in the active button, if not we will show login button
              echo '<a class="btn btn-primary" name="myProfile" href="user/profile.php">
                        <p class="btn-text">My account!</p>
                        <span class="square"></span>
                    </a>';
          }
          else{
            echo '<a class="btn btn-primary" href="signin.php">
                      <p class="btn-text">Log in!</p>
                      <span class="square"></span>
                  </a>';
          }

        ?>

        <button class="nav-toggle-btn">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </nav>

    </header>





    <main>

      <!--
        - #HOME SECTION
      -->

      <section class="home" id="home">

        <div class="deco-shape shape-1">
          <img src="./assets/images/shape-1.png" alt="art shape" width="70">
        </div>
        <div class="deco-shape shape-2">
          <img src="./assets/images/shape-2.png" alt="art shape" width="55">
        </div>
        <div class="deco-shape shape-3">
          <img src="./assets/images/shape-3.png" alt="art shape" width="120">
        </div>
        <div class="deco-shape shape-4">
          <img src="./assets/images/shape-4.png" alt="art shape" width="30">
        </div>

        <div class="home-left">

          <p class="section-subtitle">Here is our unique library!</p>

          <h1 class="main-heading">
            Find The Best Online
            <span class="underline-img">Courses <img src="./assets/images/banner-line.png" alt="line"></span>
          </h1>

          <p class="section-text">
            Integer in magna in est ultrices bibendum eget enim et dui imperdiet faucibus. Fusce eu tristique felis.
          </p>

          <div class="home-btn-group">
            <button class="btn btn-primary">
              <p class="btn-text">Course isn't found?</p>
              <span class="square"></span>
            </button>
          </div>

        </div>

        <div class="home-right">

          <div class="img-box">

            <img src="./assets/images/banner-img-bg.png" alt="colorful background shape" class="background-shape">
            <img src="./assets/images/categories-bunner-img.png" alt="banner image" class="banner-img">

            <img src="./assets/images/banner-aliment-icon-1.png" alt="" class="icon-1 smooth-zigzag-anim-1" width="250">
            <img src="./assets/images/banner-aliment-icon-2.png" alt="" class="icon-2 smooth-zigzag-anim-2" width="240">
            <img src="./assets/images/banner-aliment-icon-3.png" alt="" class="icon-3 smooth-zigzag-anim-3" width="195">
            <img src="./assets/images/banner-aliment-icon-4.png" alt="" class="icon-4 drop-anim">

          </div>

        </div>

      </section>





      <!--
        - #COURSE CATEGORY SECTION
      -->

      <section class="category">

        <p class="section-subtitle">Course Category</p>

        <h2 class="section-title">Explore Out Categories</h2>

        <div class="search-box">
          <form action="categories.php" method="post">

            <input type="text" name='search-about' placeholder="Search for a course">
            <button type="submit" name='search-category' class="btn btn-primary">
              <p class="btn-text">Search</p>
              <span class="square"></span>
            </button>

          </form>
        </div>

        <ul class="course-item-group">

          <!-- Get categories from database -->

          <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if(!isset($_POST['search-category'])){

                  $sql = "SELECT * FROM category ORDER BY idcategory";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  $result = $statement->fetchAll(PDO::FETCH_OBJ);

                  foreach($result as $row){
                      echo '<li class="course-category-item">
                              <div class="wrapper">
                              <img src="'.$row->image.'" alt="category icon" class="category-icon default">
                  
                              <img src="'.$row->image.'" alt="category icon white"
                                  class="category-icon hover">
                              </div>
                  
                              <div class="course-category-content">
                              <h3 class="category-title">
                              <a href="category.php?idcategory='.$row->idcategory.'">'.$row->namecategory.'</a>
                              </h3>
                  
                              <p class="category-subtitle">'.$row->categorydesc.'</p>
                              </div>
                  
                          </li>';
                  }
                }else if(isset($_POST['search-category'])){
                  $search = $_POST['search-about'];

                  $sql = "SELECT * FROM category WHERE namecategory LIKE '%$search%'";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  $result = $statement->fetchAll(PDO::FETCH_OBJ);

                  foreach($result as $row){
                    echo '<li class="course-category-item">
                            <div class="wrapper">
                            <img src="'.$row->image.'" alt="category icon" class="category-icon default">
                
                            <img src="'.$row->image.'" alt="category icon white"
                                class="category-icon hover">
                            </div>
                
                            <div class="course-category-content">
                            <h3 class="category-title">
                            <a href="category.php?idcategory='.$row->idcategory.'">'.$row->namecategory.'</a>
                            </h3>
                
                            <p class="category-subtitle">'.$row->categorydesc.'</p>
                            </div>
                
                        </li>';
                }
              }

            }catch(PDOException $e){
                echo $e->getMessage();
            }


          ?>

        </ul>

      </section>

      <!--
        - #INSTRUCTOR SECTION
      -->


      <!--
        - #CONTACT
      -->

      <section class="contact">

        <div class="contact-card" id="contact">
          <img src="./assets/images/cta-bg-img.png" alt="shape" class="contact-card-bg">

          <h2>Start Your Best Online Classes With Us</h2>

          <button class="btn btn-primary">
            <p class="btn-text">Contact Us</p>
            <span class="square"></span>
          </button>
        </div>

      </section>

    </main>





    <!--
      - #FOOTER
    -->

    <footer>

      <div class="footer-grid">

        <div class="grid-item">

          <div class="footer-logo">
            <img src="./assets/images/logo-footer.png" alt="educator logo white">
          </div>

          <p class="footer-text">
            Duis a tempor magna. Maecenas ligula felis, imperdiet quis arcu eget, blandit ultricies risus. Vivamus
            fringilla urna
            vel risus congue accumsan.
          </p>

          <div class="social-link">
            <a href="#">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </div>

        </div>

        <ul class="grid-item">

          <h4 class="item-heading">Our Link</h4>

          <li class="list-item">
            <a href="#home">Home</a>
          </li>

          <li class="list-item">
            <a href="#about">About Us</a>
          </li>

          <li class="list-item">
            <a href="#course">Courses</a>
          </li>

          <li class="list-item">
            <a href="#blog">Blog</a>
          </li>

          <li class="list-item">
            <a href="#contact">Contact Us</a>
          </li>

        </ul>

        <ul class="grid-item">

          <h4 class="item-heading">Other Link</h4>

          <li class="list-item">
            <a href="#">Instructor</a>
          </li>

          <li class="list-item">
            <a href="#">FAQ</a>
          </li>

          <li class="list-item">
            <a href="#">Event</a>
          </li>

          <li class="list-item">
            <a href="#">Privacy Policy</a>
          </li>

          <li class="list-item">
            <a href="#">Term & Condition</a>
          </li>

        </ul>

        <div class="grid-item">

          <h4 class="item-heading">Subscribe Now</h4>

          <div class="wrapper">
            <input type="text" name="subscribe" placeholder="Email Address">
            
            <button class="send-btn">
              <ion-icon name="paper-plane"></ion-icon>
            </button>
          </div>

        </div>

      </div>

      <p class="copyright">
        Copyright © 2022 <a href="#">codewithsadee</a>. All rights reserved.
      </p>

    </footer>

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