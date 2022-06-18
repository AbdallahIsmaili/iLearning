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
  <title>iLearning - Online Courses</title>

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
            <a href="./infos/about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a href="categories.php">Categories</a>
          </li>
          <li class="nav-item">
            <a href="./discover/blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a href="./infos/contact.php" target="_blank">Contact Us</a>
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


        <?php

          if(isset($_SESSION['user_name'])){
            $username = $_SESSION['user_name'];
          }else{
            $username = '';
          }

        ?>

          <p class="section-subtitle">Welcome <?php echo $username; ?> To Online Coaching</p>

          <h1 class="main-heading">
            Get Class From Top
            <span class="underline-img">Instructor <img src="./assets/images/banner-line.png" alt="line"></span>
          </h1>

          <p class="section-text">
            Integer in magna in est ultrices bibendum eget enim et dui imperdiet faucibus. Fusce eu tristique felis.
          </p>

          <div class="home-btn-group">
            <a class="btn btn-primary" href="categories.php">
              <p class="btn-text">Explore Courses</p>
              <span class="square"></span>
            </a>

            <a class="btn btn-secondary" href="./infos/contact.php">
              <p class="btn-text">Contact Us</p>
              <span class="square"></span>
            </a>
          </div>

        </div>

        <div class="home-right">

          <div class="img-box">

            <img src="./assets/images/banner-img-bg.png" alt="colorful background shape" class="background-shape">
            <img src="./assets/images/banner-img.png" alt="banner image" class="banner-img">

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

            }catch(PDOException $e){
                echo $e->getMessage();
            }


          ?>

        </ul>

      </section>


      <!--
        - #ABOUT SECTION
      -->

      <section class="about" id="about">

        <div class="about-left">

          <div class="img-box">
            <img src="./assets/images/about-img-bg.png" alt="about bg" class="about-bg">

            <img src="./assets/images/about-img.png" alt="about person" class="about-img">

            <img src="./assets/images/banner-aliment-icon-1.png" alt="" class="icon-1 smooth-zigzag-anim-1" width="250">
            <img src="./assets/images/banner-aliment-icon-3.png" alt="" class="icon-2 smooth-zigzag-anim-3" width="195">
          </div>

        </div>

        <div class="about-right">

          <p class="section-subtitle">About Us</p>

          <h2 class="section-title">We Have Best Online Education</h2>

          <p class="section-text">
            Morbi porttitor ligula id varius consectetur. Integer ipsum justo, congue sit amet massa vel, porttitor
            semper magna.
            Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
          </p>

          <ul class="about-ul">

            <li>
              <ion-icon name="checkmark-circle"></ion-icon>
              <p>Suspendisse nunc massa, pellentesque eu nibh eget.</p>
            </li>

            <li>
              <ion-icon name="checkmark-circle"></ion-icon>
              <p>Suspendisse nunc massa, pellentesque eu nibh eget.</p>
            </li>

            <li>
              <ion-icon name="checkmark-circle"></ion-icon>
              <p>Suspendisse nunc massa, pellentesque eu nibh eget.</p>
            </li>

          </ul>

          <button class="btn btn-primary">
            <p class="btn-text">Explore More</p>
            <span class="square"></span>
          </button>

        </div>

      </section>





      <!--
        - #COURSE SECTION
      -->

      <section class="course" id="course">

        <p class="section-subtitle">Our Online Courses</p>
        <h2 class='section-title'>Here is the latest courses in our site.</h2>

        <div class="course-grid">


        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM course ORDER BY idcourse DESC";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                foreach($result as $row){
                    echo '<div class="course-card">

                    <div class="course-banner">
                      <img src="'.$row->image.'" alt="course banner">
        
                      <div class="course-tag-box">
                        <a href="category.php?idcategory='.$row->idcategory.'" class="badge-tag orange">'.$row->coursefor.'</a>
                      </div>
                    </div>
        
                    <div class="course-content">
        
                      <h3 class="card-title">
                        <a href="./discover/course.php?id='.$row->idcourse.'&title='.$row->namecourse.'">'.$row->namecourse.'</a>
                      </h3>
        
                      <div class="wrapper border-bottom">
        
                        <div class="author">
                          <img src="'.$row->teacherimage.'" alt="course instructor image" class="author-img">
        
                          <a href="./discover/teacher.php" class="author-name">'.$row->teacher.'</a>
                        </div>
        
                      </div>
        
                      <div class="wrapper">
                        <div class="course-price">'.$row->lenght.'</div>
        
                        <div class="enrolled">
        
                          <p>'.$row->date.'</p>
                        </div>
                      </div>
        
                    </div>
        
                  </div>';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }


          ?>

        </div>

      </section>





      <!--
        - #EVENT SECTION
      -->

      <section class="event">

        <div class="event-left">

          <div class="event-banner">
            <img src="./assets/images/event-img.jpg" alt="event banner" class="banner-img">
          </div>

          <button class="play smooth-zigzag-anim-1">
            <div class="play-icon pulse-anim">
              <ion-icon name="play-circle"></ion-icon>
            </div>

            <p>Watch Us !</p>
          </button>

        </div>

        <div class="event-right">

          <p class="section-subtitle">Our Events</p>

          <h2 class="section-title">Join Our Upcoming Events</h2>

          <div class="event-card-group">


          <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM events WHERE still = 1 ORDER BY idevent DESC";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                foreach($result as $row){
                    echo ' <div class="event-card">

                    <div class="content-left">
                      <p class="day">'.date("d",strtotime($row->date)).'</p>
                      <p class="month">'.date("M",strtotime($row->date)).', '.date("Y",strtotime($row->date)).'</p>
                    </div>
      
                    <div class="content-right">
                      <div class="schedule">
                        <p class="time">'.$row->startingTime.' To '.$row->endingTime.'</p>
                        <p class="place">'.$row->place.'</p>
                      </div>
      
                      <a href="#" class="event-name">'.$row->title.'</a>
                    </div>
      
                  </div>';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }


            ?>

          </div>

        </div>

      </section>





      <!--
        - #FEATURES SECTION
      -->

      <section class="features">

        <div class="features-left">

          <p class="section-subtitle">Core Features</p>

          <h2 class="section-title">See What Our Mission Are</h2>

          <ul>

            <li class="features-item">
              <div class="item-icon-box blue">
                <img src="./assets/images/feature-icon-1.png" alt="feature icon">
              </div>

              <div class="wrapper">

                <h3 class="item-title">Student Life</h3>

                <p class="item-text">Nulla vestibulum pretium nibh at dignissim. Aliquam vehicula consectetur dignissim
                  dictum.</p>

              </div>
            </li>

            <li class="features-item">
              <div class="item-icon-box pink">
                <img src="./assets/images/feature-icon-2.png" alt="feature icon">
              </div>

              <div class="wrapper">

                <h3 class="item-title">Best Online Class</h3>

                <p class="item-text">Nulla vestibulum pretium nibh at dignissim. Aliquam vehicula consectetur dignissim
                  dictum.</p>

              </div>
            </li>

            <li class="features-item">
              <div class="item-icon-box purple">
                <img src="./assets/images/feature-icon-3.png" alt="feature icon">
              </div>

              <div class="wrapper">

                <h3 class="item-title">24x7 Program</h3>

                <p class="item-text">Nulla vestibulum pretium nibh at dignissim. Aliquam vehicula consectetur dignissim
                  dictum.</p>

              </div>
            </li>

          </ul>

        </div>

        <div class="features-right">
          <img src="./assets/images/coure-features-img.jpg" alt="core features image">
        </div>

      </section>

      <!--
        - #TESTIMONIALS
      -->

      <section class="testimonials">

        <div class="testimonials-left">

          <p class="section-subtitle">Testimonial</p>

          <h2 class="section-title">What Our Client Says About Us</h2>

          <p class="section-text">
            iLearning so happy to see your opinions, thoughts and questions, <br> so make sure to contact us whenever you want, we will be so happy to see your words about owr website.
          </p>

        </div>

        <div class="testimonials-right">

          <div class="testimonials-card">
            <img src="./assets/images/quote.png" alt="quote icon" class="quote-img">

            <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM messages WHERE mainit = 1 LIMIT 1";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                foreach($result as $row){

                    echo '<p class="testimonials-text">'.$row->content.'</p>
        
                    <div class="testimonials-client">';

                    $image = $row->image;

                    $sql = "SELECT * FROM images WHERE idimage = '$image'";
                    $statement = $conn->prepare($sql);
                    $statement->execute();
                    $result2 = $statement->fetchAll(PDO::FETCH_OBJ);

                    foreach($result2 as $row2){
                        echo '<div class="client-img-box">
                                <img width="140px" height="auto" src="'.$row2->path.'" alt="client">
                              </div>';
                    }
        
                      echo '<div class="client-detail">
                        <h4 class="client-name">'.strtoupper($row->name).'</h4>
        
                        <p class="client-title">Customer</p>
                      </div>
        
                    </div>';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }


            ?>

          </div>

        </div>

      </section>

      <!--
        - #CONTACT
      -->

      <section class="contact">

        <div class="contact-card" id="contact">
          <img src="./assets/images/cta-bg-img.png" alt="shape" class="contact-card-bg">

          <h2>Start Your Best Online Classes With Us</h2>

          <a class="btn btn-primary" href="./infos/contact.php">
            <p class="btn-text">Contact Us</p>
            <span class="square"></span>
          </a>
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
        Copyright © 2022 <a href="#">dd101-ISTA-IFRAN</a>. All rights reserved.
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